<?php


namespace App\Repository;


use App\Models\Grade;
use App\Models\Graduated;
use App\Models\student;

class GraduatedStudenRepository implements GraduatedStudenRepositoryInterface
{

    public function index()
    {
        $students =  student::onlyTrashed()->get();

        return view('pages.Students.graduate.index',compact('students'));
    }

    public function create()
    {
        $Grades = Grade::all();
      return view('pages.Students.graduate.create',compact('Grades'));
    }

    public function sofeDelete($request)
    {
        $students = student::where('Grade_id', $request->Grade_id)->where('Classroom_id', $request->Classroom_id)
            ->where('section_id', $request->section_id)->get();
        if ($students->count() < 1) {
            return redirect()->back()->with('error_promotions', __('لايوجد بيانات في جدول الطلاب'));
        }

        foreach ($students as $student) {
            $ids = explode(',', $student->id);
            student::whereIn('id', $ids)->Delete();
        }
        toastr()->success(trans('messages.success'));
        return redirect()->route('Graduated.index');
    }
    public function ReturnDate($request)
    {
        student::onlyTrashed()->where('id',$request->id)->first()->restore();
        toastr()->success(trans('messages.success'));
        return redirect()->route('Graduated.index');
    }
    public function destroy($request){
        student::onlyTrashed()->where('id',$request->id)->first()->forceDelete();
        toastr()->success(trans('messages.delete'));
        return redirect()->route('Graduated.index');
    }
}
