<?php


namespace App\Repository;


use App\Http\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\library;
use App\Models\Teacher;

class LibraryRepository implements LibraryRepositoryInterface
{
    use AttachFilesTrait;

    public function index()
    {
        $librarys = library::all();
        return view('pages.library.index',compact('librarys'));
    }

    public function create()
    {
        $Grades = Grade::all();

        return view('pages.library.create',compact('Grades'));
    }

    public function store($request)
    {
       try {

             library::create([

                 'title'                 => ['ar' => $request->title_ar , 'en' => $request->title_en] ,
                 'file_name'             => $request->file('file_name')->getClientOriginalName(),
                 'Grade_id'              => $request->Grade_id,
                 'Classroom_id'          => $request->Classroom_id,
                 'section_id'            => $request->section_id,
                 'teacher_id'            => 1,
             ]);

             $this->uploadFile($request,'file_name','Library');

            toastr()->success(trans('messages.success'));
            return redirect()->route('library.index');

        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $Grades = Grade::all();
        $library = library::FindOrFail($id);
        return view('pages.library.edit',compact('Grades','library'));
    }

    public function update($request)
    {
        try {
            $book = library::findOrFail($request->id);
            $book->title  =['ar' => $request->title_ar , 'en' => $request->title_en];



            if ($request->hasfile('file_name')){
                $this->deletefile($book->file_name,'attachments/Library/');
                $this->uploadFile($request,'file_name','Library');

               $file_name_new = $request->file('file_name')->getClientOriginalName();
               $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;

            }

            $book->Grade_id     = $request->Grade_id;
            $book->Classroom_id     = $request->Classroom_id;
            $book->section_id     = $request->section_id;
            $book->teacher_id     =1;
            $book->save();
            toastr()->success(trans('messages.update'));
            return redirect()->route('library.index');

        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {

            library::destroy($request->id);


            toastr()->success(trans('messages.delete'));
            return redirect()->route('library.index');

        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function download($filename)
    {
        return response()->download('public_path'('attachments/Library/'.$filename));
    }


}
