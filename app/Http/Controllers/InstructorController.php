<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    public function getAddInstructors() {
        return view('instructor.addInstructors',[
            'user' => Auth::user(),
        ]);
    }

    public function postAddInstructors(Request $request) {
        $request->validate([
            'username' => 'required|min:5|max:20|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:20',
            'phone' => 'required|min:10|max:13',
            'address' => 'required|min:5',
        ]);

        User::create([
            'username' => $request->username,
            'role' => 'instructor',
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect('/instructors/add')->with('message', 'Add Success');
    }

    public function getDeleteInstructors($id) {

        $instructor = User::where(['id' => $id])->first();

        if ($instructor->role == "instructor") {
            $instructor->delete();
        }

        return redirect('/instructors');
    }

    public function getUpdateInstructors($id) {
        return view('instructor.editInstructors', [
            'instructor' => User::where(['role' => 'instructor', 'id' => $id])->first(),
            'user' => Auth::user(),
        ]);
    }

    public function postUpdateInstructors(Request $request, $id) {
        $request->validate([
            'phone' => 'required|min:10|max:13',
            'address' => 'required|min:5',
        ]);

        $content = User::where(['role' => 'instructor', 'id' => $id])->first();

        if ($content->count() <= 0) {
            return redirect('/instructors')->withErrors("Instructor not registered");
        }

        $content = User::where(['id' => $id])->first();
        $content->phone = $request->phone;
        $content->address = $request->address;
        $content->save();

        return redirect('/instructors/update/' . $id)->with('message', 'Update Success');
    }
    
}
