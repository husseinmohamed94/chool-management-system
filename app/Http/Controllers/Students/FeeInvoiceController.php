<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\FeeInvoiceRepositoryInterface;
use Illuminate\Http\Request;

class FeeInvoiceController extends Controller
{
    protected $feeinvoice;

    public function  __construct(FeeInvoiceRepositoryInterface $feeinvoice){
        $this->feeinvoice = $feeinvoice;
    }
    public function index()
    {
      return $this->feeinvoice->index();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
       return $this->feeinvoice->store($request);
    }


    public function show($id)
    {
        return $this->feeinvoice->show($id);
    }


    public function edit($id)
    {
      return $this->feeinvoice->edit($id);
    }


    public function update(Request $request, $id)
    {
      return $this->feeinvoice->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->feeinvoice->destroy($request);
    }

    public function Get_amount($id){
        return $this->feeinvoice->Get_amount($id);
    }
}
