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

use CodeFareith\CfGoogleAuthenticator\Controller\Frontend\SetupController;
use CodeFareith\CfGoogleAuthenticator\Domain\Model\FrontendUser;

final class ToggleGoogleAuthenticatorEvent
{
    private SetupController $caller;
    
    private ?string $action;
    
    private FrontendUser $user;
    
    public function __construct(
        SetupController $caller,
        ?string $action,
        FrontendUser $user
    )
    {
        $this->caller = $caller;
        $this->action = $action;
        $this->user = $user;
    }
    
    public function getCaller(): SetupController
    {
        return $this->caller;
    }
    
    public function getAction(): ?string
    {
        return $this->action;
    }
    
    public function getUser(): FrontendUser
    {
        return $this->user;
    }
}
