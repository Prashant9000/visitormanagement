<?php

namespace App\Http\Controllers;

use App\Models\VisitorsLog;
use App\Models\VisitorsNote;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class VisitorsNoteController extends Controller
{
    protected $visitors_note=null;
    protected $visitors_log=null;
    protected $user=null;
    public function __construct(VisitorsNote $visitors_note, User $user, VisitorsLog $visitors_log){
        $this->visitors_note=$visitors_note;
        $this->user=$user;
        $this->visitors_log=$visitors_log;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->visitors_note=$this->visitors_note->orderBy('id','DESC')->get();
        return view('superadmin.visitors_note.index')->with('user',$this->visitors_note);
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
        $this->visitors_log= $this->visitors_log->get();
        $return_visit_log=array();
        foreach($this->visitors_log as $key=>$value){
            $return_visit_log[$value->id]=$value->id;
        }
      
        return view('superadmin.visitors_note.form')->with('return_user',$return_user)->with('return_visit_log',$return_visit_log);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =$this->visitors_note->getRules();
        $request->validate($rules);
        $data=$request->all();
        
        $data['added_by']=Auth::user()->id;
        $this->visitors_note=$this->visitors_note->fill($data);
        $success=$this->visitors_note->save();
        if($success){
            $request->session()->flash('success','visitor log added successfully');
        }else{
            $request->session()->flash('error','visitor log not added at this time');
        }
        return redirect()->route('visitors_note.index');
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
        $this->visitors_note =$this->visitors_note->find($id);
        if(!$this->visitors_note){
            request()->session()->flash('error','visitor  not found');
            return redirect()->route('visitors_note.index');
        }

        $this->user= $this->user->where('role','!=','superAdmin')->where('role','!=','admin')->get();
        $return_user=array();
        foreach($this->user as $key=>$value){
            $return_user[$value->id]=$value['name'];
        }
        $this->visitors_log= $this->visitors_log->get();
        $return_visit_log=array();
        foreach($this->visitors_log as $key=>$value){
            $return_visit_log[$value->id]=$value->id;
        }
      
        return view('superadmin.visitors_note.form')->with('return_user',$return_user)->with('return_visit_log',$return_visit_log)->with('user_data',$this->visitors_note);
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
        $this->visitors_note =$this->visitors_note->find($id);
        if(!$this->visitors_note){
            request()->session()->flash('error','visitor  not found');
            return redirect()->route('visitors_note.index');
        }

        $rules =$this->visitors_note->getRules();
        $request->validate($rules);
        $data=$request->all();
        $this->visitors_note=$this->visitors_note->fill($data);
        $success=$this->visitors_note->save();
        if($success){
            $request->session()->flash('success','visitor note updated successfully');
        }else{
            $request->session()->flash('error','visitor note not updated at this time');
        }
        return redirect()->route('visitors_note.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->visitors_note=$this->visitors_note->find($id);
        if(!$this->visitors_note){
            request()->session()->flash('error','visitors_note not found');
            return redirect()->route('visitors_note.index');
        }
        $this->visitors_note->delete();
        request()->session()->flash('success','visitors_note deleted successfully');
        return redirect()->route('visitors_note.index');
    }

    public function addNotes($id){
        $this->visitors_log= $this->visitors_log->get();
        $return_visit_log=array();
        foreach($this->visitors_log as $key=>$value){
            $return_visit_log[$value->id]=$value->id;
        }
        return view('superadmin.visitors_note.addnote')->with('id',$id)->with('return_visit_log',$return_visit_log);
    }

    public function savenotes(Request $request, $id){
        $rules =$this->visitors_note->getRules();
        $request->validate($rules);
        $data= $request->all();
        $data['user_id']= $id;
        $this->visitors_note=$this->visitors_note->fill($data);
        $success=$this->visitors_note->save();
        if($success){
            $request->session()->flash('success','visitor notes added successfully');
        }else{
            $request->session()->flash('error','visitor notes not updated at this time');
        }
        return redirect()->route('visitors_log.index');
    }


    public function visitorsNotesIndex()
    {
        $this->visitors_note=$this->visitors_note->orderBy('id','DESC')->get();
        return view('admin.visitors_note.index')->with('user',$this->visitors_note);
    }

    public function visitorsNotesCreate()
    {
        $this->user= $this->user->where('role','!=','superAdmin')->where('role','!=','admin')->get();
        $return_user=array();
        foreach($this->user as $key=>$value){
            $return_user[$value->id]=$value['name'];
        }
        $this->visitors_log= $this->visitors_log->get();
        $return_visit_log=array();
        foreach($this->visitors_log as $key=>$value){
            $return_visit_log[$value->id]=$value->id;
        }
      
        return view('admin.visitors_note.form')->with('return_user',$return_user)->with('return_visit_log',$return_visit_log);
    }


    public function visitorsNotesStore(Request $request)
    {
        $rules =$this->visitors_note->getRules();
        $request->validate($rules);
        $data=$request->all();
        
        $data['added_by']=Auth::user()->id;
        $this->visitors_note=$this->visitors_note->fill($data);
        $success=$this->visitors_note->save();
        if($success){
            $request->session()->flash('success','visitor log added successfully');
        }else{
            $request->session()->flash('error','visitor log not added at this time');
        }
        return redirect()->route('visitorsNotesIndex');
    }



    public function visitorsNotesEdit($id)
    {
        $this->visitors_note =$this->visitors_note->find($id);
        if(!$this->visitors_note){
            request()->session()->flash('error','visitor  not found');
            return redirect()->route('visitorsNotesIndex');
        }

        $this->user= $this->user->where('role','!=','superAdmin')->where('role','!=','admin')->get();
        $return_user=array();
        foreach($this->user as $key=>$value){
            $return_user[$value->id]=$value['name'];
        }
        $this->visitors_log= $this->visitors_log->get();
        $return_visit_log=array();
        foreach($this->visitors_log as $key=>$value){
            $return_visit_log[$value->id]=$value->id;
        }
      
        return view('admin.visitors_note.form')->with('return_user',$return_user)->with('return_visit_log',$return_visit_log)->with('user_data',$this->visitors_note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function visitorsNotesUpdate(Request $request, $id)
    {
        $this->visitors_note =$this->visitors_note->find($id);
        if(!$this->visitors_note){
            request()->session()->flash('error','visitor  not found');
            return redirect()->route('visitorsNotesIndex');
        }

        $rules =$this->visitors_note->getRules();
        $request->validate($rules);
        $data=$request->all();
        $this->visitors_note=$this->visitors_note->fill($data);
        $success=$this->visitors_note->save();
        if($success){
            $request->session()->flash('success','visitor note updated successfully');
        }else{
            $request->session()->flash('error','visitor note not updated at this time');
        }
        return redirect()->route('visitorsNotesIndex');
    }




    public function addNotesAdmin($id){
        $this->visitors_log= $this->visitors_log->get();
        $return_visit_log=array();
        foreach($this->visitors_log as $key=>$value){
            $return_visit_log[$value->id]=$value->id;
        }
        return view('admin.visitors_note.addnote')->with('id',$id)->with('return_visit_log',$return_visit_log);
    }

    public function saveNotesAdmin(Request $request, $id){
        $rules =$this->visitors_note->getRules();
        $request->validate($rules);
        $data= $request->all();
        $data['user_id']= $id;
        $this->visitors_note=$this->visitors_note->fill($data);
        $success=$this->visitors_note->save();
        if($success){
            $request->session()->flash('success','visitor notes added successfully');
        }else{
            $request->session()->flash('error','visitor notes not updated at this time');
        }
        return redirect()->route('visitorsLogIndex');
    }
}
