@section('content')
<?php
echo View::make('member.member.partials._bills', array(
    'member' => $member,
    'bills' => $bills,
    'months' => $months,
    'month' => $month,
));

?>
@stop
@section('inline_js')
<script type="text/javascript">
    $('body').on('change', '#bills-month-select', function() {
        var url = baseUrl + '/bills';
        var month = $(this).val();
        $.ajax({
            url: url,
            data: {month: month},
            type: 'get',
            success: function(data) {
                //console.log(data);
                $('#right-content').html(data);
            },
            error: function(e) {
                alert('Đã có lỗi xảy ra, vui lòng thử lại');
            }
        });
        return false;
    });
</script>
@stop