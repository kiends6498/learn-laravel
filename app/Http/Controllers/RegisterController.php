<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterFormRequest;


class RegisterController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function registerForm()
    {
        return view('register-1');
    }
    public function register(RegisterFormRequest $request)
    {
        $email = $request->input('email');
        $name = $request->input('name');
        $newPassword = $request->input('newPassword');
        $cfPassword = $request->input('cfPassword');

        $user_exists = $this->userRepository->findByEmail($email);
        if ($user_exists)
            return redirect()->back()->withErrors(['message' => __('messages.email_registered')]);

        $create_success = $this->userRepository->createNewUser($email, $name, $newPassword);
        if (!$create_success)
            return redirect()->back()->withErrors(['message' => __('messages.oops')]);
        
        return view('register-2');

    }
}