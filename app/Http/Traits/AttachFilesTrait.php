<?php


namespace App\Http\Traits;


use Illuminate\Support\Facades\Storage;

trait AttachFilesTrait
{

    public function uploadFile($request,$name){
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('attachments/Library/',$file_name,'uplode_attachments');
    }

    public function deletefile($name){
        $exists = Storage::disk('uplode_attachments')->exists('attachments/Library/'.$name);
        if ($exists){
            Storage::disk('uplode_attachments')->delete('attachments/Library/'.$name);

        }
    }


}
