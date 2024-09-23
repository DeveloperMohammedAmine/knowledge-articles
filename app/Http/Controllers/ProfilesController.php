<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Department;
Use App\Models\User;
use Auth;
Use App\Traits\saveImage;
use Illuminate\Support\Facades\Hash;

class ProfilesController extends Controller
{

    use saveImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name)
    {
        $user = User::where('name', $name) -> get() -> first();
        return view('profiles.index') 
        -> with('user', $user);
    }

    

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        
        $user_id = Auth::user() -> id;
        $user = User::find($user_id);
        return view('profiles.edit')
        -> with('user', $user);
    }

    public function editPassword() {
        
        $password = User::select('password') -> find(Auth::user() -> id);
        $password -> makeVisible(['password']);
        return view('profiles.edit-password');
    
    }

    public function updatePassword(Request $request) {
        
        $request -> validate([
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8',
            'confirmation_password' => 'required|min:8',
        ]);

        $user = User::find(Auth::user() -> id);

        if(Hash::check($request -> old_password, $user -> password)) {
            $new_password = Hash::make($request -> new_password);
            return $new_password;
            $user -> update([
                'password' -> $new_password
            ]);
        }

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::user() -> id);

        if($request -> image)
            $image = $this -> saveImage($request -> image, 'assets/img/users');
        else
            $image = $user -> profile -> image;

        

        


        $user -> update([
            'name' => $request -> name, 
            'email' => $request -> email,
        ]);

        $user -> profile -> update([
            'image' => $image,
            'job' => $request -> job,
            'phone_number' => $request -> phone_number,
            'country' => $request -> country,
        ]);


        return redirect() -> back() -> with('success', 'User Profile Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
