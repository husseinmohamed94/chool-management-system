<?php


namespace App\Repository;



use App\Http\Traits\MeetingZoomTrait;
use App\Models\Grade;
use App\Models\OnlineClasse;
use MacsiDigital\Zoom\Facades\Zoom;

class OnlineClassesRepository implements OnlineClassesRepositoryInterface
{
    use MeetingZoomTrait;

    public function index()
    {

      $OnlineClasses = OnlineClasse::all();
      return view('pages.OnlineClasses.index',compact('OnlineClasses'));

    }

    public function create()
    {
        $Grades = Grade::all();
        return view('pages.OnlineClasses.create',compact('Grades'));

    }

    public function store($request)
    {
        try {

            $meeting = $this->createMeeting($request);

            $online_Classes = OnlineClasse::create([
                'integration'           =>true,
              'Grade_id'                => $request->Grade_id,
              'Classroom_id'            => $request->Classroom_id,
              'section_id'              => $request->section_id,
              'user_id'                 =>auth()->user()->id,
              'meeting_id'              => $meeting->id,
              'topic'                   => $request->topic,
              'start_at'                => $meeting->start_time,
              'duration'                => $meeting->duration,
              'password'                => $meeting->password,
              'start_url'               => $meeting->start_url,
              'join_url'                => $meeting->join_url,
            ]);

            toastr()->success(trans('messages.success'));
            return redirect()->route('online_Classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {

    }

    public function update($request)
    {

    }

    public function destroy($request)
    {
        try {
            $info = OnlineClasse::find($request->id);
            if ($info->integration == true){
                $meeting = zoom::meeting()->find($request->meeting_id);
                $meeting->delete();
              //  OnlineClasse::where('meeting_id',$request->id)->delete();
               OnlineClasse::destroy($request->id);
            }else{
                OnlineClasse::destroy($request->id);

            }

            toastr()->success(trans('messages.delete'));
            return redirect()->route('online_Classes.index');

        }catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function indirectCreate($request){
        $Grades = Grade::all();
        return view('pages.OnlineClasses.indirect',compact('Grades'));
    }

    public function indirectstore($request){
        try {



            $online_Classes = OnlineClasse::create([
                'integration'             =>false,
                'Grade_id'                => $request->Grade_id,
                'Classroom_id'            => $request->Classroom_id,
                'section_id'              => $request->section_id,
                'user_id'                 =>auth()->user()->id,
                'meeting_id'              => $request->meeting_id,
                'topic'                   => $request->topic,
                'start_at'                => $request->start_time,
                'duration'                => $request->duration,
                'password'                => $request->password,
                'start_url'               => $request->start_url,
                'join_url'                => $request->join_url,
            ]);

            toastr()->success(trans('messages.success'));
            return redirect()->route('online_Classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
