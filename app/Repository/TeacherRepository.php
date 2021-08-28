<?php
namespace App\Repository;


use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class TeacherRepository implements  TeacherRepositoryInterface{

    public function getAllTeachers(){

        return  Teacher::all();
    }

    public function getAllGenders(){
        return Gender::all();
    }
    public function getAllSpecializations(){
        return  Specialization::all();
    }
    public function StoreTeacher($request){

        try {
            $Teacher = new Teacher();
            $Teacher->Email                     = $request->Email;
            $Teacher->Password                  = Hash::make($request->Password);
            $Teacher->Name                      =['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teacher->Specialization_id         = $request->Specialization_id;
            $Teacher->Gender_id                 = $request->Gender_id;
            $Teacher->Joining_Date              = $request->Joining_Date;
            $Teacher->Address                   = $request->Address;
            $Teacher->save();
            toastr()->success(trans('messages.success'));
          return redirect()->route('Teachers.create');

        }catch  (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function EditTeacher($id){
        return Teacher::findOrFail($id);

    }
    public function updateTeacher($request){
        try {

            $Teacher = Teacher::findOrFail($request->id);
            $Teacher->Email                     = $request->Email;
            $Teacher->Password                  = Hash::make($request->Password);
            $Teacher->Name                      =['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $Teacher->Specialization_id         = $request->Specialization_id;
            $Teacher->Gender_id                 = $request->Gender_id;
            $Teacher->Joining_Date              = $request->Joining_Date;
            $Teacher->Address                   = $request->Address;
            $Teacher->save();
            toastr()->success(trans('messages.update'));
            return redirect()->route('Teachers.index');

        }catch  (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function deleteTeacher($request){
         Teacher::findOrFail($request->id)->delete();
        toastr()->success(trans('messages.delete'));
        return redirect()->route('Teachers.index');
    }
}
