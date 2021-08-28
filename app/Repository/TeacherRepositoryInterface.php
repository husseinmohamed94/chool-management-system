<?php
namespace App\Repository;

interface TeacherRepositoryInterface{

   // get all teacher

    public function getAllTeachers();
    public function getAllGenders();
    public function getAllSpecializations();
    public function StoreTeacher($request);
    public function EditTeacher($id);
    public function updateTeacher($request);
    public function deleteTeacher($request);


}
