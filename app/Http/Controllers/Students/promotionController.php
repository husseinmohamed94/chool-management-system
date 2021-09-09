<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Repository\StudentPoromtionRepositoryInterface;
use Illuminate\Http\Request;

class promotionController extends Controller
{
    protected $poromtion;

    public function  __construct(StudentPoromtionRepositoryInterface $poromtion){

        $this->poromtion = $poromtion;
    }


    public function index()
    {
        return $this->poromtion->index();
    }


    public function create()
    {
        return $this->poromtion->create();
    }


    public function store(Request $request)
    {
        return $this->poromtion->store($request);
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Request $request , $id)
    {
        return $this->poromtion->destroy($request);
    }
}
