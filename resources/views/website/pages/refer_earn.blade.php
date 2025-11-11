
@php
    $pageTitle = 'game ';
    $metaDescription = 'game';
    $metaKeywords = 'game';
@endphp
@include('website.layouts.header')
<div class="container flex-content">
  <div class="mt-4">
    <h2 class="text-center">Refer and Earn</h2>
    <div class="d-md-flex">
    <div>Refferal link : <span class="link-cover">http://localhost:8000/register/{{auth()->user()->referral_code}}</span></div>
    <div class="ml-md-4 pointer d-flex align-items-center">
      <div id="copyText" onclick="copyText()" >Copy Link</div>
      <div id="copyIcon">
        <img class="clipboard" height="20" src="{{ asset('assets/img/clipboard.png') }}" alt="">
       </div>
    </div>
    
    
    </div>
    <div class="mt-2 ">commision : {{auth()->user()->commission}}%</div>
  </div>

      <div class="table-responsive history-container mt-4">
             <h2 class="text-center my-2">Referer Users</h2>
                <table class="table text-center text-light">
                    <thead class="">
                        <th>
                            User Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Earnings
                        </th>
                        <th>
                            Register Date
                        </th>
                    </thead>
                    <tbody>
                        @foreach($array as $a)
                        <tr>
                            <td>{{$a['name']}}</td>
                            <td>{{$a['email']}}</td>
                            <td>{{$a['sum']}}</td>
                            <td> {{$a['date']}}
                            </td>
                        </tr>
                        @endforeach
                 </tbody>
           </table>         
      </div>
</div>
<script>
    function copyText() {
      var textToCopy = "http://localhost:8000/register/{{auth()->user()->referral_code}}";

      var tempTextarea = document.createElement("textarea");
      tempTextarea.value = textToCopy;

      document.body.appendChild(tempTextarea);

      tempTextarea.select();
      tempTextarea.setSelectionRange(0, 99999);
      document.execCommand("copy");
      document.body.removeChild(tempTextarea);
      document.getElementById("copyIcon").innerHTML = '<img class="clipboard" height="20" src="{{ asset('assets/img/check-mark.png') }}" alt="">';
      document.getElementById("copyText").innerHTML = "copied";

      document.getElementById("copyText").classList.add("copied");
    }
</script>
@include('website.layouts.footer')
</body>

</html>