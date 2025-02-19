<?php

namespace App\Http\Controllers\AdminUserController;

use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;


class AdminUSerController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [
            'user'    => User::get(),
            'content' =>'admin.user.index'
        ];
        return view('admin.layouts.wrapper',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data = [
            'content' =>'admin.user.create'
        ];
        return view('admin.layouts.wrapper',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validation([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            're_password' => 'required|same:password',
        ]);

        User::create($data);
        return redirect('/admin/user');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = [
            'user'      =>User::find($id),
            'content'   =>'admin.user.create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $user = User::find($id);
        $data = $request->validation([
            'name' => 'required',
            'email' => 'required|email|unique:users,email'.$user->$id,
            //'password' => 'required',
            're_password' => 'same:password',
        ]);

        if($request->password !=''){
            $data['password']= Hash::make($request->password);
        }else{
            $data['password'] =$user->password;
        }

        $user->update($data);
        return redirect('/admin/user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
