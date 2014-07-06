@section('content')
<?php echo View::make('layouts/frontend/_flash')->render() ?>
<div class="zTreeDemoBackground">
    <ul id="org" style="display:none">
        <?php echo $treeData ?>
    </ul>
    <input id="url-show-member" type="hidden" name="" value="<?php echo route('member.show', -1) ?>"/>
    <div id="chart" class="orgChart"></div>
</div>
@stop