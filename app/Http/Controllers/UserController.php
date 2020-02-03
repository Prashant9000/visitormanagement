<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    protected $user=null;
    public function __construct(User $user){
        $this->user=$user;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->user=$this->user->where('role','!=','superAdmin')->orderBy('id','DESC')->get();
        return view('superadmin.user.index')->with('user',$this->user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('superadmin.user.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =$this->user->getRules();
        $request->validate($rules);
        $data=$request->all();
        $data['password']=Hash::make($request->password);
        $data['added_by']=Auth::user()->id;
       
        $this->user=$this->user->fill($data);
        $success=$this->user->save();
        if($success){
            $request->session()->flash('success','user added successfully');
        }else{
            $request->session()->flash('error','user not added at this time');
        }
        return redirect()->route('user.index');
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
        $this->user =$this->user->find($id);
        if(!$this->user){
            request()->session()->flash('error','user not found');
            return redirect()->route('user.index');
        }
        return view('superadmin.user.form')->with('user_data',$this->user);
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
        $rules= $this->user->getUpdate();
        $request->validate($rules);
        $data=$request->all();

        $this->user=$this->user->find($id);
        if(!$this->user){
            return redirect()->route('user.index');
        }
    
        if(isset($request->password)){
            $data['password'] =Hash::make($request->password);  
        }else{
            unset($data['password']);
        }
        $this->user=$this->user->fill($data);
        $this->user->save();
        request()->session()->flash('success','user updated successfully.');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->user=$this->user->find($id);
        if(!$this->user){
            request()->session()->flash('error','user not found');
            return redirect()->route('user.index');
        }
        $this->user->delete();
        request()->session()->flash('success','user deleted successfully');
        return redirect()->route('user.index');
    }

    public function adminProfile(){
        $this->user =$this->user->find(request()->user()->id);
        if(!$this->user){
            request()->session()->flash('error','user not found');
            return redirect()->route('user.index');
        }
        return view('superadmin.user.admin-form')->with('user_data',$this->user);
    }



    public function UpdateAdmin(Request $request ,$id){
        $request->request->add(['role'=>'superAdmin']);
        
        $rules =$this->user->getUpdate();
        $request->validate($rules);

        $data =$request->all();
        if($request->password){
            $data['password']= Hash::make($data['password']);
        }else{
            unset($data['password']);
        }
        $this->user= $this->user->find($id);
        $this->user->fill($data);
        $success =$this->user->save();
        if($success){
            $request->session()->flash('success','Super Admin updated successfully');
        }else{
            $request->session()->flash('error',' error while updating Super Admin ');
        }
        return redirect()->route('home');
    }


    public function user_index()
    {
        $this->user=$this->user->where('role','!=','superAdmin')->where('role','!=','admin')->orderBy('id','DESC')->get();
        return view('admin.user.index')->with('user',$this->user);
    }

    public function user_create()
    {
        return view('admin.user.form');
    }

    public function user_store(Request $request)
    {
        $rules =$this->user->getRules();
        $request->validate($rules);
        $data=$request->all();
        $data['password']=Hash::make($request->password);
        $data['added_by']=Auth::user()->id;
       
        $this->user=$this->user->fill($data);
        $success=$this->user->save();
        if($success){
            $request->session()->flash('success','user added successfully');
        }else{
            $request->session()->flash('error','user not added at this time');
        }
        return redirect()->route('user_index');
    }

    public function user_edit($id)
    {
        $this->user =$this->user->find($id);
        if(!$this->user){
            request()->session()->flash('error','user not found');
            return redirect()->route('user_index');
        }
        return view('admin.user.form')->with('user_data',$this->user);
    }

    public function user_update(Request $request, $id)
    {
        $rules= $this->user->getUpdate();
        $request->validate($rules);
        $data=$request->all();

        $this->user=$this->user->find($id);
        if(!$this->user){
            return redirect()->route('user_index');
        }
    
        if(isset($data->password)){
            $data['password'] =Hash::make($request->password);  
        }else{
            unset($data['password']);
        }
        $this->user=$this->user->fill($data);
        $this->user->save();
        request()->session()->flash('success','user updated successfully.');
        return redirect()->route('user_index');
    }

    public function adminProfileEdit(){
        $this->user =$this->user->find(request()->user()->id);
        if(!$this->user){
            request()->session()->flash('error','user not found');
            return redirect()->route('user_index');
        }
        return view('admin.user.admin-form')->with('user_data',$this->user);
    }



    public function UpdateAdminUpdate(Request $request ,$id){
        $request->request->add(['role'=>'admin']);
        
        $rules =$this->user->getUpdate();
        $request->validate($rules);

        $data =$request->all();
        if($request->password){
            $data['password']= Hash::make($data['password']);
        }else{
            unset($data['password']);
        }
        $this->user= $this->user->find($id);
        $this->user->fill($data);
        $success =$this->user->save();
        if($success){
            $request->session()->flash('success',' Admin updated successfully');
        }else{
            $request->session()->flash('error',' error while updating  Admin ');
        }
        return redirect()->route('home');
    }
}
