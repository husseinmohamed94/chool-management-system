<?php


namespace App\Repository;


use App\Models\FundAccount;
use App\Models\ReceiptStudent;
use App\Models\student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ReceiptStudentsRepository implements ReceiptStudentsRepositoryInterface
{

    public function index()
    {
        $receipt_students =ReceiptStudent::all();
        return view('pages.Receipt.index',compact('receipt_students'));
    }

    public function show($id)
    {
        $student =student::findOrfail($id);
        return view('pages.Receipt.create',compact('student'));
    }

    public function store($request)
    {
        DB::beginTransaction();

        try {
            // حفظ في جدول سندات القبض
            $receipt_students  = new ReceiptStudent();

            $receipt_students->date          = date('Y-m-d');
            $receipt_students->student_id    =$request->student_id;
            $receipt_students->Debit         = $request->debit;
            $receipt_students->description   = $request->description;
            $receipt_students->save();

            // حفظ في جدول الصندوق
        $fund_account = new FundAccount();
        $fund_account->date                    =  date('Y-m-d');
        $fund_account->receipt_id              =  $receipt_students->id;
        $fund_account->Debit                   =  $request->debit;
        $fund_account->credit                  =  0.00;
        $fund_account->description             =  $request->description;
        $fund_account->save();

        // جدول حساب الطالب
        $student_account = new StudentAccount();
        $student_account->date                  =    date('Y-m-d');
        $student_account->type                  =   'receipt';
        $student_account->student_id            = $request->student_id;
        $student_account->receipt_id            =  $receipt_students->id;
        $student_account->Debit                 = 0.00;
        $student_account->credit                = $request->debit;
        $student_account->description           =   $request->description;

        $student_account->save();


            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('ReceiptStudents.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function edit($id)
    {
        $receipt_student =ReceiptStudent::findOrFail($id);
        return view('pages.Receipt.edit',compact('receipt_student'));
    }

    public function update($request)
    {
        DB::beginTransaction();

        try {
            // حفظ في جدول سندات القبض
            $receipt_students  = ReceiptStudent::findOrFail($request->id);

            $receipt_students->date          = date('Y-m-d');
            $receipt_students->student_id    =$request->student_id;
            $receipt_students->Debit         = $request->debit;
            $receipt_students->description   = $request->description;
            $receipt_students->save();

            // حفظ في جدول الصندوق
            $fund_account =  FundAccount::where('receipt_id',$request->id)->first();
            $fund_account->date                    =  date('Y-m-d');
            $fund_account->receipt_id              =  $receipt_students->id;
            $fund_account->Debit                   =  $request->debit;
            $fund_account->credit                  =  0.00;
            $fund_account->description             =  $request->description;
            $fund_account->save();

            // جدول حساب الطالب
            $student_account =  StudentAccount::where('receipt_id',$request->id)->first();
            $student_account->date                  =    date('Y-m-d');
            $student_account->type                  =   'receipt';
            $student_account->student_id            = $request->student_id;
            $student_account->receipt_id            =  $receipt_students->id;
            $student_account->Debit                 = 0.00;
            $student_account->credit                = $request->debit;
            $student_account->description           =   $request->description;

            $student_account->save();


            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('ReceiptStudents.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            ReceiptStudent::destroy($request->id);
            toastr()->success(trans('messages.delete'));
            return redirect()->route('ReceiptStudents.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
