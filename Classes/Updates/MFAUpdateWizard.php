<?php
declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace CodeFareith\CfGoogleAuthenticator\Updates;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Install\Updates\DatabaseUpdatedPrerequisite;
use TYPO3\CMS\Install\Updates\UpgradeWizardInterface;

class MFAUpdateWizard implements UpgradeWizardInterface
{
    public function getTitle(): string
    {
        return 'Migrate TOTP settings from be_users and fe_users';
    }

    public function getDescription(): string
    {
        return 'Migrates TOTP configuration from EXT:cf_google_authenticator to native MFA.';
    }

    public function getIdentifier(): string
    {
        return 'MFAUpdateWizard';
    }

    public function updateNecessary(): bool
    {
        $tables = ['be_users', /*'fe_users'*/];
        foreach ($tables as $table) {
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
                ->getQueryBuilderForTable($table);

            if ($queryBuilder
                ->count('*')
                ->from($table)
                ->where(
                    $queryBuilder->expr()->eq('tx_cfgoogleauthenticator_enabled', $queryBuilder->createNamedParameter(1, \PDO::PARAM_INT)),
                    $queryBuilder->expr()->like('tx_cfgoogleauthenticator_secret', $queryBuilder->quote('%'))
                )
                ->execute()
                ->fetchOne() > 0
            ) {
                return true;
            }
        }

        return false;
    }

    public function executeUpdate(): bool
    {
        $tables = ['be_users', /*'fe_users'*/];
        foreach ($tables as $table) {
            $tableConnection = GeneralUtility::makeInstance(ConnectionPool::class)
                ->getConnectionForTable($table);
            $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
                ->getQueryBuilderForTable($table);

            $statement = $queryBuilder
                ->select('uid', 'tx_cfgoogleauthenticator_secret', 'mfa')
                ->from($table)
                ->where(
                    $queryBuilder->expr()->eq('tx_cfgoogleauthenticator_enabled', $queryBuilder->createNamedParameter(1, \PDO::PARAM_INT)),
                    $queryBuilder->expr()->like('tx_cfgoogleauthenticator_secret', $queryBuilder->quote('%'))
                )
                ->execute();

            while (($row = $statement->fetchAssociative()) !== false) {
                $existingMfa = json_decode($row['mfa'] ?? '', true) ?? [];
                $data = [
                    'tx_cfgoogleauthenticator_enabled' => 0,
                    'tx_cfgoogleauthenticator_secret' => null,
                ];
                if (!($existingMfa['totp']['active'] ?? false)) {
                    $mfa = [
                        'totp' => [
                            'secret' => $row['tx_cfgoogleauthenticator_secret'],
                            'active' => true,
                            'created' => $GLOBALS['EXEC_TIME'],
                            'updated' => $GLOBALS['EXEC_TIME'],
                            'attempts' => 0,
                            'lastUsed' => $GLOBALS['EXEC_TIME'],
                        ]
                    ];
                    $data['mfa'] = json_encode($mfa);
                }
                $tableConnection->update(
                    $table,
                    $data,
                    [
                        'uid' => $row['uid']
                    ]
                );
            }
        }

        return true;
    }

    /**
     * @return string[] All new fields and tables must exist
     */
    public function getPrerequisites(): array
    {
        return [
            DatabaseUpdatedPrerequisite::class
        ];
    }
}
