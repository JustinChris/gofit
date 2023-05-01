<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class MemberController extends Controller
{

    public function getPrintCard($id) {
        $member = User::where(['role' => 'member', 'id' => $id])->first();
        $pdf = PDF::loadView('member.idCard', ["member" => $member]);
        $pdf->set_paper('letter', 'landscape');
        return $pdf->stream($member->id . "." . $member->username . '.pdf');
    }

    public function getAddMembers() {
        return view('member.addMembers', [
            'user' => Auth::user(),
        ]);
    }

    public function postAddMembers(Request $request) {
        $request->validate([
            'username' => 'required|min:5|max:20|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:20',
            'phone' => 'required|min:10|max:13',
            'address' => 'required|min:5',
        ]);

        User::create([
            'username' => $request->username,
            'role' => 'member',
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect('/members/add');
    }

    public function getDeleteMembers($id) {
        
        $member = User::find($id);

        if ($member->role == "member") {
            $member->delete();
        }

        return redirect('/members');
    }

    public function getUpdateMembers($id) {
        
        return view ('member.editMembers', [
            'user' => Auth::user(),
            'member' => User::where(['role' => 'member', 'id' => $id])->first(),
            'subscription' => Membership::where(['user_id' => $id])->get(),
        ]);
    }

    public function postUpdateMembers(Request $request, $id) {
        $request->validate([
            'phone' => 'required|min:10|max:13',
            'address' => 'required|min:5',
        ]);

        $content = User::where(['role' => 'member', 'id' => $id])->first();

        if ($content->count() <= 0) {
            return redirect('/members')->withErrors("member not registered");
        }

        $content = User::find($id);
        $content->phone = $request->phone;
        $content->address = $request->address;
        $content->save();

        return redirect('/members/update/' . $id);
    }

    public function getResetPassword($id) {
        $user = User::where(['id' => $id])->first();
        if ($user->role == 'member') {
            $user->password = bcrypt("DEFAULT");
            $user->save();
        }
        return redirect('/instructors/update/' . $id);
    }

    public function getMembership($id) {

        $member = User::where(['id' => $id])->first();
        if ($member->role != 'member') {
            return redirect('/dashboard');
        }

        return view('member.membership', [
            'user' => Auth::user(),
            'member' => $member,
            'subscription' => Membership::where(['user_id' => $id])->get(),
        ]);
    }

    public function postMembership(Request $request, $id) {
        $request->validate([
            'subscribed_on' => 'required',
            'expired_on' => 'required',
            'price' => 'required',
        ]);

        $member = User::where(['id' => $id])->first();
        if ($member->role != 'member') {
            return redirect('/dashboard');
        }

        Membership::create([
            'subscribed_on' => $request->subscribed_on,
            'expired_on' => $request->expired_on,
            'price' => $request->price,
            'user_id' => $member->id,
        ]);

        return redirect('/members');
    }

}
