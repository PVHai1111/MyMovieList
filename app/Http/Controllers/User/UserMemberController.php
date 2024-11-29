<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;

class UserMemberController extends Controller
{
    function show($id){
        $member = Member::find($id);
        return view('user.member.show',compact('member'));
    }
}
