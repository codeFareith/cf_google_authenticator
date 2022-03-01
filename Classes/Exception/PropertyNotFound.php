<?php declare(strict_types=1);
/**
 * Class PropertyNotFound
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

namespace CodeFareith\CfGoogleAuthenticator\Exception;

use Throwable;
use TYPO3\CMS\Extbase\Exception;
use function vsprintf;

/**
 * Exception PropertyNotFound
 *
 * @package CodeFareith\CfGoogleAuthenticator\Exception
 * @since   1.0.0
 */
class PropertyNotFound
    extends Exception
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Constants
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @var int
     */
    public const CODE = 6132;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public function __construct(string $property, string $class, Throwable $previous = null)
    {
        $message = vsprintf(
            'The requested property "%s" was not found in class "%s".',
            [
                $property,
                $class,
            ]
        );

        parent::__construct($message, self::CODE, $previous);
    }
}
