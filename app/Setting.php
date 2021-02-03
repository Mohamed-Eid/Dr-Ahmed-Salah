<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];
    // protected $casts = [
    //     'details' => 'array',
    // ];

    protected  $appends = ['image_path'];


    public function getImagePathAttribute(){
        return asset('uploads/setting_images/'.$this->value);
    }

    public function details_obj(){
        return json_decode($this->details);
    }

    public function find_by_id($id){
        foreach ($this->details_obj()->items as $item) {
            if($id == $item->id)
                return $item;
        }
        return null;
    }


    public function find_by_value($value){
        foreach ($this->details_obj()->items as $item) {
            if($value == $item->value)
                return $item;
        }
        return null;
    }


    public function updateCount($key){
        $items = $this->details_obj()->items;
        $newItem = $this->find_by_id($key);
        $newItem->count++;
        foreach ($items as $item) {
            if($item->id == $newItem->id){
                $item->count += 1;
            }
        }

        $data = [
            "cols_name" => $this->details_obj()->cols_name,
            "items"     => $items
        ];
        
        $this->details =  $data;

        $this->save();

        return $items;
    }

    public function updateCountByValue($value){
        $items = $this->details_obj()->items;
        $newItem = $this->find_by_value($value);
        $newItem->count++;
        foreach ($items as $item) {
            if($item->id == $newItem->id){
                $item->count += 1;
            }
        }

        $data = [
            "cols_name" => $this->details_obj()->cols_name,
            "items"     => $items
        ];
        
        $this->details =  $data;

        $this->save();

        return $items;
    }

}
