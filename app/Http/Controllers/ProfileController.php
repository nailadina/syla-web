<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $profile = Profile::where('user_id', $id)->get();
        $user = Auth::user();

        $user_profile = [
            $profile,
            $user
        ];

        // dd($user, $profile);
        return view('profile.index', compact('user_profile'));
    }

    public function update(Request $request, Profile $profile, $id)
    {
        $profile = Profile::find($id);
        $user = User::find($id);

        $profile->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'dob' => $request->dob,
        ]);
        $profile->save();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
