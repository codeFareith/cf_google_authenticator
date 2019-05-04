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

namespace CodeFareith\CfGoogleAuthenticator\Controller\Frontend;

use CodeFareith\CfGoogleAuthenticator\Domain\Form\SetupForm;
use CodeFareith\CfGoogleAuthenticator\Domain\Immutable\AuthenticationSecret;
use CodeFareith\CfGoogleAuthenticator\Domain\Model\FrontendUser;
use CodeFareith\CfGoogleAuthenticator\Domain\Repository\FrontendUserRepository;
use CodeFareith\CfGoogleAuthenticator\Service\GoogleQrCodeGenerator;
use CodeFareith\CfGoogleAuthenticator\Service\QrCodeGeneratorInterface;
use CodeFareith\CfGoogleAuthenticator\Utility\Base32Utility;
use CodeFareith\CfGoogleAuthenticator\Utility\PathUtility;
use CodeFareith\CfGoogleAuthenticator\Validation\Validator\SetupFormValidator;
use Exception;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException;
use TYPO3\CMS\Extbase\Mvc\Exception\StopActionException;
use TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException;
use TYPO3\CMS\Extbase\Object\InvalidClassException;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException;
use TYPO3\CMS\Lang\LanguageService;

/**
 * 2FA setup controller
 *
 * Handle any actions in the setup frontend plugin
 *
 * Class SetupController
 * @package CodeFareith\CfGoogleAuthenticator\Controller\Frontend
 */
