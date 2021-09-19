<?php


namespace App\Repository;


interface GraduatedStudenRepositoryInterface
{
    public function index();
    public function create();
    public function sofeDelete($request);
    public function ReturnDate($request);
    public function destroy($request);
}
