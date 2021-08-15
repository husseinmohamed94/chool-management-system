<?php

namespace App\Http\Controllers\Classroom;

use App\Http\Requests\StoreClassroom;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;
use  App\Http\Controllers\Controller;

class ClassroomController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $classrooms = Classroom::all();
        $grades = Grade::all();
      return view('pages.Classroom.index',compact('classrooms','grades'));

  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreClassroom $request)
  {

      $validated = $request->validated();

      try {

          $List_Classes = $request->List_Classes;
          foreach ($List_Classes as $list_Class) {
              $my_classes = new Classroom();
              $my_classes->Name_class = ['en' => $list_Class['Name_class_en'], 'ar' => $list_Class['Name']];
              $my_classes->Grade_id = $list_Class['Grade_id'];
              $my_classes->save();
          }
               toastr()->success(trans('messages.success'));
               return redirect()->route('classroom.index');

      }
      catch (\Exception $e){
          return  redirect()->back()->withErrors(['error'=>$e->getMessage()]);
      }


  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }


  public function update(StoreClassroom $request,$id)
  {
      $validated = $request->validated();

      try {

           $Classroom = Classroom::findorFail($request->id);

          $Classroom->update([
              $Classroom->Name_class = ['en' => $request->Name_class_en, 'ar' =>$request->Name],
              $Classroom->Grade_id = $request->Grade_id,

          ]);


          toastr()->success(trans('messages.success'));
          return redirect()->route('classroom.index');

      }
      catch (\Exception $e){
          return  redirect()->back()->withErrors(['error'=>$e->getMessage()]);
      }

  }


  public function destroy(StoreClassroom $request)
  {
      $Classroom = Classroom::findorFail($request->id)->delete();


      toastr()->success(trans('messages.success'));
      return redirect()->route('classroom.index');

  }

  public function dletet_all(Request $request){
     $delete_all_id = explode(",",$request->delete_all_id);

      Classroom::whereIn('id',$delete_all_id)->Delete();
      toastr()->success(trans('messages.success'));
      return redirect()->route('classroom.index');

  }


  public  function Filter_Classes(Request $request){


      $grades = Grade::all();
      $Search = Classroom::select('*')->where('Grade_id','=',$request->Grade_id)->get();
      return view('pages.Classroom.index',compact('grades'))->withDetails($Search);

  }
}


?>
