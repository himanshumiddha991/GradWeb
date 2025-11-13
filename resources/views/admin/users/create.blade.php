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
                <h4 class="card-title"> Create Users</h4>
              </div>
              <div class="card-body">
                 <form method="post" action="{{ route('admin.users.store') }}">
                 @csrf        
                    <div class="form-group mx-2">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" value="" name="name" id="name" >
                    </div>

                    <div class="form-group mx-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" value="" name="email" id="email" >
                    </div>
                    <div class="form-group mx-2">
                        <label for="mobile">Mobile</label>
                        <input type="tel" id="mobile" class="form-control" value="" name="mobile" id="mobile" >
                    </div>
                    <div class="form-group mx-2">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" value="" name="password" id="password" >
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
    @push('scripts')
        <script>
        function getRandomUsername() {
                $.ajax({
                    type: "POST",
                    data: {
                            _token: "{{ csrf_token() }}", // Include CSRF token here
                            // Other data you want to send
                        },
                    url: "{{ route('admin.getRandomUsername') }}",
                    success: function(response) {
                        $('#username').val(response.username);
                    }
                });
            }
        </script>
    @endpush
</x-admin-layout>
