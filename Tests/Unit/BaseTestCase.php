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
namespace CodeFareith\CfGoogleAuthenticator\Tests\Unit;

use PHPUnit\Framework\TestCase;
use ReflectionObject;

abstract class BaseTestCase extends TestCase
{
    protected function tearDown(): void
    {
        $reflection = new ReflectionObject($this);

        foreach($reflection->getProperties() as $property) {
            if(
                !$property->isStatic()
                && 0 !== strpos($property->getDeclaringClass()->getName(), 'PHPUnit_')
            ) {
                $property->setAccessible(true);
                $property->setValue($this, null);
            }
        }

        gc_collect_cycles();
    }
}