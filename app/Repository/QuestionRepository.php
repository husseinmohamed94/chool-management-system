<?php


namespace App\Repository;


use App\Models\Question;
use App\Models\Quizze;

class QuestionRepository implements QuestionRepositoryInterface
{

    public function index()
    {
        $questions = Question::all();
       return view('pages.Questions.index',compact('questions'));
    }

    public function create()
    {
        $quizzes = Quizze::all();
        return view('pages.Questions.create',compact('quizzes'));

    }

    public function store($request)
    {
        $validatedData = $request->validate([
            'title_en' => 'required',
            'title_ar' => 'required',
            'answers_en' => 'required',
            'answers_ar' => 'required',
            'right_answer_en' => 'required',
            'right_answer_ar' => 'required',
            'score' => 'required|numeric',
            'quizze_id' => 'required',

        ]);
        try {

            $question                   = new Question();
            $question->title            = ['en' => $request->title_en,'ar'=>$request->title_ar];
            $question->answers          = ['en' => $request->answers_en,'ar'=>$request->answers_ar];
            $question->right_answer     = ['en' =>$request->right_answer_en,'ar'=>$request->right_answer_ar];
            $question->score            = $request->score;
            $question->quizze_id        = $request->quizze_id;

            $question->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('questions.index');


        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $quizzes = Quizze::all();
        return view('pages.Questions.edit',compact('question','quizzes'));
    }

    public function update($request)
    {
        $validatedData = $request->validate([
            'title_en' => 'required',
            'title_ar' => 'required',
            'answers_en' => 'required',
            'answers_ar' => 'required',
            'right_answer_en' => 'required',
            'right_answer_ar' => 'required',
            'score' => 'required|numeric',
            'quizze_id' => 'required',

        ]);
        try {

            $question                   =  Question::findOrFail($request->id);
            $question->title            = ['en' => $request->title_en,'ar'=>$request->title_ar];
            $question->answers          = ['en' => $request->answers_en,'ar'=>$request->answers_ar];
            $question->right_answer     = ['en' =>$request->right_answer_en,'ar'=>$request->right_answer_ar];
            $question->score            = $request->score;
            $question->quizze_id        = $request->quizze_id;

            $question->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('questions.index');


        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {

           Question::destroy($request->id);

            toastr()->success(trans('messages.delete'));
            return redirect()->route('questions.index');


        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
