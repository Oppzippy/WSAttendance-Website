<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AttendanceLogData;

class AttendanceLog extends Model
{
    protected $table = 'attendance_logs';
    protected $fillable = [
        'guild_id',
        'uploader_id',
    ];


    public function logData() {
        return $this->hasMany(AttendanceLogData::class, 'log_id', 'id');
    }

    public function guild() {
        return $this->hasOne(Guild::class, 'id', 'guild_id');
    }

    public static function uploadLog($guild, $uploader, $log) {
        $attendanceLog = self::Create([
            'guild_id' => $guild->id,
            'uploader_id' => $uploader->id,
        ]);

        foreach ($log as $update) {
            $timestamp = $update['timestamp'];
            foreach ($update['updates'] as $player => $changes) {
                foreach ($changes as $key => $value) {
                    AttendanceLogData::create([
                        'log_id' => $attendanceLog->id,
                        'time' => $timestamp,
                        'player' => $player,
                        'key' => $key,
                        'value' => $value,
                    ]);
                }
            }
        }
    }

    public function convertToArray() {
        $updates = AttendanceLogData::where('log_id', '=', $this->id)
                ->orderBy('time', 'asc')
                ->get();
        if (!empty($updates)) {
            return [
                'updates' => $updates,
                'start_time' => $updates[0]['timestamp'],
                'end_time' => $updates[count($updates)-1]['timestamp'],
            ];
        }
    }

    public function getPlayers() {
        AttendanceLogData::distinct()
                ->select('player')
                ->where('log_id', '=', $this->id)
                ->get();
    }
}
