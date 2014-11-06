@section('content')
<div class="row">
    <div class="col-lg-12 pull-right">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-certificate"></i> Thông tin cá nhân</h3>
            </div>
            <div class="panel-body" id="personal-info-wrap">
                <?php echo View::make('member.member.partials._form_personal_info')->render(); ?>
            </div>
        </div>
    </div>
</div>
@stop
@section('addon_js')
<script src="{{asset('assets/js/plugins/jquery.mask.min.js')}}"></script>
@stop
@section('inline_js')
<script>
$('.date_mask').mask('00/00/0000');
$('.money_mask').mask('000 000 000 000 000 000');
</script>
@stop