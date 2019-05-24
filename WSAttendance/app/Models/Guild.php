<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\AttendanceLog;

class Guild extends Model
{
    protected $table = 'guilds';

    public function owner() {
        // XXX check arg order
        return $this->belongsTo(User::class, 'id', 'owner_id');
    }

    public function logs() {
        // XXX check arg order
        return $this->hasMany(AttendanceLog::class, 'guild_id', 'id');
    }

    public function members() {
        // XXX check arg order
        return $this->hasMany(GuildMember::class, 'guild_id', 'id');
    }
}
