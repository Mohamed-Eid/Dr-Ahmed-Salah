<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientImage extends Model
{
    protected $guarded = [];

    protected $appends = ['image_path'];

    public function getImagePathAttribute(){
        return asset('uploads/examination_images/'.$this->image);
    }
}
