<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $fillable = [
        'content',
        'channel_id',
        'message_id',
        'user_id',
        'created_at',
    ];

    public static function getMessage($id)
    {
        $message = Message::find($id);
        return $message;
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Message::class, 'message_id', 'id');
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class, 'message_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    private function _formatedDate($_date)
    {
        $now = time();
        $date = strtotime($_date);
        $diff = $now - $date;

        if ($diff < 60) {
            return sprintf($diff > 1 ? '%s seconds ago' : 'a second ago', $diff);
        }

        $diff = floor($diff / 60);

        if ($diff < 60) {
            return sprintf($diff > 1 ? '%s minutes ago' : 'one minute ago', $diff);
//            return __('one minute ago | %s minutes ago', [$diff]);
        }

        $diff = floor($diff / 60);

        if ($diff < 24) {
            return sprintf($diff > 1 ? '%s hours ago' : 'an hour ago', $diff);
        }

        $diff = floor($diff / 24);

        if ($diff < 7) {
            return sprintf($diff > 1 ? '%s days ago' : 'yesterday', $diff);
        }

        return strftime('%A %e %B %Y %H:%M:%S', $date);
    }

    protected function formatedDate(): Attribute
    {
        $string = $this->_formatedDate($this->created_at);
        return Attribute::make(
            get: fn($value) => $string,
        );
    }
}
