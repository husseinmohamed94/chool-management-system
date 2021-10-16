<?php


namespace App\Repository;


use App\Models\Grade;
use App\Models\Quizze;
use App\Models\Subject;
use App\Models\Teacher;

class QuizzeRepository implements QuizzeRepositoryInterface
{

    public function index()
    {
        $quizzs = Quizze::all();
      return view('pages.Quizzs.index',compact('quizzs'));
    }

    public function create()
    {
        $data['Grades'] =  Grade::all();
        $data['teachers']  = Teacher::all();
        $data['subjects']  = Subject::all();
        return view('pages.Quizzs.create',$data);
    }

    public function store($request)
    {
       try {
           $quizz = new Quizze();
           $quizz->name               = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $quizz->subject_id            = $request->Grade_id;
            $quizz->Grade_id            = $request->Grade_id;
            $quizz->Classroom_id        = $request->Classroom_id;
            $quizz->section_id        = $request->section_id;
            $quizz->teacher_id        = $request->teacher_id;


            $quizz->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Quizzs.index');


        }catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function edit($id)
    {
        $quizz = Quizze::findOrFail($id);
        $data['Grades'] =  Grade::all();
        $data['teachers']  = Teacher::all();
        $data['subjects']  = Subject::all();

        return view('pages.Quizzs.edit',compact('quizz'),$data);
    }

    public function update($request)
    {
        try {
            $quizz =  Quizze::findOrFail($request->id);
            $quizz->name               = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $quizz->subject_id            = $request->Grade_id;
            $quizz->Grade_id            = $request->Grade_id;
            $quizz->Classroom_id        = $request->Classroom_id;
            $quizz->section_id        = $request->section_id;
            $quizz->teacher_id        = $request->teacher_id;


            $quizz->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Quizzs.index');


        }catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy($request)
    {
        try {
            Quizze::destroy($request->id);
            toastr()->success(trans('messages.delete'));
            return redirect()->route('Quizzs.index');
        }catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
