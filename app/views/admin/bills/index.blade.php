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
                    <a href="{{route('admin.bills.create')}}" class="btn btn-sm btn-primary">
                        <i class="fa fa-plus"></i> Nhập hóa đơn
                    </a>
                <?php endif; ?>
                <div class="col-md-4 pull-right no-padding">
                    <?php echo View::make('admin.partials.search_tool', array('input' => Input::all()))->render(); ?>
                </div>
            </div>
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
                    <?php $index = $bills->getFrom(); ?>
                    <?php foreach ($bills as $bill): ?>
                        <tr>
                            <td><?php echo $index++ ?></td>
                            <td>{{$bill->buyer->full_name or ''}}</td>
                            <td><?php echo $bill->product_name ?></td>
                            <td><?php echo $bill->price ?></td>
                            <td>{{$bill->score}}</td>
                            <td><?php echo $bill->created_at->format('d \t\h\á\n\g m, Y, H:i') ?></td>
                            <td>
                                <a href="<?php echo route('admin.bills.show', $bill->id) ?>" class="text-primary">
                                    <i class="fa fa-search"> Xem chi tiết</i>
                                </a>
                                <a href="<?php echo route('admin.bills.destroy', $bill->id) ?>"
                                   class="text-danger" 
                                   data-confirm="Bạn có chắc chắn muốn xóa hóa đơn ?"
                                   data-method="delete">
                                    <i class="fa fa-ban"> Xóa</i>
                                </a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php
            echo View::make('admin.partials.table_paging', array(
                'collection' => $bills,
            ))->render();

            ?>
        </div>
    </div>
</div>
<div id="modal-member-detail" class="modal fade" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3>Thông tin chi tiết thành viên</h3>
            </div>
            <div class="modal-body" id='form-add-node-wrap'>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Đóng</button>            
            </div>
        </div>
    </div>
</div>
@stop