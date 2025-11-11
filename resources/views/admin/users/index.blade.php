<x-admin-layout>
    <div name="header">
        <a class="navbar-brand" href="#pablo">{{ Auth::guard('admin')->user()->name }} {{ __('table') }} </a>
        
    </div>

       <div class="panel-header panel-header-sm">
        <a href="{{ route('admin.users.create') }}">Create New User</a>
      </div>
      <div class="content">
             <div class="row">
  
            <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header">
                <h4 class="card-title"> User List</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                      <th>
                        Name
                      </th>
                      <th>
                        Email
                      </th>
                    </thead>
                    <tbody>
                      @foreach($user as $u)
                      <tr>
                        <td>
                          {{$u->name}}
                        </td>
                        <td>
                          {{$u->email}}
                        </td> 
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                 {{$user->links()}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</x-admin-layout>
