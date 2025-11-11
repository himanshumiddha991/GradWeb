<x-admin-layout>
    <div name="header">
        <a class="navbar-brand" href="#pablo">{{ Auth::guard('admin')->user()->name }} {{ __('table') }} </a>
        
    </div>

       <div class="panel-header panel-header-sm">
        
      </div>
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
                <h4 class="card-title">Adjust Payment</h4>
              </div>
              <div class="card-body">
                 <form method="post" action="{{ route('admin.wallet.store') }}">
                  @csrf {{-- CSRF protection --}}
                    <div class="d-flex align-items-center">
                            <div class="form-group mx-2">
                        <input type="hidden" class="form-control" value="{{$id}}" name="id" id="id" >
                      </div>
                       <div class="form-group mx-2">
                         <label for="status">status:</label>
                    <select class="form-select"  value="" name="status" id="status" aria-label="Default select example">
                        <option value="" selected>Status</option>
                        <option value="dr">Debit</option>
                        <option value="cr">Credit</option>
                        </select>  
                    </div>
                      
                      <div class="form-group mx-2">
                        <label for="amount">Amount:</label>
                        <input type="number" class="form-control" value="" name="amount" id="amount" >
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
                <h4 class="card-title"> Total Balance : {{$balance}}</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Type
                      </th>
                      <th>
                        Amount
                      </th>
                      <th>
                        balance
                      </th>
                    </thead>
                    <tbody>
                         @php
                            $totalBalance = 0; // Initialize total balance
                        @endphp
                      @foreach($wallet as $w)
                      <tr>
                        <td>
                           {{$w->type}}
                        </td>
                        <td>
                          {{$w->amount}}
                        </td>
                            
                        <td>
                    balance
                        </td>
                     
                      </tr>
                       @endforeach
                    </tbody>
                  </table>
                  {{ $wallet->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</x-admin-layout>
