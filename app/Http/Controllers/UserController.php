<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePassword;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::when($request->search , function ($q) use ($request){
            return $q->where('name','like','%'.$request->search.'%');
        })->latest()->get();//->paginate(10);
        
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->except('password','password_confirmation','image');
        $data['password'] = bcrypt($request->password);

        if($request->has('image')){
            $data['image'] = upload_image_without_resize('users_images',$request->image);
        }

        User::create($data);

        Alert::success('User Added Succesfully', '');
        return redirect()->route('users.index');

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
    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->except(['password','password_confirmation']);

        if($request->has('image')){
            $data['image'] = upload_image('users_images',$request->image);
        }

        if($request->has('password') && $request->password != null && $request->password != ''){
            $request->validate([
                'password' => 'required|confirmed',
            ]); 
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        Alert::success('User Updated Succesfully', '');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        delete_image('user_images',$user->image);
        $user->delete();
        Alert::success('User Deleted Succesfully', '');
        return redirect()->route('users.index');
    }

    public function edit_profile(User $user)
    {
        return view('users.edit_profile',compact('user'));
    }

    public function update_profile(UpdateProfileRequest $request)
    {
        $data = $request->all();

        $user = auth()->user();

        if($request->has('image')){
            $data['image'] = upload_image('users_images',$request->image);
        }


        $user->update($data);
        Alert::success('Profile Updated Succesfully', '');
        return redirect()->back();
    }


    public function edit_password(){
        return view('users.update_password');
    }

    public function update_password(ChangePassword $request){
        $request->user()->update([
            'password' => bcrypt($request->password),
        ]);

        return redirect()->back()->with('success',__('site.password_changed_successfuly'));

    }
}
