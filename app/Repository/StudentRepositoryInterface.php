<?php
namespace App\Repository;

interface StudentRepositoryInterface{
        public function getAllStudent();
        public function create_student();
        public function Get_classrooms($id);
        public function Get_Sections($id);
        public function Store_studen($request);
        public function edit_studen($id);
        public function update_studen($request);
        //public function show_studen($id);

    public function destroy_studen($request);


}
