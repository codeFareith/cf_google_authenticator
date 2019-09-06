<?php declare(strict_types=1);
/**
 * Class BackendUserRepository
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

namespace CodeFareith\CfGoogleAuthenticator\Domain\Repository;

use CodeFareith\CfGoogleAuthenticator\Domain\Model\BackendUser;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Repository for BackendUser entities
 *
 * @package CodeFareith\CfGoogleAuthenticator\Domain\Repository
 * @since   1.0.0
 *
 * @method BackendUser findByUid(int $uid)
 */
class BackendUserRepository
    extends Repository
{
}
