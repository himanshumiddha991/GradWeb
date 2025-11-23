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
                <h4 class="card-title">Edit Game</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                 <!-- resources/views/games/edit.blade.php -->

                       <form class="scrollable" action="{{ route('admin.games.update', $game->id) }}" method="POST">
                           @csrf
                           @method('PUT')

                           <div class="form-group mb-3">
                               <label for="name">Name</label>
                               <input type="text" name="name" class="form-control" value="{{ old('name', $game->name) }}" required>
                           </div>

                           <div class="form-group mb-3">
                               <label for="result_timing">Result Timing</label>
                               <input type="time" name="result_timing" class="form-control" value="{{ old('result_timing', $game->result_timing) }}" required>
                           </div>

                           <div class="form-group mb-3">
                               <label for="start_time">Start Time</label>
                               <input type="time" name="start_time" class="form-control" value="{{ old('start_time', $game->start_time) }}">
                           </div>

                           <div class="form-group mb-3">
                               <label for="end_time">End Time</label>
                               <input type="time" name="end_time" class="form-control" value="{{ old('end_time', $game->end_time) }}">
                           </div>

                            <div id="timeAmountWrapper">

                                {{-- Existing rows --}}
                                @php $index = 0; @endphp
                                @foreach($timeAmount as $time => $amount)
                                    <div class="row mb-2 time-amount-row existing-row">
                                        <div class="col-md-5">
                                            <input type="time" name="time[]" value="{{ $time }}" class="form-control" required>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="number" name="amount[]" value="{{ $amount }}" class="form-control" placeholder="Enter amount" required>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <button type="button" class="btn btn-danger removeRow">-</button>
                                        </div>
                                    </div>
                                    @php $index++; @endphp
                                @endforeach

                                {{-- The ADD row (always last) --}}
                                <div class="row mb-2 time-amount-row add-row">
                                    <div class="col-md-5">
                                        <input type="time" name="time[]" class="form-control">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="number" name="amount[]" class="form-control" placeholder="Enter amount">
                                    </div>
                                    <div class="col-md-2 d-flex align-items-center">
                                        <button type="button" class="btn btn-success addRow">+</button>
                                    </div>
                                </div>

                            </div>

                           <button type="submit" class="btn btn-primary">Update</button>
                       </form>
                 
                </div>
              </div>
            </div>
          </div>
 
        </div>
      </div>
      {{-- Script --}}
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).on('click', '.addRow', function() {
    let html = `
    <div class="row mb-2 time-amount-row">
        <div class="col-md-5">
            <input type="time" name="time[]" class="form-control" required>
        </div>
        <div class="col-md-5">
            <input type="number" name="amount[]" class="form-control" placeholder="Enter amount" required>
        </div>
        <div class="col-md-2 d-flex align-items-center">
            <button type="button" class="btn btn-danger removeRow">-</button>
        </div>
    </div>`;
    $('#timeAmountWrapper').append(html);
});

$(document).on('click', '.removeRow', function() {
    $(this).closest('.time-amount-row').remove();
});
</script>
</x-admin-layout>
