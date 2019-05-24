<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Guild;
use App\Models\User;

class GuildMember extends Model
{
    protected $table = 'guild_members';

    public function guild() {
        // XXX check arg order
        return $this->belongsTo(Guild::class, 'guild_id', 'id');
    }

    public function user() {
        // XXX check arg order
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
