<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Http\Traits\AttachFilesTrait;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use AttachFilesTrait;
    public function index(){
        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(function ($collection){
        return [$collection->key => $collection->value];
       });

        return view('pages.settings.index', $setting);

    }

    public function update(Request $request){

        try {
            $info = $request->except('_token','_method','logo');

           foreach ($info as $key => $value){
                Setting::where('key',$key)->update(['value' => $value]);
            }
           if ($request->hasFile('logo')){
               $logo_name = $request->file('logo')->getClientOriginalName();
              Setting::where('key','logo')->update(['value' => $logo_name]);
               $this->deletefile('logo','attachments/logo');
               $this->uploadFile($request,'logo','logo');

           }

         /*   $key = array_keys($info);
            $value = array_values($info);

            for ($i = 0; $i<count($info); $i++){
                Setting::where('key',$key[$i])->update(['value' => $value[$i]]);

            }*/

            toastr()->success(trans('messages.update'));
            return redirect()->route('Setting.index');


        }catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

