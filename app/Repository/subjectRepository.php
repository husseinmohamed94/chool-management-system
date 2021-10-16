<?php


namespace App\Repository;


use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;

class subjectRepository implements subjectRepositoryInterface
{

    public function index()
    {
        $subjects  = Subject::all();
        return view('pages.subject.index',compact('subjects'));


    }

    public function create()
    {
        $Grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.subject.create',compact('Grades','teachers'));
    }

    public function store($request)
    {
        try {
            $subject = new Subject();
            $subject->name                      =['en' => $request->name_en, 'ar' => $request->name_ar];
            $subject->Grade_id            = $request->Grade_id;
            $subject->Classroom_id        = $request->Class_id;
            $subject->teacher_id         = $request->teacher_id;

            $subject->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Subject.index');


        }catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $subject  = Subject::findOrFail($id);
        $Grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.subject.edit',compact('subject','Grades','teachers'));
    }

    public function update($request)
    {
        try {
            $subject =  Subject::findOrFail($request->id);
            $subject->name                      =['en' => $request->name_en, 'ar' => $request->name_ar];
            $subject->Grade_id            = $request->Grade_id;
            $subject->Classroom_id        = $request->Class_id;
            $subject->teacher_id         = $request->teacher_id;

            $subject->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Subject.index');


        }catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Subject::destroy($request->id);

            toastr()->success(trans('messages.delete'));
            return redirect()->route('Subject.index');


        }catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
