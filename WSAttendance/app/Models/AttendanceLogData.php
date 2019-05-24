<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceLogData extends Model
{
    protected $table = 'attendance_logs';
    protected $fillable = [
        'log_id',
        'time',
        'player',
        'key',
        'value',
    ];
}
