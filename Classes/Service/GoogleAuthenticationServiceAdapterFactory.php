<?php
/**
 * @author Robin von den Bergen <robinvonberg@gmx.de>
 */

namespace CodeFareith\CfGoogleAuthenticator\Service;

use TYPO3\CMS\Core\Utility\VersionNumberUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use function version_compare;

class GoogleAuthenticationServiceAdapterFactory
    implements AuthenticationServiceAdapterFactory
{
    protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function create(): AuthenticationService
    {
        return $this->objectManager->get(
            $this->suggestServiceAdapter(),
            $this->suggestAuthenticatorService()
        );
    }

    private function suggestServiceAdapter(): string
    {
        if ($this->isLegacyInstallation()) {
            $serviceAdapter = LegacyAuthenticationServiceAdapter::class;
        } else {
            $serviceAdapter = CoreAuthenticationServiceAdapter::class;
        }

        return $serviceAdapter;
    }

    private function isLegacyInstallation(): bool
    {
        $version = VersionNumberUtility::getNumericTypo3Version();

        return version_compare($version, '9.0.0', '<');
    }

    private function suggestAuthenticatorService(): AuthenticationService
    {
        return $this->objectManager->get(GoogleAuthenticatorService::class);
    }
}
