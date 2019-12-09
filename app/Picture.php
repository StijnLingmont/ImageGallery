<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $guarded = [];

    protected $primaryKey = 'imageId';

    public static function isImageFromUser($pictureId) {
        return Picture::where('imageId', '=', $pictureId)
            ->where('userId', '=', auth()->user()->userId)
            ->get();
    }
}
