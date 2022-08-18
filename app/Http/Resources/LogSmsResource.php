<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LogSmsResource extends JsonResource
{
    public static $wrap = 'sms';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'number' => $this->number,
            'title' => $this->title,
            'message' => $this->message,
            'send_time' => $this->send_time,
            'tag' => is_null($this->tag) ? 'empty' : $this->tag
        ];
    }

    public function with($request)
    {
        return ['status' => 'success'];
    }
}
