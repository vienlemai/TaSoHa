@section('content')
<!--<div class="breadcrumb-wrap">
    <ul class="breadcrumb" style="margin-bottom: 5px;">
        <li><a href="#">Trang chủ</a></li>
        <li><a href="#">Cá nhân</a></li>
        <li class="active">Thành viên</li>
    </ul>
</div>-->
<?php echo View::make('layouts/frontend/_flash')->render() ?>
<h3><i class="fa fa-certificate"></i> Thông tin hoa hồng</h3>
<table class="table">
    <thead>
        <tr>
            <td>Tên hoa hồng</td>
            <td>Tổng tiền</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($bonus as $b): ?>
            <tr>
                <td><?php echo $b['name']; ?></td>
                <td><?php echo $b['amount'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<hr>
<div id="bonus-overview-wrap">

</div>
<h3><i class="fa fa-sitemap"></i> Sơ đồ thành viên</h3>
<hr>
<div class="members-tree-wrap primary">
    <ul id="org" style="display:none">
        <?php echo $treeData ?>
    </ul>
    <input id="url-show-member" type="hidden" name="" value="<?php echo route('member.show', -1) ?>"/>
    <div id="chart" class="orgChart"></div>
</div>
@stop