<!-- Set values for the header in the main file -->
@php
    $pageTitle = 'game ';
    $metaDescription = 'game';
    $metaKeywords = 'game';
@endphp
@include('website.layouts.header')

<div class="container 100-vh">

         <div class="table-responsive history-container mt-4">
                     <h2 class="text-center my-2">Game History</h2>
                        <table class="table text-center text-light">
                            <thead class="">
                                <th>
                                    Number
                                </th>
                                <th>
                                    Amount
                                </th>
                                  <th>
                                    Game
                                </th>
                                 <th>
                                    Type
                                </th>
                                 <th>
                                    Status
                                </th>
                                <th>
                                    Date
                                </th>
                            </thead>
                            <tbody>
                                @foreach($data as $d)
                                <tr>
                                    <td>{{$d->number}}</td>
                                    <td>{{$d->amount}}</td>
                                    <td>{{$d->game->name}}</td>
                                    <td>{{$d->type}}</td>
                                    <td><span class="status {{$d->status}}">{{$d->status}}</span></td>
                                    <td> {{ \Carbon\Carbon::parse($d->created_at)->format('d M Y h:i a') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                  {{$data->links()}}
                    </div>


</div>


 @include('website.layouts.footer')
</body>

</html>