<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
class BlogController extends Controller
{
    
    public function index(Request $request)
    {
        $blog = Blog::paginate(4);
        return view('admin.blog.index', compact('blog','request' ));
    }

  
    public function create()
    {
        return view('admin.blog.create');
    }
    protected function new_slug($slug){
        $check = Blog::where('slug', $slug)->first();
        if($check){
          $array = explode("-", $slug);
            $total =  count($array);
            $last_digit = $array[$total-1];
            if(is_numeric($last_digit)){
                array_pop($array);
                $new = $last_digit+1;
                array_push($array, $new);
                $new_slug = implode("-", $array);
            }else{
                array_push($array, 1);
                $new_slug = implode("-", $array);
            }
            $recheck = Blog::where('slug', $new_slug)->first();
           if($recheck){
            return $this->new_slug($new_slug);
           }else{
            return $new_slug;
           }
        }else{
          return $slug;  
        }
    }
    protected function createSlug($title , $status) {
        $slug = strtolower(str_replace(' ', '-', $title));
        $slug = preg_replace('/[^a-z0-9-]/', '', $slug); 
        $check = Blog::where('slug', $slug)->first();
        if($check && $status=='new'){
            $new_slug = $this->new_slug($slug);
            return $new_slug;
        }elseif($check && $status=='update'){
            return $check->slug;
        }else{
            return $slug;
        }  
    }
    public function store(Request $request)
    {
        try {
            // $this->createSlug('test title', 'new');
            // die();
            $rules = [
                'title' => 'required|string',
                'description' => 'required|string',
                'type' => 'required|string',
                'keywords' => 'required|string',
                'content' => 'required|string',
            ];
           $messages = [
                'required' => 'The :attribute field is required.',
            ];
                    // Validate the request
            $validator = \Validator::make($request->all(), $rules, $messages);

            // Check if validation fails
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }



            if(isset($request->blog_id)){
             $blog = Blog::where('id', $request->blog_id)->first();
             $blog->slug = $this->createSlug($request->title, 'update');
            }else{
             $blog = new Blog;
             $blog->slug = $this->createSlug($request->title, 'new');
            }
            $blog->title = $request->title;
            $blog->type = $request->type;
            $blog->description = $request->description;
            $blog->keywords = $request->keywords;
            $blog->content = $request->content;
            if($blog->save()){
               return redirect()->back()->with('success', 'Article Saved Successfully');
            }else{
               return redirect()->back()->with('error', 'Something Went Wrong');    
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }

    
    public function show($id)
    {
        echo "show";
    }

 
    public function edit($id)
    {
        $blog = Blog::where('id',$id)->first();
        return view('admin.blog.create')->with('blog', $blog);
    }

    
    public function update(Request $request, $id)
    {
        echo "update";
    }

   
    public function destroy($id)
    {
        echo "delete".$id;
        try {
        $post = Blog::find($id);
        if (!$post) {
        return redirect()->back()->with('error', 'post not found');    
        }
        $post->delete();
        return redirect()->back()->with('success', 'Article Deleted Successfully');
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
