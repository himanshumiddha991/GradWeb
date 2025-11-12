<x-admin-layout>
    <div name="header">
        <a class="navbar-brand" href="#pablo">{{ Auth::guard('admin')->user()->name }} {{ __('table') }} </a>
        
    </div>

       <div class="panel-header panel-header-sm">
        
      </div>
      <div class="content">
             <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> Search User</h4>

              </div>
              <div class="card-body">
               <a  href="{{ route('admin.admin.create') }}">
                 <p>Create</p>
               </a>
              </div>
            </div>
          </div>
            <div class="col-md-12">
            <div class="card card-plain">
              <div class="card-header">
                <h4 class="card-title"> Admin</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Created At</th>
                        <th colspan="2">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($admins as $admin)
                        <tr>
                          <td>{{ $admin->name }}</td>
                          <td>{{ $admin->email }}</td>
                          <td> @if($admin->roles->isNotEmpty())
                                  {{ $admin->roles->pluck('name')->join(', ') }}
                                @else
                                  —
                                @endif
                          </td>
                          <td>{{ $admin->created_at->format('d M Y') }}</td>
                          <td>
                            <a href="{{ route('admin.admin.edit', $admin) }}">
                              <p>Edit</p>
                            </a>
                          </td>
                          <td>
                            <a href="{{ route('admin.admin.destroy', $admin) }}">
                              <p>Delete</p>
                            </a>
                          </td>
                        </tr>
                      @empty
                        <tr>
                          <td colspan="6" class="text-center">No other admins found.</td>
                        </tr>
                      @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</x-admin-layout>
