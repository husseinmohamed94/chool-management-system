<?php

namespace App\Http\Livewire;

use App\Models\Nationalite;
use App\Models\Religion;
use App\Models\Type_Blood;
use Livewire\Component;

class AddParent extends Component
{

    public $currentStep = 1,

     $Email, $Password,
     $Name_Father, $Name_Father_en, $Job_Father, $Job_Father_en, $National_ID_Father,
     $Passport_ID_Father, $Phone_Father, $Nationality_Father_id, $Blood_Type_Father_id, $Religion_Father_id, $Address_Father,
     $updateMode,$Name_Mother
    ,$Name_Mother_en,$Job_Mother,$Job_Mother_en,$National_ID_Mother
    ,$Passport_ID_Mother,$Phone_Mother,$Nationality_Mother_id,$Blood_Type_Mother_id
    ,$Religion_Mother_id,$Address_Mother;




    public function render()
    {
        return view('livewire.add-parent',[
            'Nationalities' => Nationalite::all(),
            'Religions'   => Religion::all(),
            'Type_Bloods' => Type_Blood::all(),
        ]);

    }
    //firstStepSubmit
    public function firstStepSubmit(){
        $this->currentStep = 2;
    }
    public function secondStepSubmit(){
        $this->currentStep = 3;
    }
    public function back($step){
        $this->currentStep = $step;
    }
}
