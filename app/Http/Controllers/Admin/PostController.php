<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
class PostController extends Controller
{
    public function index(Request $request)
    {
        // 1. Get all cates
        $cates = Category::all();
        
        // 2. Get list name
        $nameList = get_options($cates);
        
        for ($i = 0; $i < count($cates); $i++) {
            foreach ($nameList as $key => $value) {
                if ("x" . $cates[$i]->id == $key) {
                    $cates[$i]->name = $value;
                }
            }
        }
        if (!$request->has('keyword') && !$request->has('cate')) {
            
            $posts = Post::paginate(DEFAULT_PAGE_SIZE);
        } else {
            $CustomUrl = "";
            if ($request->has('keyword')) {
                $keyword = $request->input('keyword');
                $query   = Post::where('title', 'like', "%$keyword%");
                $CustomUrl .= '?keyword=' . $keyword;
            }
            
            if ($request->has('cate')) {
                $cateId = $request->input('cate');
                if (!isset($query)) {
                    $query = Post::where('cate_id', $cateId);
                    $CustomUrl .= "?";
                } else {
                    $query->where('cate_id', $cateId);
                    $CustomUrl .= "&";
                }
                $CustomUrl .= 'cate=' . $cateId;
            }
            
            $posts = $query->paginate(DEFAULT_PAGE_SIZE);
            $posts->withPath($CustomUrl);
            
        }
        
        $searchCateId  = $request->input('cate');
        $searchKeyword = $request->input('keyword');
        return view('admin.posts.index', compact('cates', 'posts', 'searchCateId', 'searchKeyword'));
        
        
        
    }
    public function destroy($id)
    {
        
        $post = Post::find($id);
        
        
        // 2. Delete record from database
        $post->delete();
        // $cate->Category::find($id)->destroy();
        // 3. Redirect page to category list
        return redirect(route('post.list'));
    }
    
    public function addNew()
    {
        $model = new Post();
        
        $cates = Category::all();

                $nameList = get_options($cates);
        
        for ($i = 0; $i < count($cates); $i++) {
            foreach ($nameList as $key => $value) {
                if ("x" . $cates[$i]->id == $key) {
                    $cates[$i]->name = $value;
                }
            }
        }
        
        return view('admin.posts.form_add', compact('model', 'cates'));
        
        
    }

    public function save(Request $request)
    {
        
    }
    
    
    
}