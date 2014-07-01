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
            <input class="" type="text" name="full_name" value="" placeholder="Họ tên"/>
            <br/>
            <input class="" type="submit" value="Lưu"/>
        </form>
    </div>
    <ul id="member-tree" class="ztree"></ul>
</div>
<script type="text/javascript">
    var treeData = <?php echo $treeData ?>;
</script>
@stop