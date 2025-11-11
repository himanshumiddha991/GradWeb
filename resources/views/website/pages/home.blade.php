<!-- Set values for the header in the main file -->
@php
    $pageTitle = 'Satta King | satta result | gali result |Satta Online Result| satta king bet';
    $metaDescription = 'sattaking, Satta king result, satta king bet, satta king 2023, satta no, disawar satta king news, desawar result, gali resul, faridabad result, satta king bet';
    $metaKeywords = 'Satta king, Sattaking, Satta result, Gali result, Gali satta, Satta bazar, Gali satta result, Satta king result, Satta game today result, Satta king live, Desawar satta';
@endphp
@include('website.layouts.header')
    <div id="header">

        <div id="logo">
            <a href="/">
        <img src="{{ asset('assets/img/logo.png') }}" id="logo-img"  title="Satta King Bazar Daily Results And Full Monthly Chart"
                    alt="sattakingbet.com | Super Fast Satta Results and Monthly Chart of December 2023 for Gali, Desawar, Ghaziabad and Faridabad" />
            </a>
        </div>
        <div class="container">
            <div class="rate-container">
                 <h1>Satta King Bet Online Play Rate</h1>
                 <div class="d-flex justify-content-center align-items-center">
                    <img class="pointing-right" src="{{ asset('assets/img/pointing-right.png') }}" alt="">
                     <h2>
                        99
                    </h2>
                    <img class="pointing-left" src="{{ asset('assets/img/pointing-left.png') }}" alt="">
                 </div>
               
            </div>
           

        </div>
        <div id="section" style="height: auto !important;">
            <div id="container" style="height: auto !important;">
                           @if (Auth::check())
                                {{-- User is logged in --}}
                                Welcome, {{ Auth::user()->name }}!
                            @else
                                {{-- User is not logged in --}}
                                Please log in to access this page.
                            @endif
                <h1 class="ads" style="padding:2px 0; margin:0; font-size: small">
                    Daily Superfast Satta King Result of December 2023 And Leak Numbers for Gali, Desawar, Ghaziabad and
                    Faridabad With
                    Complete Old Satta King Chart of 2015, 2016, 2017, 2018, 2019, 2020, 2021, 2023 From Satta King
                    Fast, Satta
                    King Ghaziabad, Satta King Desawar, Satta King Gali, Satta King Faridabad.
                </h1>
                <marquee class="gr-marquee">
                    <h1>Satta king, Sattaking, Desawar result, Satta result, Satta king result, Satta king live, Satta
                        king online ,
                        Gali result, Faridabad result, Gaziyabad result, Satta king chart, Desawar record chart, Gali
                        record chart,
                        Faridabad record chart, Gaziyabad record chart, Dishawar Satta King.</h1>
                </marquee>
                <div class="ads" style="padding:8px 0; margin:8px 0; background: white">
                    <p style="color:blue; font-size: small;">
                        sattakingbet.com is most populer gaming discussion forum for players to use freely and we are
                        not in
                        partenership with any gaming company.
                    </p>
                </div>
        
                <div style="margin: 8px 1% 2px 1%; color: #339966">Updated: <time
                        datetime="{{ \Carbon\Carbon::now()}}">{{ \Carbon\Carbon::now()->format('F d, Y h:i A') }}</time> IST.</div>
                <div class="main-content" style="height: auto !important;">
                    <table class="quick-result-board">
                        <tbody>
                            <tr class="board-title">
                                <th colspan="4">
                                    <h1>Satta King Fast Results of {{ \Carbon\Carbon::now()->format('F d, Y') }} &amp; {{ \Carbon\Carbon::yesterday()->format('F d, Y') }}</h1>
                                </th>
                            </tr>
                            <tr class="board-head">
                                <th class="games-name">
                                    <h2>Games List</h2>
                                </th>
                                <th>
                                    <h2>Play Game</h2>
                                </th>
                                <th class="yesterday-date">
                                    <h2>{{ \Carbon\Carbon::yesterday()->format('D. d') }}th</h2>
                                </th>
                                <th class="today-date">
                                    <h2>{{ \Carbon\Carbon::now()->format('D. d') }}th</h2>
                                </th>
                            </tr>
                         
                            @foreach($games as $index => $g)
                                  <tr class="game-result" id="GB">
                                <td class="game-details">
                                    <h3 class="game-name">{{ucfirst($g->name)}}</h3>
                                    <h3 class="game-time"> at {{ \Carbon\Carbon::parse($g->result_timing)->format('h:i A') }}</h3>
                                    
                                </td>
                                <td class="center-content">
                                   @if($g->status==1)
                                    <a class="success-btn" href="{{ route('user.game', $g->id) }}">Play</a>
                                    @else
                                    <a class="timeout-btn">Time Out</a>
                                    @endif
                                </td>
                                <td class="yesterday-number">
                                    <h3>
                                    
                                    0  
                                    <!-- {{is_null($g->previous)?"XX":($g->previous->number<10?'0'.$g->previous->number:$g->previous->number)}}</h3> -->
                                </td>
                                <td class="today-number">
                                    <h3>
                                    
                                    0
                                    <!-- {{is_null($g->current)?"XX":($g->current->number<10?'0'.$g->current->number:$g->current->number)}}</h3> -->
                                </td>
                            </tr>
                             @if($index == 1)
                                @break
                            @endif
                            @endforeach
                        
                            <tr class="board-head" id="old">
                                <th colspan="4">
                                    <h2><a href="#timewise-result">Click here for more games results.</a></h2>
                                </th>
                            </tr>
                        </tbody>
                    </table>

                    <table class="quick-result-board" id="timewise-result">
                        <tbody>
                            <tr class="board-title">
                                <th colspan="4">
                                    <h1>Timewise Superfast Satta King Results of {{ \Carbon\Carbon::now()->format('F d, Y') }} &amp; {{ \Carbon\Carbon::yesterday()->format('F d, Y') }}</h1>
                                </th>
                            </tr>
                            <tr class="board-head">
                                <th class="games-name">
                                    <h2>Games List</h2>
                                </th>
                                    <th>
                                    <h2>Play Game</h2>
                                </th>
                               <th class="yesterday-date">
                                    <h2>{{ \Carbon\Carbon::yesterday()->format('D. d') }}th</h2>
                                </th>
                                <th class="today-date">
                                    <h2>{{ \Carbon\Carbon::now()->format('D. d') }}th</h2>
                                </th>
                            </tr>
                                  @foreach($games as $index => $g)
                                  @if($index < 2)
                                        @continue
                                    @endif
                                  <tr class="game-result" id="GB">
                                <td class="game-details">
                                    <h3 class="game-name">{{ucfirst($g->name)}}</h3>
                                    <h3 class="game-time"> at {{ \Carbon\Carbon::parse($g->result_timing)->format('h:i A') }}</h3>
                                    
                                </td>
                                   <td class="center-content">
                                    @if($g->status==1)
                                    <a class="success-btn" href="{{ route('user.game', $g->id) }}">Play</a>
                                    @else
                                    <a class="timeout-btn">Time Out</a>
                                    @endif
                                </td>
                                <td class="yesterday-number">
                                    <h3>
                                       
                                        0   
                                    <!-- {{is_null($g->previous)?"XX":($g->previous->number<10?'0'.$g->previous->number:$g->previous->number)}}</h3> -->
                                </td>
                                <td class="today-number">
                                    <h3>
                                   
                                        0
                                    <!-- {{is_null($g->current)?"XX":($g->current->number<10?'0'.$g->current->number:$g->current->number)}}</h3> -->
                                </td>
                            </tr>
                          
                            @endforeach
                        </tbody>
                    </table>

                </div>

       

             
            </div>

      


        </div>
    </div>
 @include('website.layouts.footer')
</body>

</html>