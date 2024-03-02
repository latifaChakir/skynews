<?php

namespace App\Utils;

use Illuminate\Support\Facades\Session;

class AuthenticationUtils
{

    public static function isAuthenticated() {
        $token = Session::get("token");

        return (bool) $token; // if token exist return true, else return false
    }

}