class SetupController
    extends ActionController
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /** @var FrontendUserRepository */
    protected $frontendUserRepository;

    /** @var QrCodeGeneratorInterface */
    protected $qrCodeGenerator;

    /** @var SetupFormValidator */
    protected $setupFormValidator;

    /** @var LanguageService */
    protected $languageService;

    /** @var AuthenticationSecret */
    private $authenticationSecret;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public function __construct(
        FrontendUserRepository $frontendUserRepository,
        GoogleQrCodeGenerator $qrCodeGenerator,
        SetupFormValidator $setupFormValidator,
        LanguageService $languageService
    )
    {
        parent::__construct();

        $this->frontendUserRepository = $frontendUserRepository;
        $this->qrCodeGenerator = $qrCodeGenerator;
        $this->setupFormValidator = $setupFormValidator;
        $this->languageService = $languageService;
    }

    /**
     * @throws Exception
     */
    public function indexAction(): void
    {
        if ($this->isUserLoggedin()) {
            $authenticationSecret = $this->getAuthenticationSecret();
            $isEnabled = $this->isGoogleAuthenticatorEnabled();
            $setupForm = $this->getSetupForm();
            $qrCodeUri = $this->qrCodeGenerator->generateUri($authenticationSecret);

            $this->view->assignMultiple(
                [
                    'isEnabled' => $isEnabled,
                    'formData' => $setupForm,
                    'formName' => SetupForm::FORM_NAME,
                    'qrCodeUri' => $qrCodeUri
                ]
            );
        }
    }

    /**
     * @throws NoSuchArgumentException
     */
    public function initializeUpdateAction(): void
    {
        if ($this->request->hasArgument(SetupForm::FORM_NAME)) {
            $formObject = $this->getFormObject();
            $results = $this->setupFormValidator->validate($formObject);

            $this->request->setOriginalRequest(clone $this->request);
            $this->request->setOriginalRequestMappingResults($results);
        }
    }

    /**
     * @throws NoSuchArgumentException
     * @throws StopActionException
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     * @throws UnsupportedRequestTypeException
     */
    public function updateAction(): void
    {
        if ($this->isValidUpdateRequest()) {
            $user = $this->getFrontendUser();

            if ($user !== null) {
                $formData = (array)$this->request->getArgument(SetupForm::FORM_NAME);

                if ($this->request->hasArgument('enable')) {
                    $user->enableGoogleAuthenticator($formData['secret']);
                } else if ($this->request->hasArgument('disable')) {
                    $user->disableGoogleAuthenticator();
                }

                $this->frontendUserRepository->update($user);

                $this->addFlashMessage(
                    $this->getLanguageService()->sL(
                        PathUtility::makeLocalLangLinkPath(
                            'setup.update.success.body'
                        )
                    ),
                    $this->getLanguageService()->sL(
                        PathUtility::makeLocalLangLinkPath(
                            'setup.update.success.title'
                        )
                    ),
                    FlashMessage::OK
                );

                $this->redirect('index');
            }
        }

        $this->forward('index');
    }

    private function isUserLoggedin(): bool
    {
        return (bool)$GLOBALS['TSFE']->loginUser;
    }

    /**
     * @throws Exception
     */
    private function getAuthenticationSecret(): AuthenticationSecret
    {
        if ($this->authenticationSecret === null) {
            /** @noinspection PhpMethodParametersCountMismatchInspection */
            $this->authenticationSecret = $this->objectManager->get(
                AuthenticationSecret::class,
                $this->getIssuer(),
                $this->getUsername(),
                $this->getSecretKey()
            );
        }

        return $this->authenticationSecret;
    }

    private function getIssuer(): string
    {
        return \vsprintf(
            '%s - %s',
            [
                $this->getSiteName(),
                'Frontend'
            ]
        );
    }

    private function getSiteName(): string
    {
        return $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'];
    }

    private function getUsername(): string
    {
        /** @noinspection PhpInternalEntityUsedInspection */
        return $GLOBALS['TSFE']->fe_user->user['username'];
    }

    /**
     * @throws Exception
     */
    private function getSecretKey(): string
    {
        if ($this->isGoogleAuthenticatorEnabled()) {
            /** @noinspection PhpInternalEntityUsedInspection */
            $secretKey = $GLOBALS['TSFE']->fe_user->user['tx_cfgoogleauthenticator_secret'];
        } else {
            $secretKey = Base32Utility::generateRandomString(16);
        }

        return $secretKey;
    }

    private function isValidUpdateRequest(): bool
    {
        $mappingResults = $this->request->getOriginalRequestMappingResults();

        $hasErrors = $mappingResults->hasErrors();
        $hasArgument = $this->request->hasArgument(SetupForm::FORM_NAME);

        return (!$hasErrors && $hasArgument);
    }

    private function isGoogleAuthenticatorEnabled(): bool
    {
        /** @noinspection PhpInternalEntityUsedInspection */
        return (bool)$GLOBALS['TSFE']->fe_user->user['tx_cfgoogleauthenticator_enabled'];
    }

    /**
     * @throws Exception
     */
    private function getSetupForm(): SetupForm
    {
        /** @noinspection PhpMethodParametersCountMismatchInspection */
        $object = $this->objectManager->get(
            SetupForm::class,
            $this->getAuthenticationSecret()->getSecretKey(),
            ''
        );

        if (!$object instanceof SetupForm) {
            throw new InvalidClassException(
                \vsprintf(
                    'Invalid class. Expected "%s", got "%s".',
                    [
                        SetupForm::class,
                        \get_class($object),
                    ]
                )
            );
        }

        return $object;
    }

    /**
     * @throws NoSuchArgumentException
     */
    private function getFormObject()
    {
        $formData = (array)$this->request->getArgument(SetupForm::FORM_NAME);

        /** @noinspection PhpMethodParametersCountMismatchInspection */
        $formObject = $this->objectManager->get(
            SetupForm::class,
            $formData['secret'],
            $formData['oneTimePassword']
        );

        return $formObject;
    }

    private function getFrontendUser(): FrontendUser
    {
        $user = null;

        $userId = $this->getFrontendUserId();
        /** @var FrontendUser $user */
        $user = $this->frontendUserRepository->findByUid($userId);

        return $user;
    }

    private function getFrontendUserId(): int
    {
        /** @noinspection PhpInternalEntityUsedInspection */
        return $GLOBALS['TSFE']->fe_user->user['uid'];
    }

    private function getLanguageService(): LanguageService
    {
        return $this->languageService;
    }
}
