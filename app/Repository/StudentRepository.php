<?php
namespace App\Repository;



use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\MyParent;
use App\Models\Nationalite;
use App\Models\Section;
use App\Models\student;
use App\Models\Type_Blood;
use Illuminate\Support\Facades\Hash;

class StudentRepository implements StudentRepositoryInterface {

        public function getAllStudent(){
        $students =  student::all();
        return view('pages.Students.index',compact('students'));
    }
        public function create_student(){
    $data['my_classes']  = Grade::all();
    $data['parents']     = MyParent::all();
    $data['Genders']     = Gender::all();
    $data['nationals']   = Nationalite::all();
    $data['bloods']      = Type_Blood::all();
    return view('pages.Students.create',$data);
}
        public function Get_classrooms($id){
        $list_classes = Classroom::where('Grade_id',$id)->pluck('Name_class','id');
        return $list_classes;
}
        public function Get_Sections($id){
        $list_section = Section::where('class_id',$id)->pluck('Name_section','id');
        return $list_section;
}
        public function Store_studen($request)
        {
            try {
                $students = new student;
                $students->name                    =['en' =>$request->name_en , 'ar' =>$request->name_ar];
                $students->email                    = $request->email;
                $students->password                 = Hash::make($request->password);
                $students->gender_id                    = $request->gender_id;
                $students->nationalitie_id                  = $request->nationalitie_id;
                $students->blood_id                 = $request->blood_id;
                $students->Date_Birth                   = $request->Date_Birth;
                $students->Grade_id                 = $request->Grade_id;
                $students->Classroom_id                 = $request->Classroom_id;
                $students->section_id                   = $request->section_id;
                $students->parent_id                    = $request->parent_id;
                $students->academic_year                    = $request->academic_year;
                $students->save();
                toastr()->success(trans('messages.success'));
                return redirect()->route('Students.index');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }

        }
        public function edit_studen($id){

            $Students  =  student::findOrFail($id);
            $data['Grades']  = Grade::all();
            $data['parents']     = MyParent::all();
            $data['Genders']     = Gender::all();
            $data['nationals']   = Nationalite::all();
            $data['bloods']      = Type_Blood::all();
            return view('pages.Students.edit',$data,compact('Students'));

        }
        public function update_studen($request){
            try {
                $students = student::findOrFail($request->id);
                $students->name                    =['en' =>$request->name_en , 'ar' =>$request->name_ar];
                $students->email                    = $request->email;
                $students->password                 = Hash::make($request->password);
                $students->gender_id                    = $request->gender_id;
                $students->nationalitie_id                  = $request->nationalitie_id;
                $students->blood_id                 = $request->blood_id;
                $students->Date_Birth                   = $request->Date_Birth;
                $students->Grade_id                 = $request->Grade_id;
                $students->Classroom_id                 = $request->Classroom_id;
                $students->section_id                   = $request->section_id;
                $students->parent_id                    = $request->parent_id;
                $students->academic_year                    = $request->academic_year;
                $students->save();
                toastr()->success(trans('messages.update'));
                return redirect()->route('Students.index');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }

      /* public function show_studen($id){
            $Student   =  student::findOrFail($id);
            $data['Grades']  = Grade::all();
            $data['parents']     = MyParent::all();
            $data['Genders']     = Gender::all();
            $data['nationals']   = Nationalite::all();
            $data['bloods']      = Type_Blood::all();
            return view('pages.Students.show',$data,compact('Student'));
        }*/

        public function destroy_studen($request){
            //student::findOrFail($request->id)->delete();
            student::destroy($request->id);
             toastr()->success(trans('messages.delete'));
             return redirect()->route('Students.index');

    }

}
