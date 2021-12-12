<?php


namespace App\Http\Traits;


use Illuminate\Support\Facades\Storage;

trait AttachFilesTrait
{

    public function uploadFile($request,$name,$folder){
        $file_name = $request->file($name)->getClientOriginalName();

        $request->file($name)->storeAs('attachments/',$folder.'/'.$file_name,'uplode_attachments');
    }

   /* public function deletefile($name)
    {
        $exists = Storage::disk('uplode_attachments')->exists('attachments/Library/' . $name);
        if ($exists) {
            Storage::disk('uplode_attachments')->delete('attachments/Library/' . $name);

        }
    }*/

      public function deletefile($name,$folder)
        {
            $exists = Storage::disk('uplode_attachments')->exists($folder . $name);
            if ($exists) {
                Storage::disk('uplode_attachments')->delete($folder . $name);

            }
      }




}
