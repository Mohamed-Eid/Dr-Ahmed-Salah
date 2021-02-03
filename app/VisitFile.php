<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitFile extends Model
{
    protected $guarded = [];

    protected $appends = ['file_path'];

    public function getFilePathAttribute(){
        return asset('uploads/visits/'.$this->file);
    }
}
