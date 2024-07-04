<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // Check if the email exists
        $user = \App\Models\User::where('email', $request->email)->first();
        if (!$user) {
            return $this->sendFailedLoginResponse($request, 'email');
        }

        // Check if the password is correct
        if (!Auth::attempt($this->credentials($request))) {
            return $this->sendFailedLoginResponse($request, 'password');
        }

        if ($this->attemptLogin($request)) {
            if ($request->hasSession()) {
                $request->session()->put('auth.password_confirmed_at', time());
            }

            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendFailedLoginResponse(Request $request, $errorType = null)
    {
        $message = trans('auth.failed');
        if ($errorType == 'email') {
            $message = 'Email salah';
        } elseif ($errorType == 'password') {
            $message = 'Password salah';
        }

        throw ValidationException::withMessages([
            $this->username() => [$message],
        ]);
    }
}

