<!-- Set values for the header in the main file -->
@php
    $pageTitle = 'game ';
    $metaDescription = 'game';
    $metaKeywords = 'game';
@endphp
@include('website.layouts.header')

<div class="container">
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
       <div class="row">
        <div class="text-center w-100 my-2">Play {{$check->name}} Game</div>
    </div>
    
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-jodi-tab" data-bs-toggle="tab" data-bs-target="#nav-jodi" type="button" role="tab" aria-controls="nav-jodi" aria-selected="true">Jodi</button>
    <button class="nav-link" id="nav-haruf-tab" data-bs-toggle="tab" data-bs-target="#nav-haruf" type="button" role="tab" aria-controls="nav-haruf" aria-selected="false">Haruf</button>
    </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-jodi" role="tabpanel" aria-labelledby="nav-jodi-tab">
    <div class="row">
        <div class="col-md-8">
             <form id="jodi-form" action="{{ route('user.store') }}" method="post">
                @csrf
                <input type="hidden" name="game_id" value="{{$id}}">
                <input type="hidden" name="type" value="jodi">
                <input type="hidden" name="game_date" value="{{$check->date}}">
                <div class="game-box input-container">
                        @for ($i = 1; $i <= 99; $i++)
                        <div class="input-item">
                            <label for="input{{ $i }}">{{ $i }}:</label>
                            <input type="number" class="jodi_inputField" data-key="{{$i}}"  name="inputs[]" id="input{{ $i }}" >
                            <br>
                        </div>
                        @endfor
                </div>
            
                <div class="space-bottom">

                </div>
            </form>
        </div>
        <div class="col-md-4 mobile-responsive">
            <div class="betting-report p-4">
                <div class="text-center">
                    <div class="d-flex justify-content-around align-items-center">
                        <div>Total : <span id="jodi_total">0</span> </div>
                        <div class="btn d-block d-md-none" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">expand</div>
                    </div>
                    

                </div>
                 
                <div class="row">
                     <div class="collapse multi-collapse w-100 d-md-block" id="multiCollapseExample1">
                        <div class="table-responsive">

                        <table class="table text-center">
                            <thead class="">
                            <th>
                                Number
                            </th>
                            <th>
                                Amount
                            </th>
                            </thead>
                            <tbody id="jodi_arrayList">
                            </tbody>
                        </table>
                  
                    </div>
                    </div>
                     
                </div>
                <div class="row">
                    <div class="button-container">
                        <button class="btn btn-default bg-light jodi_submit-btn">Submit</button>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
  <div class="tab-pane fade" id="nav-haruf" role="tabpanel" aria-labelledby="nav-haruf-tab">
        <div class="row">
            <div class="col-md-8">
                <form id="haruf-form" action="{{ route('user.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="game_id" value="{{$id}}">
                    <input type="hidden" name="type" value="haruf">
                    <input type="hidden" name="game_date" value="{{$check->date}}">
                    <div class="game-box input-container">
                            @for ($i = 1; $i <= 9; $i++)
                            <div class="input-item">
                                <label for="input{{ $i }}">{{ $i }}:</label>
                                <input type="number" class="haruf_inputField" data-key="{{$i}}"  name="inputs[]" id="input{{ $i }}" >
                                <br>
                            </div>
                            @endfor
                    </div>
                
                    <div class="space-bottom">

                    </div>
                </form>
            </div>
            <div class="col-md-4 mobile-responsive">
                <div class="betting-report p-4">
                    <div class="text-center">
                        <div class="d-flex justify-content-around align-items-center">
                            <div>Total : <span id="haruf_total">0</span> </div>
                            <div class="btn d-block d-md-none" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">expand</div>
                        </div>
                        

                    </div>
                    
                    <div class="row">
                        <div class="collapse multi-collapse w-100 d-md-block" id="multiCollapseExample1">
                            <div class="table-responsive">

                            <table class="table text-center">
                                <thead class="">
                                <th>
                                    Number
                                </th>
                                <th>
                                    Amount
                                </th>
                                </thead>
                                <tbody id="haruf_arrayList">
                                </tbody>
                            </table>
                    
                        </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="button-container">
                            <button class="btn btn-default bg-light haruf_submit-btn">Submit</button>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
 </div>    
</div>
 
   

</div>

@section('footer-scripts')
<script>
        $(document).ready(function() {
            var jodiInput = {};
            var harufInput = {};
            // jodi input field
            $('.jodi_inputField').on('input', function() {
                updateArray(jodiInput, $(this).data('key'), $(this).val());
                calculateTotal('.jodi_inputField','#jodi_total');
                displayArray('#jodi_arrayList', jodiInput);
            });
            $('.jodi_submit-btn').click( function() {
               $('form#jodi-form').submit();
            });

            // haruf input field
            $('.haruf_inputField').on('input', function() {
                updateArray(harufInput, $(this).data('key'), $(this).val());
                calculateTotal('.haruf_inputField','#haruf_total');
                displayArray('#haruf_arrayList', harufInput);
            });
            $('.haruf_submit-btn').click( function() {
               $('form#haruf-form').submit();
            });


            
            function updateArray(array, key, value) {
                // Update the array with the key-value pair
                if (value !== "") {
                    array[key] = parseFloat(value) || 0;
                } else {
                    // Remove the entry from the array when the value is empty
                    delete array[key];
                }
                console.log("array", array);
            }
            function calculateTotal(input, total_container) {
                var total = 0;
                $(input).each(function() {
                    var value = parseFloat($(this).val()) || 0;
                    total += value;
                });
                $(total_container).text(total);
            }
            function displayArray(array_container, array_value) {
                // Update the array list in the HTML
                var $arrayList = $(array_container);
                $arrayList.empty(); // Clear previous entries
                $.each(array_value, function(key, value) {
                    $arrayList.append('<tr ><td>' + key + '</td><td>' + value + '</td></tr>');
                });
            }
        });
</script>
  @endsection
 @include('website.layouts.footer')
</body>

</html>