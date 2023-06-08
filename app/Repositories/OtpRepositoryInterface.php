<?php

namespace App\Repositories;


interface OtpRepositoryInterface
{
    public function getByEmail(string $email);
    public function createOtp($email, $otp, $expiryTime);
    public function verifyOtpFromDatabase($email, $otpEntered);

}