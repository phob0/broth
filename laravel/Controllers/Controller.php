<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function apiSuccess($extra = [])
    {
        return [
            'success' => true,
            'extra' => $extra
        ];
    }

    public function apiError($message = 'A server error has occurred', $extra = [])
    {
        return response([
            'errors' => true,
            'message' => $message,
            'extra' => $extra
        ], 500);
    }
}
