<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\GraduatedStudenRepositoryInterface;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{
    protected $graduate;

    public function  __construct(GraduatedStudenRepositoryInterface $graduate){
        $this->graduate = $graduate;
    }
    public function index()
    {
        return $this->graduate->index();
    }


    public function create()
    {
      return $this->graduate->create();
    }


    public function store(Request $request)
    {
        return $this->graduate->sofeDelete($request);
    }




    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
       return $this->graduate->ReturnDate($request);
    }


    public function destroy(Request $request)
    {
       return $this->graduate->destroy($request);
    }
}
