<?php declare(strict_types=1);
/**@author Robin 'codeFareith' von den Bergen <robinvonberg@gmx.de>
 * @copyright (c) 2018 by Robin von den Bergen
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 1.0.0
 *
 * @link https://github.com/codeFareith/cf_google_authenticator
 * @see https://www.fareith.de
 * @see https://typo3.org
 */
namespace CodeFareith\CfGoogleAuthenticator\Tests\Unit\Utility;

use CodeFareith\CfGoogleAuthenticator\Tests\Unit\BaseTestCase;
use CodeFareith\CfGoogleAuthenticator\Utility\PathUtility;

class PathUtilityTest extends BaseTestCase
{
    /**
     * @param string $firstSegment
     * @param string $secondSegment
     * @param string $thirdSegment
     * @dataProvider cleanPathSegmentsProvider
     */
    public function testMakePathWithCleanSegments(
        string $firstSegment,
        string $secondSegment,
        string $thirdSegment
    ): void
    {
        $actualPath = PathUtility::makePath($firstSegment, $secondSegment, $thirdSegment);

        static::assertStringStartsWith($firstSegment, $actualPath);
        static::assertContains($secondSegment, $actualPath);
        static::assertStringEndsWith($thirdSegment, $actualPath);
    }

    /**
     * @param string $firstSegment
     * @param string $secondSegment
     * @param string $thirdSegment
     * @dataProvider dirtyPathSegmentsProvider
     */
    public function testMakePathWithDirtySegments(
        string $firstSegment,
        string $secondSegment,
        string $thirdSegment
    ): void
    {
        $actualPath = PathUtility::makePath($firstSegment, $secondSegment, $thirdSegment);

        static::assertStringStartsNotWith('/', $actualPath);
        static::assertContains($secondSegment, $actualPath);
        static::assertStringEndsNotWith('/', $actualPath);
    }

    /**
     * @param string $string
     * @dataProvider stringWithLeadingSlashProvider
     */
    public function testStripLeadingSlash(string $string): void
    {
        $stripped = PathUtility::stripLeadingSlash($string);

        static::assertStringStartsNotWith('/', $stripped);
    }

    /**
     * @param string $string
     * @dataProvider stringWithTrailingSlashProvider
     */
    public function testStripTrailingSlash(string $string): void
    {
        $stripped = PathUtility::stripTrailingSlash($string);

        static::assertStringEndsNotWith('/', $stripped);
    }

    /**
     * @param string $string
     * @dataProvider stringWithSurroundingSlashesProvider
     */
    public function testStripLeadingAndTrailingSlash(string $string): void
    {
        $stripped = PathUtility::stripLeadingAndTrailingSlash($string);

        static::assertStringStartsNotWith('/', $stripped);
        static::assertStringEndsNotWith('/', $stripped);
    }

    /**
     * @param string $relativePath
     * @dataProvider validExtensionPathProvider
     */
    public function testMakeExtensionPath(string $relativePath): void
    {
        $actualPath = PathUtility::makeExtensionPath($relativePath);

        static::assertStringStartsWith(
            'EXT:',
            $actualPath
        );
        static::assertStringEndsWith(
            $relativePath,
            $actualPath
        );
    }

    /**
     * @param string $id
     * @param string $file
     * @dataProvider validLocalLangLinkProvider
     */
    public function testMakeLocalLangLinkPath(string $id, string $file): void
    {
        $actualPath = PathUtility::makeLocalLangLinkPath($id, $file);

        static::assertStringStartsWith(
            'LLL:EXT:',
            $actualPath
        );
        static::assertContains(
            PathUtility::$languageDirectoryPath,
            $actualPath
        );
        static::assertStringEndsWith(
            $file . ':' . $id,
            $actualPath
        );
    }

    public function cleanPathSegmentsProvider(): array
    {
        return [
            ['TestSegment1-1', 'TestSegment1-2', 'TestSegment1-3'],
            ['TestSegment2-1', 'TestSegment2-2', 'TestSegment2-3'],
            ['TestSegment3-1', 'TestSegment3-2', 'TestSegment3-3'],
            ['TestSegment4-1', 'TestSegment4-2', 'TestSegment4-3'],
        ];
    }

    public function dirtyPathSegmentsProvider(): array
    {
        return [
            ['TestSegment1-1', 'TestSegment1-2', 'TestSegment1-3'],
            ['/TestSegment2-1', '/TestSegment2-2', '/TestSegment2-3'],
            ['TestSegment3-1/', 'TestSegment3-2/', 'TestSegment3-3/'],
            ['/TestSegment4-1/', '/TestSegment4-2/', '/TestSegment4-3/'],
        ];
    }

    public function stringWithLeadingSlashProvider(): array
    {
        return [
            ['/TestString1'],
            ['/TestString2'],
            ['/TestString3']
        ];
    }

    public function stringWithTrailingSlashProvider(): array
    {
        return [
            ['TestString1/'],
            ['TestString2/'],
            ['TestString3/']
        ];
    }

    public function stringWithSurroundingSlashesProvider(): array
    {
        return [
            ['/TestString1/'],
            ['/TestString2/'],
            ['/TestString3/']
        ];
    }

    public function validExtensionPathProvider(): array
    {
        return [
            ['TestPath1'],
            ['/TestPath2'],
            ['TestPath3/'],
            ['/TestPath4/']
        ];
    }

    public function validLocalLangLinkProvider(): array
    {
        return [
            ['TestID1', 'Testfile1.xml'],
            ['TestID2', 'Testfile2.xml'],
            ['TestID3', 'Testfile3.xml']
        ];
    }
}
