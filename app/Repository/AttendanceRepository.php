<?php


namespace App\Repository;


use App\Models\Attendance;
use App\Models\Grade;
use App\Models\student;
use App\Models\Teacher;

class AttendanceRepository implements AttendanceRepositoryInterface
{

    public function index()
    {
     //   $attendances = Attendance::all();
        $Grades  =Grade::with(['Section'])->get();
        $list_Grades = Grade::all();
        $teachers = Teacher::all();

        return view('pages.Attendance.index',compact('Grades','list_Grades','teachers'));
    }

    public function show($id)
    {
        $students = student::with('attendance')->where('section_id',$id)->get();
        return view('pages.Attendance.create',compact('students'));

    }

    public function store($request)
    {
        try {
            foreach ($request->attndances as $studentid => $attendance){
                if($attendance == 'presence'){
                    $attencene_status  = true;
                }elseif($attendance == 'absent'){
                    $attencene_status = false;
                }

                Attendance::create([
                    'student_id'         => $studentid ,
                    'Grade_id'           => $request->grade_id,
                    'Classroom_id'       => $request->classroom_id,
                    'section_id'         => $request->section_id,
                    'teacher_id'         => 1,
                    'attendence_date'    =>  date('Y-m-d'),
                    'attencene_status'   => $attencene_status,
                ]);

            }
            toastr()->success(trans('messages.success'));
            return redirect()->route('Attendance.index');

        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    public function update($request)
    {
        // TODO: Implement update() method.
    }

    public function destroy($request)
    {
        // TODO: Implement destroy() method.
    }
}
