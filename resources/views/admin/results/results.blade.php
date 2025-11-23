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
                <h4 class="card-title"> Simple Table</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Name
                      </th>
                     <th>
                        Result Time
                      </th>
                      <th class="text-right">
                        Result
                      </th>
                    </thead>
                    <tbody>
                        @foreach ($game as $key => $value)
                         <tr>
                        <td>
                         {{ $value->name }}
                        </td>
                         <td>
                        
                         {{ \Carbon\Carbon::parse($value->result_timing)->format('h:i A') }}
                        </td>
                        <td class="text-right">
                          <a class="btn btn-default" href="{{ route('admin.result.edit', ['result' => $value->id]) }}">
                            <p>edit</p>
                          </a>
                        </td>
                        <td class="text-right">
                          <a class="btn btn-default" href="{{ route('admin.result.show', ['result' => $value->id]) }}">
                            <p>result</p>
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
