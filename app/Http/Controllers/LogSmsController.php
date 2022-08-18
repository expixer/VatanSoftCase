<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexLogSmsRequest;
use App\Http\Resources\LogSmsCollection;
use App\Http\Resources\LogSmsResource;
use App\Models\SmsLog;
use Illuminate\Http\Request;

class LogSmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexLogSmsRequest $request)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully listed the smses',
            'smses' => new LogSmsCollection(SmsLog::latest()->filter(
            $request->validated()
        )->get())
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return LogSmsResource
     */
    public function show($id)
    {
        return new LogSmsResource(SmsLog::findOrFail($id));
    }

}
