<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{

    // public function index(Request $request){
    //     $class = (isset(\request()->class) && \request()->class != '') ? \request()->class : 'general';
    //     $settings_classes = Setting::select('class')->distinct()->pluck('class');
    //     $settings = Setting::whereClass($class)->get();
    //     return view('settings.index',compact('class', 'settings_classes', 'settings'));
    // }

    public function update(Request $request){

        foreach (request()->except(['_token','_method','class']) as $key => $value) {
            $setting = Setting::find($key);
            //dd($value['logo']);
            if(isset($value['logo'])){
                delete_image('setting_images',$setting->image);
                $logo = $value['logo'];
                unset($value['logo']);
                $value['value'] = upload_image_without_resize('setting_images',$logo );
            }
            
            $setting->update($value);
        }

        session()->flash('success', __('site.saved_successfuly'));

        return redirect()->back();
    }

    public function index_system(Request $request){
        
        $settings = Setting::whereClass('system')->get();

        // dd($settings);
        return view('settings.index',compact('settings'));
    
    }

    public function update_system(Request $request){
        foreach (request()->except(['_token','_method','class']) as $key => $value) {

            if($value['value'] == null)
            {
                Alert::error('', "Plz Enter a valid input");
                return redirect()->back();
            }

            $setting = Setting::find($key);
            
            $items = $setting->details_obj()->items;
            
            $items[] = [
                'id' => (get_last_item_id($setting->details_obj()->items)->id ?? 0) +1,
                'value' => $value['value'],
                'count' => 0,
            ];


            $data = [
                "cols_name" => $setting->details_obj()->cols_name,
                "items"     => $items
            ];

            $setting->details =  $data;

            if(isset($value['image'])){
                delete_image('setting_images',$setting->image);
                $value['image'] = upload_image_without_resize('setting_images',$value['image']);
            }
            $setting->save();
        }
        Alert::success('Settings Updated Succesfully', '');
        return redirect()->back();
    }

    public function delete_system(Request $request, Setting $setting,$item_id){

            
        $items = $setting->details_obj()->items;
        // dd($items);
        $data_items = [];
        foreach ($items as $index => $item) {
            // if($item->id == $item_id){
            //     unset($items[$index]);
            // }
            if($item->id != $item_id){
                $data_items[] = $items[$index];
            }
        }
        // dd($data_items);
        $data = [
            "cols_name" =>  $items = $setting->details_obj()->cols_name,
            "items"     => $data_items
        ];

        // dd($data);
        $setting->details =  $data;


        $setting->save();
        
        Alert::success('Settings Deleted Succesfully', '');
        return redirect()->back();
    }
}
