<?php
return [
    '/' => ['home','index'],
    '/invoice/request' => ['invoice','request'],
    '/invoice/pay/{@invoice_key}' => ['selenium','load'],
    '/invoice/payy/{@invoice_key}' => ['selenium','start'],

    '/invoice/check' => ['invoice','check',[],''],
    '/invoice/check/{@invoice_key}' => ['invoice','check'],

    '/InvoiceNotFound' => ['error_handling','selenium',['code' => '001','bank_error' => true],''],
    '/TransactionFailed' => ['error_handling','selenium',['code' => '002','bank_error' => true],''],
    '/TransactionCanceled' => ['error_handling','selenium',['code' => '003','bank_error' => true],''],
    '/TransactionSuccessed' => ['error_handling','selenium',['code' => '004','bank_error' => true],''],
    '/payExpired' => ['error_handling','selenium',['code' => '005','bank_error' => true],''],
    '/tokenExpired' => ['error_handling','selenium',['code' => '006','bank_error' => true],''],
    '/tryLater' => ['error_handling','selenium',['code' => '007','bank_error' => true],''],

    '/invoice' => ['invoice','start',[],''],

    '/invoice/request/submit' => ['invoiceFormRequest','submit'],
    '/invoice/request/captcha' => ['invoiceFormRequest','resetCaptcha'],
    '/invoice/request/otp_request' => ['invoiceFormRequest','otp_request'],

    '/witcher/cleanit' => ['selenium','browserCleanHandler'],

    '/report/login' => ['administrator_home','home',[],'administrator/'],
    '/report/logout' => ['administrator_home','home',['logout'=>''],'administrator/'],
    '/report' => ['administrator_home','reportSpecial',['admin_part'=>'publicReports'],'administrator/'],
    '/report/publicReports' => ['administrator_home','reportSpecial',['admin_part'=>'publicReports'],'administrator/'],
    '/report/publicHome' => ['administrator_home','reportSpecial',['admin_part'=>'publicHome'],'administrator/'],

    '/hello/administrator' => ['administrator_home','start',[],'administrator/'],
    '/hello/administrator/home' => ['administrator_home','start',['admin_part'=>'home'],'administrator/'],
    '/hello/administrator/publicHome' => ['administrator_home','start',['admin_part'=>'publicHome'],'administrator/'],
    '/hello/administrator/publicReports' => ['administrator_home','start',['admin_part'=>'publicReports'],'administrator/'],
    '/hello/administrator/user' => ['administrator_home','start',['admin_part'=>'user'],'administrator/'],
    '/hello/administrator/icons' => ['administrator_home','start',['admin_part'=>'icons'],'administrator/'],
    '/hello/administrator/map' => ['administrator_home','start',['admin_part'=>'map'],'administrator/'],
    '/hello/administrator/notifications' => ['administrator_home','start',['admin_part'=>'notifications'],'administrator/'],
    '/hello/administrator/rtl' => ['administrator_home','start',['admin_part'=>'rtl'],'administrator/'],
    '/hello/administrator/tables' => ['administrator_home','start',['admin_part'=>'tables'],'administrator/'],
    '/hello/administrator/typography' => ['administrator_home','start',['admin_part'=>'typography'],'administrator/'],
    '/hello/administrator/upgrade' => ['administrator_home','start',['admin_part'=>'upgrade'],'administrator/'],
    '/hello/administrator/reports' => ['administrator_home','start',['admin_part'=>'reports'],'administrator/'],
    '/hello/administrator/banks' => ['administrator_home','start',['admin_part'=>'banks'],'administrator/'],

    '/m9toh9xiltv6lwcoj1rzbz0nbbyj6gnhccu10f47/accessPoint' => ['administrator_moduleAccess','start',[],'administrator/'],

    '/hello/administrator/login' => ['login','start',[],''],
    '/hello/administrator/logout' => ['login','start',['logout'=>''],''],


    '/lab' => ['lab','start',[],''],

    '/{@code}' => ['error_handling','index'], // by changing 404 path you have to change it in autoloader.php [line 142]

];