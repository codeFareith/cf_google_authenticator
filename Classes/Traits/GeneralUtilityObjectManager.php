<?php

namespace CodeFareith\CfGoogleAuthenticator\Traits;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

trait GeneralUtilityObjectManager
{
    /** @var ObjectManager */
    protected $objectManager;

    protected function getObjectManager(): ObjectManager
    {
        if($this->objectManager === null) {
            $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        }

        return $this->objectManager;
    }
}
