<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendSmsRequest;
use App\Models\SmsLog;

class SendSmsController extends Controller
{
    /**
     * Send Sms and logs.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendSms(SendSmsRequest $request)
    {
        $validated = $request->validated();

        //SMS sending processes...

        $log = array_merge($validated, ['send_time' => now()->format('Y-m-d H:i:s')]);
        SmsLog::create($log);

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully sent the sms',
            'data' => $log
        ]);
    }

}
