<?php


namespace App\Repository;


interface OnlineClassesRepositoryInterface
{
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request);
    public function destroy($request);
    public function indirectCreate($request);
    public function indirectstore($request);
}
