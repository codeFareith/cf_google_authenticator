<?php
/**
 * @author Robin 'codeFareith' von den Bergen <robinvonberg@gmx.de>
 * @copyright (c) 2018 by Robin von den Bergen
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 1.0.0
 *
 * @link https://github.com/codeFareith/cf_google_authenticator
 * @see https://www.fareith.de
 * @see https://typo3.org
 */

namespace CodeFareith\CfGoogleAuthenticator\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\BackendUser as BEUser;

class BackendUser extends BEUser
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /** @var bool */
    protected $txCfgoogleauthenticatorEnabled;

    /** @var string */
    protected $txCfgoogleauthenticatorSecret;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public function isTxCfgoogleauthenticatorEnabled(): bool
    {
        return $this->txCfgoogleauthenticatorEnabled;
    }

    public function setTxCfgoogleauthenticatorEnabled(bool $txCfgoogleauthenticatorEnabled): void
    {
        $this->txCfgoogleauthenticatorEnabled = $txCfgoogleauthenticatorEnabled;
    }

    public function getTxCfgoogleauthenticatorSecret(): string
    {
        return $this->txCfgoogleauthenticatorSecret;
    }

    public function setTxCfgoogleauthenticatorSecret(string $txCfgoogleauthenticatorSecret): void
    {
        $this->txCfgoogleauthenticatorSecret = $txCfgoogleauthenticatorSecret;
    }

    public function enableGoogleAuthenticator(string $secret): void
    {
        $this->setTxCfgoogleauthenticatorEnabled(true);
        $this->setTxCfgoogleauthenticatorSecret($secret);
    }

    public function disableGoogleAuthenticator(): void
    {
        $this->setTxCfgoogleauthenticatorEnabled(false);
        $this->setTxCfgoogleauthenticatorSecret('');
    }
}
