 <x-admin-layout>
    <div name="header">
        <a class="navbar-brand" href="#pablo">{{ Auth::guard('admin')->user()->name }} {{ __('table') }} </a>
        
    </div>

       <div class="panel-header panel-header-sm">
        
      </div>
      <div class="content">
             <div class="row">
            <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header">
                <h4 class="card-title"> Rate List</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
 
                <table class="table">
                    <thead class=" text-primary">
                    <th>
                        Type
                    </th>
                    <th>
                        Rate
                    </th>
                    <th >
                        Action
                    </th>
                    </thead>
                    <tbody>
                    @foreach($list as $l)
                    <tr>
                        <td>
                        {{$l->type}}
                        </td>
                        <td>
                        {{$l->rate}}
                        </td>
                        <td>
                        <a class="btn btn-default">
                            <p>edit</p>
                        </a>
                        <a class="btn btn-default">
                            <p>delete</p>
                        </a>
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