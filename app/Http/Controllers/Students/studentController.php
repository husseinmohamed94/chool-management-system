<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudent;
use App\Repository\StudentRepositoryInterface;
use Illuminate\Http\Request;

class studentController extends Controller
{

    protected $Student;

    public function  __construct(StudentRepositoryInterface $Student){
        $this->Student = $Student;
    }

    public function index()
    {
        return $this->Student->getAllStudent();
    }


    public function create()
    {
            return $this->Student->create_student();
    }


    public function store(StoreStudent $request)
    {
        return $this->Student->Store_studen($request);
    }


    public function show($id)
    {
      // return $this->Student->show_studen($id);
    }


    public function edit($id)
    {
        return  $this->Student->edit_studen($id);

    }


    public function update(StoreStudent $request, $id)
    {
       return $this->Student->update_studen($request);
    }


    public function destroy(Request $request)
    {
      return $this->Student->destroy_studen($request);
    }
    public function Get_classrooms($id){
        return $this->Student->Get_classrooms($id);
    }
    public function Get_Sections($id){
        return $this->Student->Get_Sections($id);
    }
}
