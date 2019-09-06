<?php declare(strict_types=1);
/**
 * Trait GeneralUtilityObjectManager
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

namespace CodeFareith\CfGoogleAuthenticator\Traits;

use const E_USER_DEPRECATED;
use function trigger_error;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Trait GeneralUtilityObjectManager
 *
 * @package CodeFareith\CfGoogleAuthenticator\Traits
 * @since   1.0.0
 *
 * @deprecated since v1.1.4, will be removed in v1.2.0
 */
trait GeneralUtilityObjectManager
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    protected function objectManager(): ObjectManager
    {
        if ($this->objectManager === null) {
            $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        }

        return $this->objectManager;
    }
}
