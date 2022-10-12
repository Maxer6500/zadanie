<?php

namespace App\Http\Controllers;

use App\Models\UserCode;
use App\Models\User;
use Illuminate\Http\Request;
use Smsapi\Client\Curl\SmsapiHttpClient;
use Smsapi\Client\SmsapiClient;
use Smsapi\Client\Service\SmsapiComService;
use Smsapi\Client\Feature\Sms\Bag\SendSmsBag;
use Smsapi\Client\Feature\Sms\Data\Sms;

use Exception;

class SmsController extends Controller
{
    public function generateCode()
    {
        $code = rand(1000, 9999);

        UserCode::updateOrCreate(
            ['user_id' => auth()->user()->id],
            ['code' => $code]
        );

        $phone = auth()->user()->phone;

        $sms = (new SmsapiHttpClient())
            ->smsapiPlService('zIpBKGbtkYmVMygYmXFHcX2Vi5p3E3e5FEc7niDI')
            ->smsFeature()
            ->sendSms(SendSmsBag::withMessage($phone, $code));

        var_dump($sms);


        return redirect()->route('2fa.index');

    }

}
