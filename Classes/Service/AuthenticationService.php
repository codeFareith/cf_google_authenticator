<?php
/**
 * @author Robin von den Bergen <robinvonberg@gmx.de>
 */

namespace CodeFareith\CfGoogleAuthenticator\Service;

interface AuthenticationService
{
    public function init(): bool;

    public function authUser(array $array): int;
}
