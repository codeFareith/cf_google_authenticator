<?php declare(strict_types=1);
/**
 * Class GoogleAuthenticatorSettings
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

namespace CodeFareith\CfGoogleAuthenticator\Domain\Struct;

/**
 * @package CodeFareith\CfGoogleAuthenticator\Domain\Struct
 * @since   1.0.0
 */
class GoogleAuthenticatorSettings
    extends AbstractStruct
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @var string[]
     */
    protected static $mapping = [
        'enabled' => 'tx_cfgoogleauthenticator_enabled',
        'secretKey' => 'tx_cfgoogleauthenticator_secret',
    ];

    /**
     * @var bool
     */
    protected $enabled;

    /**
     * @var string
     */
    protected $secretKey;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    public function setSecretKey(string $secretKey): void
    {
        $this->secretKey = $secretKey;
    }
}
