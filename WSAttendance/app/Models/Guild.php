<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\AttendanceLog;

class Guild extends Model
{
    protected $table = 'guilds';

    public function owner() {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function logs() {
        return $this->hasMany(AttendanceLog::class, 'guild_id', 'id');
    }
}
