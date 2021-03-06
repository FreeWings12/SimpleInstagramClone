<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Profile extends Model
{
    protected $guarded = [];

    public function profileImage() {
        $imagePath = $this->image ? $this->image : 'profile/mXyKJI714rTX5dTBXurgiuEQ78tzAOkXnwy4VxoG.png';
        return '/storage/'. $imagePath;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function followers() {
        return $this->belongsToMany(User::class);
    }

}
