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
namespace CodeFareith\CfGoogleAuthenticator\Domain\Immutable;

/**
 * Immutable authentication secret
 *
 * This class represents an immutable authentication secret,
 * which means that an instance of this is class is not
 * meant to change its properties.
 * It is used by the authentication services and QR image generators
 * and consists of an issuer, an account name and a secret key.
 *
 * @see \CodeFareith\CfGoogleAuthenticator\Service\GoogleAuthenticatorService
 * @see \CodeFareith\CfGoogleAuthenticator\Service\QrImageGeneratorInterface
 *
 * Class AuthenticationSecret
 * @package CodeFareith\CfGoogleAuthenticator\Domain\Immutable
 */
class AuthenticationSecret implements ImmutableInterface
{
    /*─────────────────────────────────────────────────────────────────────────────*\
            Constants
    \*─────────────────────────────────────────────────────────────────────────────*/
    /** @var string */
    public const BASE_URL = 'otpauth://totp/';

    /*─────────────────────────────────────────────────────────────────────────────*\
            Properties
    \*─────────────────────────────────────────────────────────────────────────────*/
    /** @var string */
    protected $issuer;
    /** @var string */
    protected $accountName;
    /** @var string */
    protected $secretKey;
    /** @var string */
    protected $uri;
    /** @var string */
    protected $label;

    /*─────────────────────────────────────────────────────────────────────────────*\
            Methods
    \*─────────────────────────────────────────────────────────────────────────────*/
    /**
     * @throws \InvalidArgumentException
     */
    public function __construct(string $issuer, string $accountName, string $secretKey)
    {
        if(\strpos($issuer.$accountName, ':') !== false) {
            throw new \InvalidArgumentException(
                'Neither the \'issuer\' parameter nor the \'accountName\' parameter may contain a colon.'
            );
        }

        $this->issuer = $issuer;
        $this->accountName = $accountName;
        $this->secretKey = $secretKey;
    }

    /**
     * @throws \InvalidArgumentException
     */
    public static function create(string $issuer, string $accountName, string $secretKey): self
    {
        return new self($issuer, $accountName, $secretKey);
    }

    public function getUri(): string
    {
        if($this->uri === null) {
            $params = [
                'secret' => $this->getSecretKey(),
                'issuer' => \rawurlencode($this->getIssuer())
            ];

            $query = \http_build_query($params);
            $queryDecoded = \rawurldecode($query);

            $this->uri = \vsprintf(
                '%s%s?%s',
                [
                    self::BASE_URL,
                    \rawurlencode($this->getLabel()),
                    $queryDecoded
                ]
            );
        }

        return $this->uri;
    }

    public function getLabel(): string
    {
        if($this->label === null) {
            $this->label = \vsprintf(
                '%s:%s',
                [
                    $this->getIssuer(),
                    $this->getAccountName()
                ]
            );
        }

        return $this->label;
    }

    public function getIssuer(): string
    {
        return $this->issuer;
    }

    public function getAccountName(): string
    {
        return $this->accountName;
    }

    public function getSecretKey(): string
    {
        return $this->secretKey;
    }
}