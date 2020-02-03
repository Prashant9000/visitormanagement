<?php

namespace App\Http\Controllers;

use App\Models\UsersInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersInfoController extends Controller
{
    protected $user_info=null;
    protected $user=null;
    public function __construct(UsersInfo $user_info, User $user){
        $this->user_info=$user_info;
        $this->user=$user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->user_info=$this->user_info->getNameById();
        return view('superadmin.user_info.index')->with('user',$this->user_info);
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
        return view('superadmin.user_info.form')->with('return_user',$return_user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules =$this->user_info->getRules();
        $request->validate($rules);
        $data=$request->all();
        $data['added_by']=Auth::user()->id;
        $this->user_info=$this->user_info->fill($data);
        $success=$this->user_info->save();
        if($success){
            $request->session()->flash('success','user details added successfully');
        }else{
            $request->session()->flash('error','user details not added at this time');
        }
        return redirect()->route('users_info.index');
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
        $this->user_info =$this->user_info->find($id);
        if(!$this->user_info){
            request()->session()->flash('error','user info  not found');
            return redirect()->route('users_info.index');
        }
        $this->user= $this->user->where('role','!=','superAdmin')->where('role','!=','admin')->get();
        $return_user=array();
        foreach($this->user as $key=>$value){
            $return_user[$value->id]=$value['name'];
        }

        return view('superadmin.user_info.form')->with('return_user',$return_user)->with('user_data',$this->user_info);
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
        $rules =$this->user_info->getRules();
        $request->validate($rules);
        $data=$request->all();
        $this->user_info=$this->user_info->find($id);
        if(!$this->user_info){
            request()->session()->flash('error','user info not found');
            return redirect()->route('users_info.index');
        }
        $this->user_info=$this->user_info->fill($data);
        $success=$this->user_info->save();
        if($success){
            $request->session()->flash('success','user details added successfully');
        }else{
            $request->session()->flash('error','user details not added at this time');
        }
        return redirect()->route('users_info.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user_info=$this->user_info->find($id);
        if(!$this->user_info){
            request()->session()->flash('error','user info not found');
            return redirect()->route('users_info.index');
        }
        $this->user_info->delete();
        request()->session()->flash('success','user info deleted successfully');
        return redirect()->route('users_info.index');
    }


    public function userInfoIndex()
    {
        $this->user_info=$this->user_info->getNameById();
        return view('admin.user_info.index')->with('user',$this->user_info);
    }

    public function usersInfoCreate()
    {
        $this->user= $this->user->where('role','!=','superAdmin')->where('role','!=','admin')->get();
        $return_user=array();
        foreach($this->user as $key=>$value){
            $return_user[$value->id]=$value['name'];
        }
        return view('admin.user_info.form')->with('return_user',$return_user);
    }


    public function usersInfoStore(Request $request)
    {
        
        $rules =$this->user_info->getRules();
        $request->validate($rules);
        $data=$request->all();
        $data['added_by']=Auth::user()->id;
        $this->user_info=$this->user_info->fill($data);
        $success=$this->user_info->save();
        if($success){
            $request->session()->flash('success','user details added successfully');
        }else{
            $request->session()->flash('error','user details not added at this time');
        }
        return redirect()->route('userInfoIndex');
    }


    public function usersInfoEdit($id)
    { 
        $this->user_info =$this->user_info->find($id);
        if(!$this->user_info){
            request()->session()->flash('error','user info  not found');
            return redirect()->route('userInfoIndex');
        }
        $this->user= $this->user->where('role','!=','superAdmin')->where('role','!=','admin')->get();
        $return_user=array();
        foreach($this->user as $key=>$value){
            $return_user[$value->id]=$value['name'];
        }

        return view('admin.user_info.form')->with('return_user',$return_user)->with('user_data',$this->user_info);
    }


    public function usersInfoUpdate(Request $request, $id)
    {
        $rules =$this->user_info->getRules();
        $request->validate($rules);
        $data=$request->all();
        $this->user_info=$this->user_info->find($id);
        if(!$this->user_info){
            request()->session()->flash('error','user info not found');
            return redirect()->route('userInfoIndex');
        }
        $this->user_info=$this->user_info->fill($data);
        $success=$this->user_info->save();
        if($success){
            $request->session()->flash('success','user details added successfully');
        }else{
            $request->session()->flash('error','user details not added at this time');
        }
        return redirect()->route('userInfoIndex');
    }
}
