<?php

namespace App\Http\Controllers;

use App\Models\PasswordResets;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function urlForgot(PasswordResets $urlForgot)
    {
        return config('url.local') . '/reset/' . $urlForgot->token . '/password';
    }
}
