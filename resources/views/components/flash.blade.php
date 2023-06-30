@if(Session::has("message"))
    <p class="flash animate__fadeInRight">{{ Session("message") }}</p>
@endif