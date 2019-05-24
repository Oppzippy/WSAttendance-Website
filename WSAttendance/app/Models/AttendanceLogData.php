<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AttendanceLog;

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

    public function attendanceLog() {
        return $this->belongsTo(AttendanceLog::class, 'log_id', 'id');
    }
}
