<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use AttendanceLogData;

class AttendanceLog extends Model
{
    protected $table = 'attendance_log_meta';

    public static function uploadLog($guild, $uploader, $log) {
        $attendanceLog = self::Create(['guild_id' => $guild->id, 'uploader_id' => $uploader->id]);

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
}
