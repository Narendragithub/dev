<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
//        '/webapi/user',
//        '/webapi/user/login',
//        '/webapi/user/register',
//        '/webapi/user/change_password',
//        '/webapi/user/forgot_password',
//        '/webapi/checkemail',
//        '/webapi/projectlist',
//        '/webapi/projectdetail',
//        '/webapi/projectbasic',
//        '/webapi/projectdescription',
//        '/webapi/projectassets',
//        '/webapi/addrating',
        '/webapi/*',
        '/register/verify',
        '/project/upload',
        '/project/gettransferpro'
               
       
    ];
}
