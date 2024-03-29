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
        // XXX check arg order
        return $this->hasMany(AttendanceLogData::class, 'log_id', 'id');
    }

    public function guild() {
        // XXX check arg order
        return $this->belongsTo(Guild::class, 'id', 'guild_id');
    }

    public function uploader() {
        // XXX check arg order
        return $this->belongsTo(User::class, 'uploader_id', 'id');
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
        // TODO: There's probably a better way of doing this.
        // Maybe another table for all players in each log?
        // Or an index
        AttendanceLogData::distinct()
                ->select('player')
                ->where('log_id', '=', $this->id)
                ->get();
    }
}
