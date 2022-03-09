<?php

declare(strict_types=1);

namespace CodeFareith\CfGoogleAuthenticator\Hook;

use CodeFareith\CfGoogleAuthenticator\Backend\Form\Element\TwoFactorAuth;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Setup\Controller\SetupModuleController;

class UserSettings
{
    public function createSecretField(array $config, SetupModuleController $pObj)
    {
        /** @var \TYPO3\CMS\Backend\Form\NodeFactory $nodeFactory */
        $nodeFactory = GeneralUtility::makeInstance(\TYPO3\CMS\Backend\Form\NodeFactory::class);
        $data = [
            'tableName' => 'be_users',
            'databaseRow' => $GLOBALS['BE_USER']->user,
        ];

        $twoFactorAuthElement = GeneralUtility::makeInstance(TwoFactorAuth::class, $nodeFactory, $data);

        $result = $twoFactorAuthElement->render();
        return $result['html'];
    }
}
