<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Services\MemberService;

class MemberController extends Controller
{
    protected $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }
    function show()
    {
        $members = Member::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.members.show', compact('members'));
    }

    function add()
    {
        return view('admin.members.add');
    }

    function store(StoreMemberRequest $request)
    {
        $validate = $request->validated();
        if ($request->hasFile('thumb')) {
            $file = $request->file('thumb');
            $filePath = $this->memberService->uploadFile($file);
            if ($filePath) {
                $validate['thumb'] = $filePath;
            }
            $member = $this->memberService->createMember($validate);
            return redirect()->route('member.show');
        }
        return back()->withErrors(['file_error' => 'Thumb not empty']);
    }

    function edit($id)
    {
        $member = Member::find($id);
        return view('admin.members.edit', compact('member'));
    }

    function update($id, StoreMemberRequest $request)
    {
        $validate = $request->validated();
        if ($request->hasFile('thumb')) {
            $file = $request->file('thumb');
            $filePath = $this->memberService->uploadFile($file);
            if ($filePath) {
                $validate['thumb'] = $filePath;
            }
        } else $validate['thumb'] = Member::find($id)->thumb;
        $member = $this->memberService->updateMember($id, $validate);
        return redirect()->route('member.show');
    }

    function delete($id){
        $member = Member::find($id);
        $member->delete();
        return back();
    }
}
