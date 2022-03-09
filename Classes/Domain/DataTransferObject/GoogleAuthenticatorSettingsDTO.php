<?php declare(strict_types=1);
/**
 * Class GoogleAuthenticatorSettingsDTO
 *
 * @author        Robin 'codeFareith' von den Bergen <robinvonberg@gmx.de>
 * @copyright (c) 2018-2022 by Robin von den Bergen
 * @license       http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version       1.0.0
 *
 * @link          https://github.com/codeFareith/cf_google_authenticator
 * @see           https://www.fareith.de
 * @see           https://typo3.org
 */

namespace CodeFareith\CfGoogleAuthenticator\Domain\DataTransferObject;

use CodeFareith\CfGoogleAuthenticator\Domain\Struct\GoogleAuthenticatorSettings;

/**
 * Data transfer object for google authenticator settings
 *
 * This class is used to pass information about a user's Google Authenticator
 * configuration through the various software layers (e.g. for verification and
 * validation) as soon as a user updates their account settings.
 *
 * @see     \CodeFareith\CfGoogleAuthenticator\Handler\GoogleAuthenticatorSetupHandler
 *
 * @package CodeFareith\CfGoogleAuthenticator\Domain\DataTransferObject
 * @since   1.0.0
 */
class GoogleAuthenticatorSettingsDTO
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @var GoogleAuthenticatorSettings
     */
    protected $oldSettings;

    /**
     * @var GoogleAuthenticatorSettings
     */
    protected $newSettings;

    /**
     * @var string
     */
    protected $oneTimePassword;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public function __construct(
        GoogleAuthenticatorSettings $oldSettings = null,
        GoogleAuthenticatorSettings $newSettings = null,
        string $oneTimePassword = null
    )
    {
        $this->oldSettings = $oldSettings;
        $this->newSettings = $newSettings;
        $this->oneTimePassword = $oneTimePassword;
    }

    public function getOldSettings(): GoogleAuthenticatorSettings
    {
        return $this->oldSettings;
    }

    public function setOldSettings(GoogleAuthenticatorSettings $oldSettings): void
    {
        $this->oldSettings = $oldSettings;
    }

    public function getNewSettings(): GoogleAuthenticatorSettings
    {
        return $this->newSettings;
    }

    public function setNewSettings(GoogleAuthenticatorSettings $newSettings): void
    {
        $this->newSettings = $newSettings;
    }

    public function getOneTimePassword(): string
    {
        return $this->oneTimePassword;
    }

    public function setOneTimePassword(string $oneTimePassword): void
    {
        $this->oneTimePassword = $oneTimePassword;
    }
}
