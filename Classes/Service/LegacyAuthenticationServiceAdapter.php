<?php declare(strict_types=1);
/**
 * Class LegacyAuthenticationServiceAdapter
 *
 * @author        Robin 'codeFareith' von den Bergen <robinvonberg@gmx.de>
 * @copyright (c) 2018-2019 by Robin von den Bergen
 * @license       http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version       1.0.0
 *
 * @link          https://github.com/codeFareith/cf_google_authenticator
 * @see           https://www.fareith.de
 * @see           https://typo3.org
 */

namespace CodeFareith\CfGoogleAuthenticator\Service;

use TYPO3\CMS\Sv\AuthenticationService as SvAuthenticationService;

/** @noinspection LongInheritanceChainInspection */

/**
 * @package CodeFareith\CfGoogleAuthenticator\Service
 * @since   1.1.5
 */
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
