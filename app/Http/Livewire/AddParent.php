<?php

namespace App\Http\Livewire;

use App\Models\MyParent;
use App\Models\Nationalite;
use App\Models\parent_Attachment;
use App\Models\Religion;
use App\Models\Type_Blood;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads;
    public  $catchError,$updateMode = false,$photos,$show_table=true,$Parent_id;
    public $SuccessMessage = '';

    public $currentStep = 1,
     $Email, $Password,
     $Name_Father, $Name_Father_en, $Job_Father, $Job_Father_en, $National_ID_Father,
     $Passport_ID_Father, $Phone_Father, $Nationality_Father_id,
        $Blood_Type_Father_id, $Religion_Father_id, $Address_Father,

     $Name_Mother,$Name_Mother_en,$Job_Mother,$Job_Mother_en,$National_ID_Mother
    ,$Passport_ID_Mother,$Phone_Mother,$Nationality_Mother_id,$Blood_Type_Mother_id
    ,$Religion_Mother_id,$Address_Mother;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName,[
            'Email'                     => 'required|email',
            'National_ID_Father'         =>'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Father'         =>'min:10|max:10',
            'Phone_Father'               =>'regex:/^([0-9\s\-\+(\)]*)$/|min:10',
            'National_ID_Mother'          =>'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Mother'         =>'min:10|max:10',
            'Phone_Mother'              =>'regex:/^([0-9\s\-\+(\)]*)$/|min:10',
        ]);
    }


    public function render()
    {
        return view('livewire.add-parent',[
            'Nationalities' => Nationalite::all(),
            'Religions'   => Religion::all(),
            'Type_Bloods' => Type_Blood::all(),
            'my_parents' => MyParent::all(),
        ]);

    }

    public  function showformadd(){
        $this->show_table = false;
    }
    //firstStepSubmit
    public function firstStepSubmit(){
        $validatedData = $this->validate([
            'Email'                              =>'required|unique:my_parents,Email,'.$this->id,
            'Password'                           =>'required',
            'Name_Father'                        =>'required',
            'Name_Father_en'                     =>'required',
            'Job_Father'                         =>'required',
            'Job_Father_en'                      =>'required',
            'National_ID_Father'                 =>'required|unique:my_parents,National_ID_Father,'.$this->id,
            'Passport_ID_Father'                 =>'required|unique:my_parents,Passport_ID_Father,'.$this->id,
            'Phone_Father'                        =>'regex:/^([0-9\s\-\+(\)]*)$/|min:10',
            'Nationality_Father_id'              =>'required',
            'Blood_Type_Father_id'               =>'required',
            'Religion_Father_id'                =>'required',
            'Address_Father'                   =>'required',
        ]);


        $this->currentStep = 2;
    }
    public function secondStepSubmit(){

        $validatedData = $this->validate([
            'Name_Mother'                       =>'required',
            'Name_Mother_en'                    =>'required',
            'Job_Mother'                        =>'required',
            'Job_Mother_en'                     =>'required',
            'National_ID_Mother'                =>'required|unique:my_parents,National_ID_Mother,'.$this->id,
            'Passport_ID_Mother'                =>'required|unique:my_parents,Passport_ID_Mother,'.$this->id,
            'Phone_Mother'                      =>'regex:/^([0-9\s\-\+(\)]*)$/|min:10',
            'Nationality_Mother_id'              =>'required',
            'Blood_Type_Mother_id'              =>'required',
            'Religion_Mother_id'                =>'required',
            'Address_Mother'                    =>'required',

        ]);

        $this->currentStep = 3;
    }

    public function firstStepSubmit_edit(){
        $this->updateMode = true;
        $this->currentStep = 2 ;
    }
    public function secondStepSubmit_edit(){
        $this->updateMode = true;
        $this->currentStep = 3 ;
    }

    public function submitForm(){

        try {
            $My_Parent = new MyParent();
            // Father_INPUTS
            $My_Parent->Email = $this->Email;
            $My_Parent->Password = Hash::make($this->Password);
            $My_Parent->Name_Father = ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father];
            $My_Parent->National_ID_Father = $this->National_ID_Father;
            $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
            $My_Parent->Phone_Father = $this->Phone_Father;
            $My_Parent->Job_Father = ['en' => $this->Job_Father_en, 'ar' => $this->Job_Father];
            $My_Parent->Passport_ID_Father = $this->Passport_ID_Father;
            $My_Parent->Nationality_Father_id = $this->Nationality_Father_id;
            $My_Parent->Blood_Type_Father_id = $this->Blood_Type_Father_id;
            $My_Parent->Religion_Father_id = $this->Religion_Father_id;
            $My_Parent->Address_Father = $this->Address_Father;

            // Mother_INPUTS
            $My_Parent->Name_Mother = ['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother];
            $My_Parent->National_ID_Mother = $this->National_ID_Mother;
            $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $My_Parent->Phone_Mother = $this->Phone_Mother;
            $My_Parent->Job_Mother = ['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother];
            $My_Parent->Passport_ID_Mother = $this->Passport_ID_Mother;
            $My_Parent->Nationality_Mother_id = $this->Nationality_Mother_id;
            $My_Parent->Blood_Type_Mother_id = $this->Blood_Type_Mother_id;
            $My_Parent->Religion_Mother_id = $this->Religion_Mother_id;
            $My_Parent->Address_Mother = $this->Address_Mother;
            $My_Parent->save();
            if(!empty($this->photos)){
                foreach ($this->photos as $photo){
                    $photo->storeAs($this->National_ID_Father,$photo->getClientOriginalName(), $disk = 'parent_attachments');
                    parent_Attachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => MyParent::latest()->first()->id,
                    ]);
                }
            }
            $this->SuccessMessage = trans('messages.success');
            $this->clearForm();
            $this->currentStep = 1;
        }

        catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };

    }

    public function edit($id){

        try {
           $this->show_table = false;
           $this->updateMode = true;
            $My_Parent =  MyParent::where('id',$id)->first();
            $this->Parent_id =$id;
             $this->Email =    $My_Parent->Email ;
            $this->Password = $My_Parent->Password;

            $this->Name_Father              =   $My_Parent->getTranslation('Name_Father','ar');
            $this->Name_Father_en           =   $My_Parent->getTranslation('Name_Father','en');
            $this->National_ID_Father       =   $My_Parent->National_ID_Father  ;
            $this->Passport_ID_Father       =   $My_Parent->Passport_ID_Father ;
            $this->Phone_Father             =   $My_Parent->Phone_Father  ;
            $this->Job_Father               =   $My_Parent->getTranslation('Job_Father','ar');
            $this->Job_Father_en               =   $My_Parent->getTranslation('Job_Father','en');
            $this->Passport_ID_Father       =   $My_Parent->Passport_ID_Father ;
            $this->Nationality_Father_id    =   $My_Parent->Nationality_Father_id  ;
            $this->Blood_Type_Father_id     =   $My_Parent->Blood_Type_Father_id  ;
            $this->Religion_Father_id       =   $My_Parent->Religion_Father_id;
             $this->Address_Father          =   $My_Parent->Address_Father ;

            // Mother_INPUTS
            $this->Name_Mother                    = $My_Parent->getTranslation('Name_Father','ar');
            $this->Name_Mother_en                 = $My_Parent->getTranslation('Name_Father','en');
            $this->National_ID_Mother             = $My_Parent->National_ID_Mother;
            $this->Passport_ID_Mother             = $My_Parent->Passport_ID_Mother;
            $this->Phone_Mother                   = $My_Parent->Phone_Mother;
            $this->Job_Mother                     = $My_Parent->getTranslation('Job_Mother','ar');
            $this->Job_Mother_en                  = $My_Parent->getTranslation('Job_Mother','en');
            $this->Passport_ID_Mother             = $My_Parent->Passport_ID_Mother;
            $this->Nationality_Mother_id          = $My_Parent->Nationality_Mother_id;
            $this->Blood_Type_Mother_id           = $My_Parent->Blood_Type_Mother_id;
            $this->Religion_Mother_id             = $My_Parent->Religion_Mother_id;
            $this->Address_Mother                 = $My_Parent->Address_Mother;

        }

        catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };
    }
    public function submitForm_edit(){
        if ($this->Parent_id){
            $parent =MyParent::find($this->Parent_id);
            $parent->update([
                'Email'                                     => $this->Email,
                'Password'                                  => $this->Password,
                'Name_Father'                               => ['en' => $this->Name_Father_en, 'ar' => $this->Name_Father],
                'National_ID_Father'                        => $this->National_ID_Father,
                'Passport_ID_Father'                        => $this->Passport_ID_Father,
                'Phone_Father'                              => $this->Phone_Father,
                'Job_Father'                                => ['en' => $this->Job_Father, 'ar' => $this->Job_Father],
                'Nationality_Father_id'                     => $this->Nationality_Father_id,
                'Blood_Type_Father_id'                      => $this->Blood_Type_Father_id,
                'Religion_Father_id'                        => $this->Religion_Father_id,
                'Address_Father'                            => $this->Address_Father,
                'Name_Mother'                               => ['en' => $this->Name_Mother, 'ar' => $this->Name_Mother],
                'National_ID_Mother'                        => $this->National_ID_Mother,
                'Phone_Mother'                              => $this->Phone_Mother,
                'Job_Mother'                                => ['en' => $this->Job_Mother, 'ar' => $this->Job_Mother],
                'Passport_ID_Mother'                        => $this->Passport_ID_Mother,
                'Nationality_Mother_id'                     => $this->Nationality_Mother_id,

            ]);
        }
        return redirect()->to('/add_Parent');
    }
    public function clearForm(){
       $this->Email                      = '';
       $this->Password                   = '';
       $this->Name_Father                = '';
       $this->Name_Father_en             = '';
       $this->Job_Father                 = '';
       $this->Job_Father_en              = '';
       $this->National_ID_Father         = '';
       $this->Passport_ID_Father         = '';
        $this->Phone_Father              = '';
        $this->Nationality_Father_id     = '';
        $this->Blood_Type_Father_id      = '';
        $this->Religion_Father_id        = '';
        $this->Address_Father            = '';
        $this->Name_Mother               = '';
        $this->Name_Mother_en            = '';
        $this->Job_Mother                = '';
        $this->Job_Mother_en             = '';
        $this->National_ID_Mother        = '';
        $this->Passport_ID_Mother        = '';
        $this->Phone_Mother              = '';
        $this->Nationality_Mother_id     = '';
        $this->Blood_Type_Mother_id      = '';
}
    public function back($step){
        $this->currentStep = $step;
    }
    public function delete($id){
   /*     $this->Parent_id = $id ;
      $My_parent =  MyParent::where('id',$id)->first();
      $parent_attachment = parent_Attachment::where('parent_id',$id)->first();
    if(!empty($parent_attachment->parent_id)){
        Storage::disk('parent_attachments')->delete($My_parent->id);

        return redirect()->to('/add_Parent');
    }else{

        MyParent::findOrFail($id)->delete();
        return redirect()->to('/add_Parent');
    }*/
        MyParent::findOrFail($id)->delete();
        return redirect()->to('/add_Parent');
    }

}
