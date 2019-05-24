<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AttendanceLog;

class AttendanceLogData extends Model
{
    protected $table = 'attendance_log_data';
    protected $fillable = [
        'log_id',
        'time',
        'player',
        'key',
        'value',
    ];

    public function attendanceLog() {
        // XXX check arg order
        return $this->belongsTo(AttendanceLog::class, 'log_id', 'id');
    }
}
