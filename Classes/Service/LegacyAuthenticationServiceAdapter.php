<?php
/**
 * @author Robin von den Bergen <robinvonberg@gmx.de>
 */

namespace CodeFareith\CfGoogleAuthenticator\Service;

use TYPO3\CMS\Sv\AuthenticationService as SvAuthenticationService;

class LegacyAuthenticationServiceAdapter
    extends SvAuthenticationService
    implements AuthenticationService
{
    /**
     * @var AuthenticationService
     */
    protected $service;

    public function __construct(AuthenticationService $authenticationService = null)
    {
        $authenticationService = $authenticationService ?? new GoogleAuthenticatorService();

        $this->service = $authenticationService;
    }

    public function init(): bool
    {
        return (
            parent::init()
            && $this->service->init()
        );
    }

    public function authUser(array $user): int
    {
        parent::authUser($user);
        return $this->service->authUser($user);
    }
}
