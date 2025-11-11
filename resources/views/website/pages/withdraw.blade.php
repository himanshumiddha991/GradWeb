
@php
    $pageTitle = 'game ';
    $metaDescription = 'game';
    $metaKeywords = 'game';
@endphp
@include('website.layouts.header')
<div class="container flex-content">
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
  <div class="mt-4">
    <h2 class="text-center">Withdraw Form</h2>
    <form action="{{ route('user.pay_meth_store') }}" method="post">
      @csrf
        <div class="form-group row">
          <label for="enter_amount_for" class="col-sm-2 col-form-label">Amount</label>
          <div class="col-sm-10">
              <input type="number" class="form-control" name="amount" id="enter_amount_for" placeholder="Amount">
          </div>
        </div>

      <div class="form-group row">
          <label class="col-sm-2 col-form-label">Method</label>
        <div class="col-sm-10">
            <select class="form-select w-100" name="method" aria-label="Default select example">
              <option selected>Select Method</option>
              @foreach($data as $d)
              <option value="{{$d->id}}">{{$d->name}}</option>
              @endforeach
          </select>
        </div>
      </div>

      <div class="form-group row">
          <label for="mobile_number_for" class="col-sm-2 col-form-label">Mobile Number</label>
          <div class="col-sm-10">
            <input type="number" name="mobile_number" class="form-control" id="mobile_number_for" aria-describedby="emailHelp" placeholder="Enter Mobile Number">
          </div>
        </div>
      <div class="form-group row justify-content-center py-2">
        <button type="submit" class="btn btn-primary bg-light text-dark">Submit</button>
      </div>
   </form>
  </div>

      <div class="table-responsive history-container mt-4">
             <h2 class="text-center my-2">Withdraw History</h2>
                <table class="table text-center text-light">
                    <thead class="">
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>         
      </div>
  
</div>


@include('website.layouts.footer')
</body>

</html>