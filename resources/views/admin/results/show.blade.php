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
                <h4 class="card-title"> {{$game->name}} result</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <form method="post" action="{{ route('admin.result.store') }}">
                    @csrf {{-- CSRF protection --}}
                      <div class="form-group">
                        <input type="hidden" class="form-control" value="{{$game->id}}" name="id" id="id" required>
                        <label for="date">date</label>
                        <input type="date" class="form-control" name="date" id="date" required>
                      </div>
                      <div class="form-group">
                        <label for="result">Result:</label>
                        <input type="number" class="form-control" name="result" id="result" required>
                      </div>
               
                      <button type="submit" >
                      <div class="btn btn-primary">
                        Submit
                      </div>  
                      </button>
                    </form>



                
                </div>
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
                        Result
                      </th>
                      <th colspan="2">
                        Action
                      </th>
                    </thead>
                    <tbody>
                      @foreach($result as $r)
                      <tr>
                        <td>
                          {{ \Carbon\Carbon::parse($r->created_at)->format('y-m-d') }}
                        </td>
                        <td>
                          {{$r->number}}
                        </td>
                        <td colspan="2">
                          <div class="btn btn-default" data-toggle="modal" data-item-result="{{ $r->number }}" data-item-id="{{ $r->id }}" data-target="#resultModal">
                                update
                          </div>
                          
                        </td>
                        <td class="text-right">
                          <form method="POST" action="{{ route('admin.result.destroy', ['result' => $r->id]) }}" class="delete-form">
                                @csrf
                                @method('DELETE')

                                <!-- Delete Button -->
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this item?')">
                                 <div class="btn btn-danger">Delete</div>  
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

      <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resultModalLabel">Update Result</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="POST" action="{{ route('admin.result.update', ['result' => $game->id]) }}">

                    @csrf {{-- CSRF protection --}}
                    @method('PUT')
                    
                    {{-- Add form fields --}}
          
                    <label for="name">Name:</label>
                    <label for="result">Result:</label>
                    <input type="hidden" name="id" id="itemId" required>
                    <input type="number" name="result" id="itemResult" required>

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
             $('#resultModal').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget);
              var itemId = button.data('item-id');
               var itemResult = button.data('item-result');
              $('#itemId').val(itemId);
               $('#itemResult').val(itemResult);
          });
        </script>
    @endpush
</x-admin-layout>
