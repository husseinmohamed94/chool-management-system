<?php


namespace App\Repository;


use App\Models\FundAccount;
use App\Models\Payment;
use App\Models\ProcessingFee;
use App\Models\student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryInterface
{

    public function index()
    {
        $payments = Payment::all();
        return view('pages.payment.index',compact('payments'));
    }

    public function show($id)
    {
        $student =student::findOrfail($id);
        return view('pages.payment.create',compact('student'));

    }

    public function store($request)
    {
        DB::beginTransaction();

        try {

            // حفظ في جدوال اذن صرف


            $payment  = new Payment();
            $payment->date  = date('Y-m-d');
            $payment->student_id  = $request->student_id;
            $payment->amount  = $request->Debit;
            $payment->description  = $request->description;
            $payment->save();
            // حفظ في جدوال حساب الطالب
            $studentaccount = new StudentAccount();
            $studentaccount->date                        =  date('Y-m-d');
            $studentaccount->type                        = 'payment';
            $studentaccount->student_id                  =  $request->student_id;
            $studentaccount->payment_id                  = $payment->id;
            $studentaccount->Debit                       =  $request->Debit;
            $studentaccount->credit                      = 0.00;
            $studentaccount->description                 = $request->description;
            $studentaccount->save();
            // حفظ في جدول الصندوق
            $fund_account = new FundAccount();
            $fund_account->date                    =  date('Y-m-d');
            $fund_account->payment_id              = $payment->id;
            $fund_account->Debit                   =  0.00;
            $fund_account->credit                  =  $request->Debit;
            $fund_account->description             =  $request->description;
            $fund_account->save();

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('PaymentSudents.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        return view('pages.payment.edit',compact('payment'));
    }

    public function update($request)
    {
        DB::beginTransaction();

        try {
            // حفظ في جدوال اذن صرف
            $payment  =  Payment::findOrFail($request->id);
            $payment->date  = date('Y-m-d');
            $payment->student_id  = $request->student_id;
            $payment->amount  = $request->Debit;
            $payment->description  = $request->description;
            $payment->save();
            // حفظ في جدوال حساب الطالب
            $studentaccount =  StudentAccount::where('payment_id',$request->id)->first();
            $studentaccount->date                        =  date('Y-m-d');
            $studentaccount->type                        = 'payment';
            $studentaccount->student_id                  =  $request->student_id;
            $studentaccount->payment_id                  = $payment->id;
            $studentaccount->Debit                       =  $request->Debit;
            $studentaccount->credit                      = 0.00;
            $studentaccount->description                 = $request->description;
            $studentaccount->save();
            // حفظ في جدول الصندوق
            $fund_account =  FundAccount::where('payment_id',$request->id)->first();
            $fund_account->date                    =  date('Y-m-d');
            $fund_account->payment_id              = $payment->id;
            $fund_account->Debit                   =  0.00;
            $fund_account->credit                  =  $request->Debit;
            $fund_account->description             =  $request->description;
            $fund_account->save();

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('PaymentSudents.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Payment::destroy($request->id);
            toastr()->success(trans('messages.delete'));
            return redirect()->route('PaymentSudents.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
