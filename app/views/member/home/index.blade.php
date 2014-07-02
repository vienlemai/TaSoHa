@section('content')
<?php echo View::make('layouts/frontend/_flash')->render() ?>
<div class="zTreeDemoBackground">
    <a href="javascript:void(0)">Thêm mới thành viên</a>
    <div class="form-add-member">
        <form method="POST" action="{{route('member.create',1)}}">
<!--            <input class="" type="text" name="email" value="" placeholder="email"/>
            <br/>
            <input class="" type="password" name="password" value="" placeholder="Mật khẩu"/>
            <br/>-->
            <input class="" type="text" name="full_name" value="" placeholder="Họ tên" autofocus='true'/>
            <br/>
            <input class="" type="submit" value="Lưu"/>
        </form>
    </div>
    <ul id="org" style="display:none">
        <?php echo $treeData ?>
    </ul>
    <div id="chart" class="orgChart"></div>
</div>
@stop