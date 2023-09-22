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

use CodeFareith\CfGoogleAuthenticator\Hook\UserSettings;

final class DefineIssuerLayerEvent
{
    private UserSettings $caller;

    private string $table;

    private string $layer;

    public function __construct(
        UserSettings $caller,
        string $table,
        string $layer
    )
    {
        $this->caller = $caller;
        $this->table = $table;
        $this->layer = $layer;
    }

    public function getCaller(): UserSettings
    {
        return $this->caller;
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function getLayer(): string
    {
        return $this->layer;
    }

    public function setLayer(string $layer): self
    {
        $this->layer = $layer;
        return $this;
    }
}
