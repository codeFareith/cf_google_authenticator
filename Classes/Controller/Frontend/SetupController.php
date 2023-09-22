<?php declare(strict_types=1);
/**
 * Class SetupController
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

namespace CodeFareith\CfGoogleAuthenticator\Controller\Frontend;

use CodeFareith\CfGoogleAuthenticator\Domain\Form\SetupForm;
use CodeFareith\CfGoogleAuthenticator\Domain\Immutable\AuthenticationSecret;
use CodeFareith\CfGoogleAuthenticator\Domain\Model\FrontendUser;
use CodeFareith\CfGoogleAuthenticator\Domain\Repository\FrontendUserRepository;
use CodeFareith\CfGoogleAuthenticator\Utility\Base32Utility;
use CodeFareith\CfGoogleAuthenticator\Utility\PathUtility;
use CodeFareith\CfGoogleAuthenticator\Validation\Validator\SetupFormValidator;
use Exception;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Http\ForwardResponse;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException;
use TYPO3\CMS\Core\Localization\LanguageService;
use function get_class;
use function vsprintf;

/**
 * Two-factor authentication setup controller
 *
 * A controller that allows users to set up the
 * two-factor authentication for their respective frontend accounts.
 *
 * @package CodeFareith\CfGoogleAuthenticator\Controller\Frontend
 * @since   1.0.0
 */
class SetupController
    extends ActionController
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @var FrontendUserRepository
     */
    protected $frontendUserRepository;

    /**
     * @var SetupFormValidator
     */
    protected $setupFormValidator;

    /**
     * @var LanguageService
     */
    protected $languageService;

    /**
     * @var Context
     */
    protected $context;

    /**
     * @var AuthenticationSecret
     */
    private $authenticationSecret;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    public function __construct(
        FrontendUserRepository $frontendUserRepository,
        SetupFormValidator $setupFormValidator,
        LanguageService $languageService,
        Context $context
    )
    {
        $this->frontendUserRepository = $frontendUserRepository;
        $this->setupFormValidator = $setupFormValidator;
        $this->languageService = $languageService;
        $this->context = $context;
    }

    /**
     * @return ResponseInterface
     * @throws Exception
     */
    public function indexAction(): ResponseInterface
    {
        if ($this->isUserLoggedin()) {
            $authenticationSecret = $this->getAuthenticationSecret();
            $isEnabled = $this->isGoogleAuthenticatorEnabled();
            $setupForm = $this->getSetupForm();

            $this->view->assignMultiple(
                [
                    'isEnabled' => $isEnabled,
                    'formData' => $setupForm,
                    'formName' => SetupForm::FORM_NAME,
                    'authenticationSecret' => $authenticationSecret,
                ]
            );
        }

        return $this->htmlResponse($this->view->render());
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
     * @return ResponseInterface
     * @throws NoSuchArgumentException
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     */
    public function updateAction(): ResponseInterface
    {
        if ($this->isValidUpdateRequest()) {
            $user = $this->initializeFrontendUser();

            if ($user !== null) {
                $formData = (array)$this->request->getArgument(SetupForm::FORM_NAME);

                if ($this->request->hasArgument('enable')) {
                    $user->enableGoogleAuthenticator($formData['secret']);
                } elseif ($this->request->hasArgument('disable')) {
                    $user->disableGoogleAuthenticator();
                }

                $this->frontendUserRepository->update($user);

                $this->addSuccessMessage();

                return $this->redirect('index');
            }
        }

        return new ForwardResponse('index');
    }

    /**
     * @throws AspectNotFoundException
     */
    private function isUserLoggedin(): bool
    {
        return (bool)$this->context->getPropertyFromAspect(
            'frontend.user',
            'isLoggedIn'
        );
    }

    /**
     * @throws Exception
     */
    private function getAuthenticationSecret(): AuthenticationSecret
    {
        if ($this->authenticationSecret === null) {
            $this->authenticationSecret = GeneralUtility::makeInstance(
                AuthenticationSecret::class,
                $this->getIssuer(),
                $this->getFrontendUser()['username'],
                $this->getSecretKey()
            );
        }

        return $this->authenticationSecret;
    }

    private function getIssuer(): string
    {
        return vsprintf(
            '%s - %s',
            [
                $this->getSiteName(),
                'Frontend',
            ]
        );
    }

    private function getSiteName(): string
    {
        return $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'];
    }

    /**
     * @throws Exception
     */
    private function getSecretKey(): string
    {
        if ($this->isGoogleAuthenticatorEnabled()) {
            $secretKey = $this->getFrontendUser()['tx_cfgoogleauthenticator_secret'];
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
        return (bool)$this->getFrontendUser()['tx_cfgoogleauthenticator_enabled'];
    }

    /**
     * @throws Exception
     */
    private function getSetupForm(): SetupForm
    {
        $object = GeneralUtility::makeInstance(
            SetupForm::class,
            $this->getAuthenticationSecret()->getSecretKey(),
            ''
        );

        if (!$object instanceof SetupForm) {
            throw new Exception(
                vsprintf(
                    'Invalid class. Expected "%s", got "%s".',
                    [
                        SetupForm::class,
                        get_class($object),
                    ]
                )
            );
        }

        return $object;
    }

    /**
     * @throws NoSuchArgumentException
     */
    private function getFormObject(): SetupForm
    {
        $formData = (array)$this->request->getArgument(SetupForm::FORM_NAME);

        /** @var SetupForm $formObject */
        $formObject = GeneralUtility::makeInstance(
            SetupForm::class,
            $formData['secret'],
            $formData['oneTimePassword']
        );

        return $formObject;
    }

    private function initializeFrontendUser(): FrontendUser
    {
        $userId = $this->getFrontendUser()['uid'];
        $user = $this->frontendUserRepository->findByUid($userId);

        return $user;
    }

    private function getLanguageService(): LanguageService
    {
        return $this->languageService;
    }

    private function addSuccessMessage(): void
    {
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
    }

    private function getFrontendUser(): array
    {
        return $this->request->getAttribute('frontend.user')->user;
    }
}
