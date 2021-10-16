<?php


namespace App\Repository;


use App\Models\fee;
use App\Models\Fee_invoice;
use App\Models\Grade;
use App\Models\student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class FeeInvoiceRepository implements FeeInvoiceRepositoryInterface
{

    public function index()
    {
         $fee_invoices = Fee_invoice::all();
         $Grades = Grade::all();
        return view('pages.FeesInvoices.index',compact('fee_invoices','Grades'));

    }

    public function show($id)
    {
        $student = student::findOrFail($id);
        $fees = fee::where('Classroom_id',$student->Classroom_id)->get();
        return view('pages.FeesInvoices.create',compact('student','fees'));
    }

    public function store($request)
    {
        $List_Fees = $request->List_Fees;

        DB::beginTransaction();

        try {

            foreach ($List_Fees as $List_Fee) {
                // حفظ البيانات في جدول فواتير الرسوم الدراسية
                $Fees = new Fee_invoice();
                $Fees->invoice_date = date('Y-m-d');
                $Fees->student_id = $List_Fee['student_id'];
                $Fees->Grade_id = $request->Grade_id;
                $Fees->Classroom_id = $request->Classroom_id;;
                $Fees->fee_id = $List_Fee['fee_id'];
                $Fees->amount = $List_Fee['amount'];
                $Fees->description = $List_Fee['description'];
                $Fees->save();

                // حفظ البيانات في جدول حسابات الطلاب
                $StudentAccount = new StudentAccount();
                $StudentAccount->date = date('Y-m-d');
                $StudentAccount->type = 'invoice';
                $StudentAccount->fee_invoice_id = $Fees->id;
                $StudentAccount->student_id = $List_Fee['student_id'];
               // $StudentAccount->Grade_id = $request->Grade_id;
                //$StudentAccount->Classroom_id = $request->Classroom_id;;
                $StudentAccount->Debit = $List_Fee['amount'];
                $StudentAccount->credit = 0.00;
                $StudentAccount->description = $List_Fee['description'];
                $StudentAccount->save();
            }

            DB::commit();

            toastr()->success(trans('messages.success'));
            return redirect()->route('FeeInvoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $fee_invoices = Fee_invoice::findOrFail($id);
        $fees = fee::where('Classroom_id',$fee_invoices->Classroom_id)->get();
        return view('pages.FeesInvoices.edit',compact('fee_invoices','fees'));
    }

    public function update($request)
    {

        DB::beginTransaction();

        try {

                // حفظ البيانات في جدول فواتير الرسوم الدراسية
                $Fees = Fee_invoice::findOrFail($request->id);
                $Fees->fee_id =$request->fee_id;
                $Fees->amount = $request->amount;
                $Fees->description =$request->description;
                $Fees->save();

                // حفظ البيانات في جدول حسابات الطلاب
                $StudentAccount =  StudentAccount::where('fee_invoice_id',$request->id)->first();
                $StudentAccount->Debit = $request->amount;
                $StudentAccount->credit = 0.00;
                $StudentAccount->description = $request->description;
                $StudentAccount->save();


            DB::commit();

            toastr()->success(trans('messages.success'));
            return redirect()->route('FeeInvoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Fee_invoice::destroy($request->id);
            toastr()->success(trans('messages.delete'));
            return redirect()->route('FeeInvoices.index');


        }catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function Get_amount($id){
        $List_Fees = Fee_invoice::where('fee_id',$id)->pluck('amount','id');
        return $List_Fees;
    }
}
