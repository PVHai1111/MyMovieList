<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cat;
use App\Http\Requests\StoreCatRequest;
use App\Services\CatService;
use Illuminate\Contracts\Cache\Store;

class CatController extends Controller
{
    //
    protected $catService;

    public function __construct(CatService $catService)
    {
        $this->catService = $catService;
    }

    function show()
    {
        $cats = Cat::orderBy('created_at', 'DESC')->paginate(10);
        $count = 1;
        return view('admin.cats.show', compact('cats', 'count'));
    }

    function add()
    {
        return view('admin.cats.add');
    }

    function store(StoreCatRequest $request)
    {
        $validate = $request->validated();
        $cat = $this->catService->createCat($validate);
        return redirect()->route('cat.show');
    }

    function edit($id)
    {
        $cat = Cat::find($id);
        return view('admin.cats.edit', compact('cat'));
    }

    function update($id, StoreCatRequest $request){
        $request = $request->validated();
        $cat = $this->catService->updateCat($id, $request);
        return redirect()->route('cat.show');
    }

    function delete($id){
        Cat::find($id)->delete();
        return back();
    }
    
}
