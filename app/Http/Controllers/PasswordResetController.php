<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
// use App\Repositories\OtpRepository;
// use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\CustomFormRequest;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\OtpFormRequest;
use App\Http\Requests\EmailFormRequest;

use App\Repositories\OtpRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

use App\Jobs\SendEmailJob;



class PasswordResetController extends Controller
{

    private $otpRepository;
    private $userRepository;

    public function __construct(OtpRepositoryInterface $otpRepository, UserRepositoryInterface $userRepository)
    {
        $this->otpRepository = $otpRepository;
        $this->userRepository = $userRepository;
    }

    public function sendOtpViaEmail(EmailFormRequest $request)
    {
        $otp = random_int(100000, 999999);
        $expiryTime = now()->addMinutes(3);

        SendEmailJob::dispatch($request->email, $otp);

        $this->otpRepository->createOtp($request->email, $otp, $expiryTime);
        return redirect()->route('verifyOTPForm', ['email' => $request->email]);
        // return Redirect::to('/verify-otp?email=' . urlencode($request->email));
        
    }

    public function sendOTPForm()
    {
        return view('forgot-password-1');
    }

    public function verifyOTPForm(Request $request)
    {
        $email = $request->query('email');
        return view('forgot-password-2', compact('email'));
    }

    public function resendOtp(Request $request)
    {
        $email = $request->query('email');
        $otp = random_int(100000, 999999);
        $expiryTime = now()->addMinutes(3);

        SendEmailJob::dispatch($email, $otp);

        $this->otpRepository->createOtp($email, $otp, $expiryTime);
        return Redirect::to('/verify-otp?email=' . urlencode($email));

    }

    public function verifyOTP(OtpFormRequest $request)
    {
        $otpEntered = $request->input('otp1') . $request->input('otp2') . $request->input('otp3') . $request->input('otp4') . $request->input('otp5') . $request->input('otp6');
        $email = $request->input('email');

        $result = $this->otpRepository->verifyOtpFromDatabase($email, $otpEntered);
        if ($result === 'reset-password') {
            // return redirect('/reset-password?email=' . urlencode($email));
            return redirect()->route('resetPasswordForm', ['email' => $email]);
        } elseif ($result === 'invalid-otp') {
            return redirect()->back()->withErrors(['message' => __('messages.otp_not_match')]);
        } elseif ($result === 'expired-otp') {
            return redirect()->back()->withErrors(['message' => __('messages.otp_expiry')]);
        } elseif ($result === 'otp-not-found') {
            return redirect()->back()->withErrors(['message' => __('messages.otp_not_found')]);
        }
    }

    public function resetPasswordForm(Request $request)
    {
        $email = $request->query('email');
        return view('forgot-password-3', compact('email'));
    }

    public function resetPassword(CustomFormRequest $request)
    {
        $email = $request->input('email');
        $newPassword = $request->input('newPassword');
        $cfPassword = $request->input('cfPassword');

        $result = $this->userRepository->resetPasswordRepo($email, $newPassword);
        if (!$result)
            return redirect()->back()->withErrors(['message' => __('messages.oops')]);

        // return Redirect::to('/password-reset-success');
        return redirect()->route('showResetSuccess');

    }

    public function showResetSuccess()
    {
        return view('forgot-password-4');
    }

    public function loginForm()
    {
        return view('login');
    }

    public function login(LoginFormRequest $request)
    {
        // $email = $request->input('email');
        // $password = $request->input('password');

        // $result = $this->userRepository->findByEmail($email);

        // if (!$result)
        //     return redirect()->back()->withErrors(['message' => __('messages.email_not_registered')]);

        // if (!password_verify($password, $result->password))
        //     return redirect()->back()->withErrors(['message' => __('messages.password_not_match')]);

        // Auth::login($result);
        // return redirect()->route('homelogin');


        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('homelogin');
        }

        return redirect()->back()->withErrors(['message' => __('messages.invalid_credentials')]);
    }

    public function homenonlogin()
    {
        return view('home-non-login');
    }
    public function homelogin()
    {
        return view('home-login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('homenonlogin');
    }
}