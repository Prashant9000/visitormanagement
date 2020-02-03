<?php

namespace App\Http\Controllers;

use App\Models\UsersInfo;
use App\Models\VisitorsLog;
use App\Models\VisitorsNote;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitorsLogController extends Controller
{
    protected $visitors_log=null;
    protected $userDetails=null;
    protected $visitors_note=null;
    protected $user=null;
    public function __construct(VisitorsLog $visitors_log, User $user, VisitorsNote $visitors_note, UsersInfo $userDetails){
        $this->visitors_log=$visitors_log;
        $this->visitors_note=$visitors_note;
        $this->userDetails=$userDetails;
        $this->user=$user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->visitors_log=$this->visitors_log->getNameById();
      
        return view('superadmin.visitors_log.index')->with('user',$this->visitors_log);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->user= $this->user->where('role','!=','superAdmin')->where('role','!=','admin')->get();
        $return_user=array();
        foreach($this->user as $key=>$value){
            $return_user[$value->id]=$value['name'];
        }
        return view('superadmin.visitors_log.form')->with('return_user',$return_user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =$this->visitors_log->getRules();
        $request->validate($rules);
        $data=$request->all();
        $data['added_by']=Auth::user()->id;
       
        $this->visitors_log=$this->visitors_log->fill($data);
        $success=$this->visitors_log->save();
        if($success){
            $request->session()->flash('success','visitor log added successfully');
        }else{
            $request->session()->flash('error','visitor log not added at this time');
        }
        return redirect()->route('visitors_log.index');
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
        $this->visitors_log =$this->visitors_log->find($id);
        if(!$this->visitors_log){
            request()->session()->flash('error','visitor  not found');
            return redirect()->route('visitors_log.index');
        }
        $this->user= $this->user->where('role','!=','superAdmin')->where('role','!=','admin')->get();
        $return_user=array();
        foreach($this->user as $key=>$value){
            $return_user[$value->id]=$value['name'];
        }
        return view('superadmin.visitors_log.form')->with('return_user',$return_user)->with('user_data',$this->visitors_log);
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
        $rules =$this->visitors_log->getRules();
        $request->validate($rules);
        $data=$request->all();
        $this->visitors_log =$this->visitors_log->find($id);
        if(!$this->visitors_log){
            request()->session()->flash('error','visitor  not found');
            return redirect()->route('visitors_log.index');
        }


        $this->visitors_log=$this->visitors_log->fill($data);
        $success=$this->visitors_log->save();
        if($success){
            $request->session()->flash('success','visitor log added successfully');
        }else{
            $request->session()->flash('error','visitor log not added at this time');
        }
        return redirect()->route('visitors_log.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->visitors_log=$this->visitors_log->find($id);
        if(!$this->visitors_log){
            request()->session()->flash('error','visitors_log not found');
            return redirect()->route('visitors_log.index');
        }
        $this->visitors_log->delete();
        request()->session()->flash('success','visitors_log deleted successfully');
        return redirect()->route('visitors_log.index');
    }

    public function viewAllLog($id){
        $this->user =$this->user->find($id);
        $this->userDetails =$this->userDetails->where('user_id',$id)->get();
        $this->visitors_log= $this->visitors_log->where('user_id',$id)->orderBy('id','DESC')->get();
        $this->visitors_note= $this->visitors_note->where('user_id',$id)->orderBy('id','DESC')->get();
        return view('superadmin.visitors_log.dashboard')->with('user',$this->user)
        ->with('visitors_log',$this->visitors_log)
        ->with('visitors_note',$this->visitors_note)
        ->with('userDetails',$this->userDetails);
    }




    public function visitorsLogIndex()
    {
        $this->visitors_log=$this->visitors_log->getNameById();
        return view('admin.visitors_log.index')->with('user',$this->visitors_log);
    }

    public function visitorsLogCreate()
    {
        $this->user= $this->user->where('role','!=','superAdmin')->where('role','!=','admin')->get();
        $return_user=array();
        foreach($this->user as $key=>$value){
            $return_user[$value->id]=$value['name'];
        }
        return view('admin.visitors_log.form')->with('return_user',$return_user);
    }


    public function visitorsLogStore(Request $request)
    {
        $rules =$this->visitors_log->getRules();
        $request->validate($rules);
        $data=$request->all();
        $data['added_by']=Auth::user()->id;
       
        $this->visitors_log=$this->visitors_log->fill($data);
        $success=$this->visitors_log->save();
        if($success){
            $request->session()->flash('success','visitor log added successfully');
        }else{
            $request->session()->flash('error','visitor log not added at this time');
        }
        return redirect()->route('visitorsLogIndex');
    }


    public function visitorsLogEdit($id)
    {
        $this->visitors_log =$this->visitors_log->find($id);
        if(!$this->visitors_log){
            request()->session()->flash('error','visitor  not found');
            return redirect()->route('visitorsLogIndex');
        }
        $this->user= $this->user->where('role','!=','superAdmin')->where('role','!=','admin')->get();
        $return_user=array();
        foreach($this->user as $key=>$value){
            $return_user[$value->id]=$value['name'];
        }
        return view('admin.visitors_log.form')->with('return_user',$return_user)->with('user_data',$this->visitors_log);
    }


    public function visitorsLogUpdate(Request $request, $id)
    {
        $rules =$this->visitors_log->getRules();
        $request->validate($rules);
        $data=$request->all();
        $this->visitors_log =$this->visitors_log->find($id);
        if(!$this->visitors_log){
            request()->session()->flash('error','visitor  not found');
            return redirect()->route('visitorsLogIndex');
        }


        $this->visitors_log=$this->visitors_log->fill($data);
        $success=$this->visitors_log->save();
        if($success){
            $request->session()->flash('success','visitor log added successfully');
        }else{
            $request->session()->flash('error','visitor log not added at this time');
        }
        return redirect()->route('visitorsLogIndex');
    }




    public function viewAllLogAdmin($id){
        $this->user =$this->user->find($id);
        $this->userDetails =$this->userDetails->where('user_id',$id)->get();
        $this->visitors_log= $this->visitors_log->where('user_id',$id)->orderBy('id','DESC')->get();
        $this->visitors_note= $this->visitors_note->where('user_id',$id)->orderBy('id','DESC')->get();
        return view('admin.visitors_log.dashboard')->with('user',$this->user)
        ->with('visitors_log',$this->visitors_log)
        ->with('visitors_note',$this->visitors_note)
        ->with('userDetails',$this->userDetails);
    }


    

}
