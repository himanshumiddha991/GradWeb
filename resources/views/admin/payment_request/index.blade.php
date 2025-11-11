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
            <div class="card card-plain">
              <div class="card-header">
                <h4 class="card-title"> Request Status</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                     <th>
                            Method
                        </th>
                        <th>
                            Mobile
                        </th>
                          <th>
                            Amount
                        </th>
                         <th>
                            Status
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Action
                        </th>
                    </thead>
                    <tbody>
                   
                       @foreach($withdraw_data as $wd)
                        <tr>
                            <td>{{$wd->method->name}}</td>
                            <td>{{$wd->mobile}}</td>
                            <td>{{$wd->amount}}</td>
                            <td><span class="status {{$wd->status}}">{{$wd->status}}</span></td>
                            <td> {{ \Carbon\Carbon::parse($wd->created_at)->format('d M Y h:i a') }}
                            </td>
                            <td>
                                 <div class="btn btn-default" data-toggle="modal" data-item-result="{{ $wd->id }}" data-item-id="{{ $wd->id }}" data-target="#requestModal">
                                        update
                                </div>
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

<!-- Modal -->
<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resultModalLabel">Update Result</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="POST" action="{{ route('admin.payment_request.store') }}">

                    @csrf {{-- CSRF protection --}}
                    
                    {{-- Add form fields --}}
          
                    <label for="name">Name:</label>
                    <label for="result">status:</label>
                    <input type="hidden" name="id" id="itemId" required>
                    <select class="form-select" name="status" aria-label="Default select example">
                        <option selected>Select Status</option>
                        <option value="pending">Pending</option>
                        <option value="success">Success</option>
                    </select>
                    {{-- Add more fields as needed --}}

                    <button type="submit">Submit</button>
                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@push('scripts')
        <script>
             $('#requestModal').on('show.bs.modal', function (event) {
             console.log("working");
             var button = $(event.relatedTarget);
              var itemId = button.data('item-id');
              $('#itemId').val(itemId);
          });
        </script>
    @endpush

</x-admin-layout>
