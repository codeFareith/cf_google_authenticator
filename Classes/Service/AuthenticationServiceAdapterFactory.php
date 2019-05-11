<?php
/**
 * @author Robin von den Bergen <robinvonberg@gmx.de>
 */

namespace CodeFareith\CfGoogleAuthenticator\Service;

interface AuthenticationServiceAdapterFactory
{
    public function create(): AuthenticationService;
}
