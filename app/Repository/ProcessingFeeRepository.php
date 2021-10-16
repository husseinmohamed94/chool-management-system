<?php


namespace App\Repository;


use App\Models\ProcessingFee;
use App\Models\student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ProcessingFeeRepository implements ProcessingFeeRepositoryInterface
{

    public function index()
    {
        $processingfees = ProcessingFee::all();
        return view('pages.ProcessingFee.index',compact('processingfees'));

    }

    public function show($id)
    {
        $student =student::findOrfail($id);
        return view('pages.ProcessingFee.create',compact('student'));

    }

    public function store($request)
    {

          DB::beginTransaction();

        try {

            // حفظ في جدوال استبعاد
            $processingFee = new ProcessingFee();
            $processingFee->date                 = date('Y-m-d');
            $processingFee->student_id           = $request->student_id;
            $processingFee->amount               =   $request->Debit;
            $processingFee->description          = $request->description;
            $processingFee->save();

        // حفظ في جدوال حساب الطالب
        $studentaccount = new StudentAccount();
        $studentaccount->date                        =  date('Y-m-d');
        $studentaccount->type                        = 'processingfee';
        $studentaccount->student_id                  =  $request->student_id;
        $studentaccount->processing_id               = $processingFee->id;
        $studentaccount->Debit                       = 0.00;
        $studentaccount->credit                      =  $request->Debit;
        $studentaccount->description                 = $request->description;
        $studentaccount->save();

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('ProcessingFee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function edit($id)
    {
        $processingFee = ProcessingFee::findOrFail($id);
        return view('pages.ProcessingFee.edit',compact('processingFee'));
    }

    public function update($request)
    {
        DB::beginTransaction();

        try {

            // حفظ في جدوال استبعاد
            $processingFee = ProcessingFee::findOrFail($request->id);
            $processingFee->date                 = date('Y-m-d');
            $processingFee->student_id           = $request->student_id;
            $processingFee->amount               =   $request->Debit;
            $processingFee->description          = $request->description;
            $processingFee->save();

            // حفظ في جدوال حساب الطالب
            $studentaccount = StudentAccount::where('processing_id',$request->id)->first();
            $studentaccount->date                        =  date('Y-m-d');
            $studentaccount->type                        = 'processingfee';
            $studentaccount->student_id                  =  $request->student_id;
            $studentaccount->processing_id               = $processingFee->id;
            $studentaccount->Debit                       = 0.00;
            $studentaccount->credit                      =  $request->Debit;
            $studentaccount->description                 = $request->description;
            $studentaccount->save();

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('ProcessingFee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {


        try {
            ProcessingFee::destroy($request->id);
            toastr()->success(trans('messages.delete'));
            return redirect()->route('ProcessingFee.index');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}
