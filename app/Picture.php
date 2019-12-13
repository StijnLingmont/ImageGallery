<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $guarded = [];

    public static function isImageFromUser($pictureId) {
        return Picture::where('id', '=', $pictureId)
            ->where('user_id', '=', auth()->user()->id)
            ->get();
    }

    public function album() {
        return $this->belongsToMany(Album::class, 'albums_pictures')->withPivot('title', 'description');
    }
}
