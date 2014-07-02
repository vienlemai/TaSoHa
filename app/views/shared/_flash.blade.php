@if(Session::has('success') || Session::has('error') || Session::has('warning'))
<div class="row">
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    @elseif(Session::has('error'))
    <div class="alert alert-danger">
        {{Session::get('error')}}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    @elseif(Session::has('warning'))
    <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    @endif
</div>
@endif