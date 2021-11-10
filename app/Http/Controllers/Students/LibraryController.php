<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\library;
use App\Repository\LibraryRepositoryInterface;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    protected $library;

    public function  __construct(LibraryRepositoryInterface $library){

        $this->library = $library;
    }

    public function index()
    {
        return $this->library->index();
    }


    public function create()
    {
        return $this->library->create();

    }


    public function store(Request $request)
    {
        return $this->library->store($request);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return $this->library->edit($id);
    }


    public function update(Request $request, $id)
    {
        return $this->library->update($request);
    }

    public function download(Request $request, $filename)
    {
        return $this->library->download($filename);
    }



    public function destroy(Request $request,$id)
    {
        return $this->library->destroy($request);
    }

}
