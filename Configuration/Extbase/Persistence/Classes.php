<?php

return [
    \CodeFareith\CfGoogleAuthenticator\Domain\Model\FrontendUser::class => [
        'tableName' => 'fe_users',
    ],
    \CodeFareith\CfGoogleAuthenticator\Domain\Model\BackendUser::class => [
        'tableName' => 'be_users',
    ],
];
