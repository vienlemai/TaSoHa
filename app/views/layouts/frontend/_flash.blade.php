@if(Session::has('success') || Session::has('error') || Session::has('warning'))
<div class="message-top">
    <button data-dismiss="alert" class="close" type="button">×</button>
    <div class="container">
        @if(Session::has('success'))
            {{Session::get('success')}}
        @elseif(Session::has('error'))
            {{Session::get('error')}}
        @elseif(Session::has('warning'))
            {{Session::get('error')}}
        @endif
        You can put your notification in this bar. click on the x on right to close
    </div>
</div>
@endif