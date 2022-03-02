<?php

namespace App\Http\Controllers\BlogPost;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    private $blogPost;
    private $user;
    public function __construct(){
        $this->blogPost = new BlogPost();
        $this->user = new User();
    }

    public function index(){
        //$blogs = $this->blogPost->all();
        //$blogs = $this->blogPost->orderBy('updated_at','asc')->get();
        $blogs = $this->blogPost->latest()->get();
        //dd(gettype($blogs),$blogs);
        return view('blog.index',[
            'blogs' => $blogs
        ]);
    }

    public function showCreateBlogForm(){
        return view('blog.create-blog-form');
    }

    public function storeBlog(Request $request){
        $newBlog = $this->blogPost->create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::user()->id
        ]);
        //dd($newBlog);
        return redirect('blog/'.$newBlog->id);
    }

    public function showBlogByID( $id){
        $blog = $this->blogPost->findOrfail($id);
        $authorName = $this->user->findOrfail($blog->user_id)->name;
        return view('blog.show-blog',[
            'blog' => $blog,
            'authorName' => $authorName
        ]);
    }

    
    public function edit(BlogPost $blogPost){
        //show form to edit the post
    }

    
    public function update(Request $request, BlogPost $blogPost){
        //save the edited post
    }

    
    public function deleteBlogById( $id){
        $blog = $this->blogPost->findOrfail($id);
        $blog->delete();
        return redirect('/blog');
    }
}
