<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['title', 'user_id', 'privacyStatus'];

    public static function isAlbumFromUser(Album $album) {
        return Album::where('albumId', '=', $album->id)
            ->where('user_id', '=', auth()->user()->id)
            ->count();
    }

    public function pictures() {
        return $this->belongsToMany(Picture::class, 'albums_pictures');
    }
}
