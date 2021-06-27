<?php
return [
    '/' => ['home','index'],
    '/auth_credentials/manage' => ['authCreds', 'index'],
    '/auth_credentials/manage/add' => ['authCreds', 'add'],
    '/auth_credentials/manage/makeDefault/{@id}' => ['authCreds', 'makeDefault'],
    '/auth_credentials/manage/update' => ['authCreds', 'update'],
    '/auth_credentials/manage/delete/{@id}' => ['authCreds', 'delete'],


    '/selenium/initiate' => ['selenium', 'initiate'],
    '/selenium/run/{@id}' => ['selenium', 'run'],
    '/selenium/cancel/{@id}' => ['selenium', 'cancel'],


    '/lab' => ['lab','start',[],''],

    '/{@code}' => ['error_handling','index'], // by changing 404 path you have to change it in autoloader.php [line 142]

];