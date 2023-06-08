<?php

namespace App\Repositories;

use App\Models\Otp;
use App\Repositories\OtpRepositoryInterface;

class OtpRepository implements OtpRepositoryInterface
{
    protected $otpModel;
    public function __construct(Otp $otpModel)
    {
        $this->otpModel = $otpModel;
    }
    public function create(array $data)
    {
        return $this->otpModel->create($data);
    }

    public function getByEmail(string $email)
    {
        return $this->otpModel->where('email', $email)->first();
    }

    public function createOtp($email, $otp, $expiryTime)
    {
        return $this->otpModel->updateOrCreate(
            ['email' => $email],
            ['otp' => $otp, 'expiryTime' => $expiryTime]
        );
    }

    public function verifyOtpFromDatabase($email, $otpEntered)
    {
        $otpRecord = $this->getByEmail($email);

        if (!$otpRecord)
            return 'otp-not-found';

        $otpFromDatabase = $otpRecord->otp;
        $expiryTime = $otpRecord->expiryTime;

        if (now()->isAfter($expiryTime))
            return 'expired-otp';

        if ($otpFromDatabase !== $otpEntered)
            return 'invalid-otp';

        return 'reset-password';

    }
}