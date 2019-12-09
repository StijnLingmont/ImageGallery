<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['title', 'userId', 'privacyStatus'];

    protected $primaryKey = 'albumId';

    public static function isAlbumFromUser(Album $album) {
        return Album::where('albumId', '=', $album->albumId)
            ->where('userId', '=', auth()->user()->userId)
            ->count();
    }
}
