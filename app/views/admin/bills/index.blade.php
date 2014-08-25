@section('header_content')
<h1>
    Quản lý hóa đơn
    <small>Danh sách hóa đơn</small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active">Hóa đơn</li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="table-wrap">
            <div class="table-header">
                <?php if (in_array('admin.bills.create', $allowed_routes)): ?>
                    <div class="col-md-2">
                        <a href="{{route('admin.bills.create')}}" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus"></i> Nhập hóa đơn
                        </a>
                    </div>
                <?php endif; ?>
                <select id="bill-select-month" class=" col-md-2 form-control" style="width: 200px;" name="month">
                    <?php foreach ($months as $m): ?>
                        <option value="<?php echo $m ?>" <?php echo $month == $m ? 'selected' : '' ?>><?php echo $m ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="col-md-4 pull-right no-padding">
                    <?php echo View::make('admin.partials.search_tool', array('input' => Input::all()))->render(); ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <h3>Danh sách hóa đơn trong tháng <?php echo $month ?></h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th>Khách hàng</th>
                        <th>Tên sản phẩm</th>
                        <th>Tổng tiền</th>
                        <th>Số điểm</th>
                        <th>Ngày nhập</th>
                        <th style="width: 15%"><?php echo trans('messages.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $index = $bills->getFrom();
                    $allowShow = in_array('admin.bills.show', $allowed_routes);
                    $allowDestroy = in_array('admin.bills.destroy', $allowed_routes);

                    ?>
                    <?php foreach ($bills as $bill): ?>
                        <tr>
                            <td><?php echo $index++ ?></td>
                            <td>{{$bill->buyer->full_name or ''}}</td>
                            <td><?php echo $bill->product_name ?></td>
                            <td><?php echo Common::IntToString($bill->price) ?></td>
                            <td><?php echo Common::IntToString($bill->score) ?></td>
                            <td><?php echo $bill->created_at->format('d \t\h\á\n\g m, Y, H:i') ?></td>
                            <td>
                                <?php if ($allowShow): ?>
                                    <a href="<?php echo route('admin.bills.show', $bill->id) ?>" class="text-primary">
                                        <i class="fa fa-search"> Xem chi tiết</i>
                                    </a>
                                <?php endif; ?>
                                <?php if ($allowDestroy): ?>
                                    <a href="<?php echo route('admin.bills.destroy', $bill->id) ?>"
                                       class="text-danger" 
                                       data-confirm="Bạn có chắc chắn muốn xóa hóa đơn ?"
                                       data-method="delete">
                                        <i class="fa fa-ban"> Xóa</i>
                                    </a>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="table-footer">
                <div class="info-left">
                    <?php
                    echo trans('messages.paging_info', array(
                        'from' => $bills->getFrom(),
                        'to' => $bills->getTo(),
                        'total' => $bills->getTotal(),
                    ));

                    ?>
                </div>
                <div class="info-right">
                    <?php echo $bills->appends(array('month' => $month))->links(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('addon_js')
<script type="text/javascript">
    $('#bill-select-month').on('change', function() {
        var month = $(this).val();
        var dataUrl = baseUrl + '/bills?month=' + month;
        location.href = dataUrl;
    });
</script>
@stop