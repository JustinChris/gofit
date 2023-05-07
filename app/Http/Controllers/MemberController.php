<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Membership;
use App\Models\Schedule;
use App\Models\Transaction;
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

        return redirect('/members/add')->with('message', 'Add Success');
    }

    public function getDeleteMembers($id) {
        
        $member = User::find($id);

        if ($member->role == "member") {
            $member->delete();
        }

        return redirect('/members')->with('message', 'Delete Success');
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

        return redirect('/members/update/' . $id)->with('message', 'Update Success');
    }

    public function getResetPassword($id) {
        $user = User::where(['id' => $id])->first();
        if ($user->role == 'member') {
            $user->password = bcrypt("DEFAULT");
            $user->save();
        }
        return redirect('/members/update/' . $id)->with('message', 'Reset Success');
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

        $membership = Membership::where(['user_id' => $member->id])->latest()->first();

        Transaction::create([
            'deposit' => $request->price,
            'title' => strval($member->id) . "-" . strval($membership->id) . "-MBR",
            'bonus' => 0.1 * $request->price,
            'user_id' => $member->id,
        ]);

        $member->balance -= ($request->price - ($request->price * 0.1));
        $member->save();

        $pdf = PDF::loadView('receipt.MembershipReceipt', ["user" => $member, "membership" => $membership]);
        $pdf->set_paper('letter', 'landscape');
        return $pdf->stream($member->id . "." . $member->username . '.pdf');

    }

    public function getMemberDeposit($id) {
        $user = User::where(["id" => $id])->first();
        return view('member.deposit', [
            'member' => $user,
            'user' => Auth::user(),
        ]);
    }

    public function postMemberDeposit(Request $request, $id) {
        $request->validate([
            'title' => 'required',
            'deposit' => 'required',
        ]);

        $member = User::where(['id' => $id])->first();
        if ($member->role != 'member') {
            return redirect('/dashboard');
        }

        $member->balance += ($request->deposit + ($request->deposit * 0.1));
        $member->save();

        $transaction = Transaction::create([
            'deposit' => $request->deposit,
            'bonus' => $request->deposit * 0.1,
            'title' => $request->title,
            'user_id' => $member->id,
        ]);

        $pdf = PDF::loadView('receipt.DepositReceipt', ["user" => $member, "transaction" => $transaction]);
        $pdf->set_paper('letter', 'landscape');
        return $pdf->stream($member->id . "." . $member->username . '.pdf');

    }

    public function getMemberClass($id) {
        $user = User::where(["id" => $id])->first();
        return view('member.class', [
            'member' => $user,
            'user' => Auth::user(),
            'classes' => Schedule::all(),
        ]);
    }

    public function postMemberClass(Request $request, $id) {
        $request->validate([
            'classid' => 'required',
        ]);

        $class = Schedule::where(['id' => $request->classid])->first();
        $member = User::where(['id' => $id, 'role' => 'member'])->first();

        if (!$class || !$member) {
            return redirect('/members')->withErrors('Error Not Found!');
        }

        if ($member->balance < $class->price) {
            return redirect('/members')->withErrors('Error Balance Not Enough!');
        }

        $member->balance -= ($class->price - $class->bonus);
        $member->save();

        $booking = Booking::create([
            'class_id' => $class->id,
            'user_id' => $id
        ]);

        $pdf = PDF::loadView('receipt.ClassReceipt', ["user" => $member, "schedule" => $class]);
        $pdf->set_paper('letter', 'landscape');
        return $pdf->stream($member->id . "." . $member->username . '.pdf');
    }

}
