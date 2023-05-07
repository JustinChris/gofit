<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    
    public function getPrintClassReceipt($id) {
        $member = User::where(['role' => 'member', 'id' => $id])->first();
        $pdf = PDF::loadView('member.idCard', ["member" => $member]);
        $pdf->set_paper('letter', 'landscape');
        return $pdf->stream($member->id . "." . $member->username . '.pdf');
    }

    public function getPrintDepositReceipt($id) {
        $member = User::where(['role' => 'member', 'id' => $id])->first();
        $pdf = PDF::loadView('member.idCard', ["member" => $member]);
        $pdf->set_paper('letter', 'landscape');
        return $pdf->stream($member->id . "." . $member->username . '.pdf');
    }

    public function getPrintMembershipReceipt($id) {
        $member = User::where(['role' => 'member', 'id' => $id])->first();
        $pdf = PDF::loadView('member.idCard', ["member" => $member]);
        $pdf->set_paper('letter', 'landscape');
        return $pdf->stream($member->id . "." . $member->username . '.pdf');
    }
}
