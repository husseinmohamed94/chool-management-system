<?php

namespace App\Http\Controllers\onlineClasses;

use App\Http\Controllers\Controller;
use App\Repository\OnlineClassesRepositoryInterface;
use Illuminate\Http\Request;

class OnlineClassesController extends Controller
{
    protected $OnlineClass;
    public function  __construct(OnlineClassesRepositoryInterface $OnlineClass){
        $this->OnlineClass = $OnlineClass;
    }
    public function index()
    {
        return $this->OnlineClass->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->OnlineClass->create();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->OnlineClass->store($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->OnlineClass->edit($id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->OnlineClass->update($request);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->OnlineClass->destroy($request);

    }
    public function indirectCreate(Request $request){
        return $this->OnlineClass->indirectCreate($request);
    }
    public function indirectstore(Request $request){
        return $this->OnlineClass->indirectstore($request);
    }
}
