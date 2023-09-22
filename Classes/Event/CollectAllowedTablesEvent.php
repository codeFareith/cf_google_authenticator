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

namespace CodeFareith\CfGoogleAuthenticator\Event;

use CodeFareith\CfGoogleAuthenticator\Handler\GoogleAuthenticatorSetupHandler;

final class CollectAllowedTablesEvent
{
    private GoogleAuthenticatorSetupHandler $caller;

    private array $tables;

    public function __construct(
        GoogleAuthenticatorSetupHandler $caller,
        array $tables
    )
    {
        $this->caller = $caller;
        $this->tables = $tables;
    }

    public function getCaller(): GoogleAuthenticatorSetupHandler
    {
        return $this->caller;
    }

    public function getTables(): array
    {
        return $this->tables;
    }

    public function setTables(array $tables): self
    {
        $this->tables = $tables;
        return $this;
    }
}
