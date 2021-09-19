<?php


namespace App\Repository;


interface StudentAccountRepositoryInterface
{

    public function index();
    public function create();
    public function store($raquest);
    public function edit($id);
    public function update($raquest);
    public function destroy($raquest);
}
