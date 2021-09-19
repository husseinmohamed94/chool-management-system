<?php


namespace App\Repository;


use App\Models\fee;
use App\Models\Grade;

class FeesRepository implements FeesRepositoryInterface
{

    public function index()
    {
        $Fees = fee::all();
       return view('pages.Fees.index',compact('Fees'));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('pages.Fees.create',compact('Grades'));    }
    public function store($request)
    {
       try {
              $fee = new fee();
              $fee->title                      =['en' => $request->title_en, 'ar' => $request->title_ar];
               $fee->amount              = $request->amount;
               $fee->Grade_id            = $request->Grade_id;
               $fee->Classroom_id        = $request->Classroom_id;
               $fee->academic_year       = $request->academic_year;
               $fee->feetype       = $request->feetype;
               $fee->description         = $request->description;

            $fee->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Fee.index');


        }catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

      //  return $request;
    }

    public function edit($id)
    {
        $fee = fee::findOrFail($id);
        $Grades = Grade::all();
        return view('pages.Fees.edit',compact('fee','Grades'));
    }
    public function update($request)
    {
        try {
            $fee =  fee::findOrFail($request->id);
            $fee->title               = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fee->amount              = $request->amount;
            $fee->Grade_id            = $request->Grade_id;
            $fee->Classroom_id        = $request->Classroom_id;
            $fee->academic_year       = $request->academic_year;
            $fee->feetype       = $request->feetype;
            $fee->description         = $request->description;

            $fee->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Fee.index');


        }catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public function destroy($raquest)
    {
        try {
            fee::destroy($raquest->id);
            toastr()->success(trans('messages.delete'));
            return redirect()->route('Fee.index');


        }catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
