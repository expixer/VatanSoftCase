<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter($query, array $filters)
    {
        $query->when(isset($filters['start_date']) && $filters['end_date'] ?? false, fn($query) => $query->where(function ($query) use ($filters) {
            $start_date = Carbon::parse($filters['start_date'])
                ->toDateTimeString();
            $end_date = Carbon::parse($filters['end_date'])
                ->toDateTimeString();

            $query->whereBetween('send_time', [
                $start_date, $end_date
            ]);
        })
        );
    }

}
