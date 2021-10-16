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
        try {

            $question                   = new Question();
            $question->title            = $request->title;
            $question->answers          = $request->answers;
            $question->right_answer     = $request->right_answer;
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
        try {

            $question                   =  Question::findOrFail($request->id);
            $question->title            = $request->title;
            $question->answers          = $request->answers;
            $question->right_answer     = $request->right_answer;
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
