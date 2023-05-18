<?php
namespace App\Http\Middlewares;

use App\Helpers\Logger;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class Auth implements IMiddleware {

    public function handle(Request $request): void 
    {
        session_start();
        if($_SESSION["logado"] === null) {
            response()->redirect(url('login'));
        }
    }
}