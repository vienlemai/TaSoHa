@section('breadcrumb')
<a class="btn btn-success" href="<?php echo route('fe.shares') ?>">Danh sách cổ phần</a>
<a class="btn btn-primary" href="<?php echo route('fe.share.level') ?>">Cổ phần thưởng</a>
@stop

@section('content')
<div class="row">
    <div class='col-lg-12'>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 5%">#</th>
                    <th>Khách hàng</th>
                    <th>Số tiền</th>
                    <th>Điểm</th>
                    <th>Ngày nhập</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $index = $shares->getFrom();

                ?>
                <?php foreach ($shares as $share): ?>
                    <tr>
                        <td><?php echo $index++ ?></td>
                        <td>{{$share->member->full_name or ''}}</td>
                        <td><?php echo Common::IntToString($share->price) ?></td>
                        <td><?php echo Common::IntToString($share->score) ?></td>
                        <td><?php echo $share->created_at->format('d \t\h\á\n\g m, Y, H:i:s') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">
        <?php echo $shares->links(); ?>
    </div>

</div>
@stop