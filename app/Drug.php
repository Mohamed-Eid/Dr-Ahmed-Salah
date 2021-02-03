<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function in_procedures()
    {
        return $this->hasMany(InProcedure::class);
    }
}
