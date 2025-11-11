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
                 <form method="get" action="{{ route('admin.wallet.index') }}">
                 
                    <div class="d-flex">
                            <div class="form-group mx-2">
                        <input type="hidden" class="form-control" value="" name="id" id="id" >
                        <label for="name">name</label>
                        <input type="text" class="form-control" value="{{$request->name}}" name="name" id="name" >
                      </div>
                      <div class="form-group mx-2">
                        <label for="email">email:</label>
                        <input type="text" class="form-control" value="{{$request->email}}" name="email" id="email" >
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
                <h4 class="card-title"> Result List</h4>
                <p class="category"> Here is a subtitle for this table</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Date
                      </th>
                      <th>
                        Name
                      </th>
                      <th>
                        Email
                      </th>
                      <th >
                        Action
                      </th>
                    </thead>
                    <tbody>
                      @foreach($user as $u)
                      <tr>
                        <td>
                          {{ \Carbon\Carbon::parse($u->created_at)->format('y-m-d') }}
                        </td>
                        <td>
                          {{$u->name}}
                        </td>
                          <td>
                          {{$u->email}}
                        </td>
                        <td >
                          <a class="btn btn-default" href="{{ route('admin.wallet.show', ['wallet' => $u->id]) }}">
                            <p>visit</p>
                          </a>
                           <a class="btn btn-default" href="{{ route('admin.payment_request.show', ['payment_request' => $u->id]) }}">
                            <p>Requests</p>
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
