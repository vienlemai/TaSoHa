@section('content')
<?php
echo View::make('member.member.partials._bonus', array(
    'member' => $member,
    'bonus' => $bonus,
    'isPaid' => $isPaid,
    'isCalculated' => $isCalculated,
    'month' => $month,
    'receipt' => $receipt,
    'total' => round($total, 1),
    'months' => $months
));

?>
@stop
@section('inline_js')
<script type="text/javascript">
    $('body').on('change', '#bonus-month-select', function() {
        var url = baseUrl + '/bonus';
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