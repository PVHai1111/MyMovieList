<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use App\Services\BlogService;
use Illuminate\Support\Facades\Auth;
use App\Services\CommentService;

class UserBlogController extends Controller
{
    //
    protected $commentService;
    protected $blogService;

    public function __construct(BlogService $blogService, CommentService $commentService)
    {
        $this->commentService = $commentService;
        $this->blogService = $blogService;
    }

    function show()
    {
        $count = 1;
        if(Auth::user()->isAdmin()){
            $blogs = Blog::orderBy('created_at')->paginate(10);
        }else{
            $blogs = Auth::user()->blogs()->paginate(10);
        }
        return view('admin.blogs.show', compact('blogs', 'count'));
    }
    function add()
    {
        return view('admin.blogs.add');
    }

    function store(StoreBlogRequest $request)
    {
        $validate = $request->validated();
        if ($request->hasFile('thumb')) {
            $file = $request->file('thumb');
            $filePath = $this->blogService->uploadFile($file);
            if ($filePath) {
                $validate['thumb'] = $filePath;
            }
            $member = Auth::user()->createBlog($validate);
            return redirect()->route('user.blog.show');
        }
        return back()->withErrors(['file_error' => 'Thumb not empty']);
    }

    function edit($id)
    {
        if (Auth::user()->ownsBlog($id) || Auth::user()->isAdmin()) {
            $blog = Blog::find($id);
            return view('admin.blogs.edit', compact('blog'));
        } else {
            return back()->withErrors(['error' => 'You do not have access']);
        }
    }

    function update($id, StoreBlogRequest $request)
    {
        if (Auth::user()->ownsBlog($id) || Auth::user()->isAdmin()) {
            $validate = $request->validated();
            if ($request->hasFile('thumb')) {
                $file = $request->file('thumb');
                $filePath = $this->blogService->uploadFile($file);
                if ($filePath) {
                    $validate['thumb'] = $filePath;
                }
            } else $validate['thumb'] = Blog::find($id)->thumb;
            $blog = $this->blogService->updateBlog($id, $validate);
            return redirect()->route('user.blog.show');
        } else {
            return back()->withErrors(['error' => 'You do not have access']);
        }
    }

    function delete($id)
    {
        if (Auth::user()->ownsBlog($id) || Auth::user()->isAdmin()) {
            $blog = Blog::find($id);
            $blog->delete();
            return redirect()->route('user.blog.show');
        } else {
            return back()->withErrors(['error' => 'You do not have access']);
        }
    }

    function all()
    {
        $blogChunks = Blog::orderBy('created_at')->get()->chunk(12);
        $count = 0;
        return view('user.blog.all', compact('blogChunks', 'count'));
    }

    function detail($id)
    {
        $blog = Blog::find($id);
        return view('user.blog.detail', compact('blog'));
    }

    function comment(Request $request)
    {
        if (Auth::check()) {
            if ($request->get('user_id') == Auth::user()->id) {
                if ($request->get('body')) {
                    if ($request->get('blog_id')) {
                        $data['user_id'] = Auth::user()->id;
                        $data['body'] = $request->get('body');
                        $data['commentable_id'] = $request->get('blog_id');
                        $data['comment_parent'] = $request->get('comment_id');
                        $comment = $this->commentService->createComment($data, \App\Models\Blog::class);
                        $blog = Blog::find($request->get('blog_id'));
                        return response()->json(['view' => view('user.blog.list_comment', compact('blog'))->render()]);
                    }
                } else {
                    return response()->json(['error' => 'Please enter comment content']);
                }
            } else {
                return response()->json(['error' => 'An error occurred. Reload the page and try again.']);
            }
        }
        return response()->json(['error' => 'You need to login to perform this function']);
    }
}
