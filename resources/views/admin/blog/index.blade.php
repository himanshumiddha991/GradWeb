<x-admin-layout>
    <div name="header">
        <a class="navbar-brand" href="#pablo">{{ Auth::guard('admin')->user()->name }} {{ __('table') }} </a>
        
    </div>

       <div class="panel-header panel-header-sm">
        <a href="{{ route('admin.blog.create') }}">Create New Article</a>
      </div>
      <div class="content">
             <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Search Article</h4>
              </div>
              <div class="card-body">
                 <form method="get" action="{{ route('admin.blog.index') }}">
                 
                    <div class="d-flex">
                            <div class="form-group mx-2">
                        <label for="name">name</label>
                        <input type="text" class="form-control" value="{{$request->name}}" name="name" id="name" >
                      </div>
                    
               
                      <button type="submit" >
                      <div class="btn btn-primary">
                        Submit
                      </div>  
                      </button>
                    </div>
                  
                    </form>
              </div>
            </div>
          </div>
            <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header">
                <h4 class="card-title"> Blog List</h4>
                <p class="category"> </p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Title
                      </th>
                     <th>
                        Slug
                      </th>
                       <th>
                        Page
                      </th>
                      <th >
                        Action
                      </th>
                    </thead>
                    <tbody>
                      @foreach($blog as $b)
                      <tr>
                  
                        <td>
                          {{$b->title}}
                        </td>
                        <td>
                          {{$b->slug}}
                        </td>
                         <td>
                          {{$b->type}}
                        </td>
                        <td >
                          <a class="btn btn-default" href="{{ route('admin.blog.edit', ['blog' => $b->id]) }}">
                            <p>edit</p>
                          </a>
                          <form action="{{ route('admin.blog.destroy', ['blog' => $b->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">
                                    <p>Delete</p>
                                </button>
                            </form>
                      
                          
                        </td>
         
                      </tr>
                       @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</x-admin-layout>
