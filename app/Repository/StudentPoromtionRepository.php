<?php


namespace App\Repository;


use App\Models\Grade;
use App\Models\promotion;
use App\Models\student;
use Illuminate\Support\Facades\DB;

class StudentPoromtionRepository implements StudentPoromtionRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::all();
        return view('pages.Students.promotion.index',compact('Grades'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $students = student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)
                ->where('section_id',$request->section_id)->where('academic_year',$request->academic_year)->get();
            if ($students->count() < 1) {
                return redirect()->back()->with('error_promotions',__('لايوجد بيانات في جدول الطلاب'));
            }

            foreach ($students as $student) {
                $ids = explode(',',$student->id);
                student::whereIn('id',$ids)
                    ->update([
                        'Grade_id'                            => $request->Grade_id_new,
                        'Classroom_id'                        => $request->Classroom_id_new,
                        'section_id'                         => $request->section_id_new,
                        'academic_year'                      =>$request->academic_year_new,
                    ]);


                promotion::updateOrCreate([
                    'student_id'                    =>  $student->id,
                    'from_grade'                    =>  $request->Grade_id,
                    'from_classroom'                =>  $request->Classroom_id,
                    'from_setion'                   =>  $request->section_id,
                    'to_grade'                      => $request->Grade_id_new,
                    'to_classroom'                  => $request->Classroom_id_new,
                    'to_section'                    => $request->section_id_new,
                    'academic_year'                 =>$request->academic_year,
                    'academic_year_new'             =>$request->academic_year_new,

                ]);
            }
            DB::commit();

            toastr()->success(trans('messages.success'));
            return redirect()->route('promotion.index');
        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }




    }

    public function create(){
        $promotions = promotion::all();
        $data=[''];
        return view('pages.Students.promotion.managment',compact('promotions'));
    }
    public function  destroy($request)
    {
        DB::beginTransaction();
        try {
            if ($request->page_id == 1 ){
                $promotions = promotion::all();

                foreach ($promotions as $promotion){
                    $ids = explode(',',$promotion->student_id);
                    student::whereIn('id',$ids)
                        ->update([
                            'Grade_id'                            => $promotion->from_grade,
                            'Classroom_id'                        => $promotion->from_classroom,
                            'section_id'                         => $promotion->from_setion,
                            'academic_year'                      => $promotion->academic_year,
                        ]);
                        promotion::truncate();

                }
                DB::commit();
                toastr()->success(trans('messages.delete'));
                return redirect()->route('promotion.create');
                }
                else{
                    $promotion = promotion::findOrFail($request->id);
                    student::where('id',$promotion->student_id)
                        ->update([
                            'Grade_id'                            => $promotion->from_grade,
                            'Classroom_id'                        => $promotion->from_classroom,
                            'section_id'                         => $promotion->from_setion,
                            'academic_year'                      => $promotion->academic_year,
                        ]);
                promotion::destroy($request->id);
                    DB::commit();
                    toastr()->success(trans('messages.delete'));
                    return redirect()->back();
                }

        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
