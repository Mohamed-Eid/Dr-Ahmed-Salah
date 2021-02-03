<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvestigationFile extends Model
{
    protected $guarded = [];

    protected $appends = ['file_path'];

    public function getFilePathAttribute(){
        return asset('uploads/investigations/'.$this->file);
    }
}
