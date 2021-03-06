<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
class userProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
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
        $user = User::find($id);
        $request -> validate([
            'firstname' => 'required|min:1|max:45',
            'lastname' => 'required|min:1|max:45',
            'sex' => 'required|min:1|max:45',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'city' => 'required|min:1|max:45',
        ]);
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->email = $request->get('email');
        $user->birth = $request->get('birth');
        $user->city = $request->get('city');  
        $user->sex = $request->get('sex');
        if($request->hasFile('picture')) {

            if(\File::exists(public_path("asset/eventimage/{$user->picture}"))){
                \File::delete(public_path("asset/eventimage/{$user->picture}"));
            }

            $image = $request->file('picture');            
            $filename = time().'.'.request()->picture->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());  
            $image_resize->resize(100, 100);        
            $user-> picture=   $filename;
            $image_resize->save(public_path('asset/userImage/' .$filename));
        }
        $user->save();
        return back();
    }



    //// Change Password of user/////////

    public function changePassword(Request $request){
        request()->validate([
            'old-password' => 'required|min:8|max:32',
            'new-password' => 'required|min:8|max:32',
            'password-confirmation' => 'required|min:8|max:32',
        ]);
            $old_password = $request->get('old-password');
            $value = Auth::user()->password;
            $verify_password = Hash::check($old_password,$value);
            if($verify_password){
                $new_password = $request->get('new-password');
                $confirm_password = $request->get('password-confirmation');
                if($new_password == $confirm_password){
                    $user = User::find(Auth::id());
                    $user->password = Hash::make($new_password);
                    $user->save();
                    return redirect()->back() ->with('success', 'Updated Successfully!'); 
                 }else{
                    return redirect()->back() ->with('confirm', 'New password and confirm password is not correct!'); 
                 }
             }else{
                  return redirect()->back() ->with('fail', 'Updated Not Successfully!!. Your old password incorrect');
             }
    }
            
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
        $image = User::findOrFail($id);
        if($image->picture != 'user.png'){
            if(\File::exists(public_path("asset/userImage/{$image->picture}"))){
                \File::delete(public_path("asset/userImage/{$image->picture}"));
            }
            $image = User::findOrFail($id)->where('id', Auth::user()->id)->update([
                'picture' => 'user.png',
            ]);
            return back();
        }else {
            return back();
        }
    }

}
