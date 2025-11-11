<x-admin-layout>
    <div name="header">
        <a class="navbar-brand" href="#pablo">{{ Auth::guard('admin')->user()->name }} {{ __('table') }} </a>
        
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
      
      <div class="content">
             <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Write Article</h4>
              </div>
              <div class="card-body">
                 <form method="post" action="{{ route('admin.blog.store') }}">
                 @csrf
                 @isset($blog)
                <h1>Edit Blog</h1>
                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                @endisset
                    
                      <div class="form-group mx-2">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" value="{{ isset($blog->title) ? $blog->title : '' }}" name="title" id="title" >
                      </div>
                     <div class="form-group mx-2">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" value="{{ isset($blog->description) ? $blog->description : '' }}" name="description" id="description" >
                     </div>
                      <div class="form-group mx-2">
                        <select class="form-select" name="type" aria-label="Default select example">
                          <option selected>Select Type</option>
                          <option value="blog" {{ isset($blog->type) ? ($blog->type=='blog'?'selected':'') : '' }}>Blog</option>
                          <option value="page" {{ isset($blog->type) ? ($blog->type=='page'?'selected':'') : '' }}>Page</option>
                          <option value="custom" {{ isset($blog->type) ? ($blog->type=='custom'?'selected':'') : '' }}>Custom</option>
                        </select>
                     </div>
                      <div class="form-group mx-2">
                        <label for="keyword">Keywords</label>
                        <input type="text" class="form-control" value="{{ isset($blog->keywords) ? $blog->keywords : '' }}" name="keywords" id="keywords" >
                      </div>
                      <div class="form-group mx-2">
                        <label for="content">Content</label>
                        <textarea name="content" value="" id="editor">
                          {{ isset($blog->content) ? $blog->content : '' }}
                        </textarea>                   
                      </div>
               
                      <button type="submit">
                        <div class="btn btn-primary">
                            Submit
                        </div>  
                      </button>
                    
                  
                </form>
              </div>
            </div>
          </div>
            
        </div>
      </div>
</x-admin-layout>
