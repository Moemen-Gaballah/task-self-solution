@include('partials.head')
@include('partials.nav')
<div id="app">
    <div class="row">
        <div class="col-md-3" style="float: right">  @include('partials.sidebar')</div>
        <div class="col-md-8">
                <div class="container">@include('partials.messages')</div>
                @yield('content')
        </div>
    </div>
</div>
@include('partials.footer')