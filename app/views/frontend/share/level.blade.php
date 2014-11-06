
@section('content')
<?php if ($shares[0]->count() > 0) : ?>
    <div class="row">
        <div class="col-lg-12">
            <h4 class="title">Danh sách chờ thưởng giai đoạn 1</h4>
            <ul class="marquee">
                <?php foreach ($shares[0] as $share) : ?>
                    <li><?php echo $share->member->full_name.'---' ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
<div class="row">
    <div class='col-lg-12 no-padding' style="margin-top: 10px;">
        <h3 class="text-success title">Thưởng cổ đông</h3>
        <div class="col-lg-3 no-padding">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list-ul"></i> Gia đoạn 1</h3>
                </div>
                <div class="panel-body">
                    <?php if (!$shares[1]->isEmpty()): ?>
                        <table class="table table-striped">
                            <tbody>
                                <?php foreach ($shares[1] as $share): ?>
                                    <tr>
                                        <td><?php echo $share->member->full_name ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>   
        </div>
        <div class="col-lg-3 no-padding">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list-ul"></i> Gia đoạn 2</h3>
                </div>
                <div class="panel-body">
                    <?php if (!$shares[2]->isEmpty()): ?>
                        <table class="table table-striped">
                            <tbody>
                                <?php foreach ($shares[2] as $share): ?>
                                    <tr>
                                        <td><?php echo $share->member->full_name ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>   
        </div>
        <div class="col-lg-3 no-padding">
            <div class="panel panel-warning">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list-ul"></i> Gia đoạn 3</h3>
                </div>
                <div class="panel-body">
                    <?php if (!$shares[3]->isEmpty()): ?>
                        <table class="table table-striped">
                            <tbody>
                                <?php foreach ($shares[3] as $share): ?>
                                    <tr>
                                        <td><?php echo $share->member->full_name ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>   
        </div>
        <div class="col-lg-3 no-padding">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list-ul"></i> Gia đoạn 4</h3>
                </div>
                <div class="panel-body">
                    <?php if (!$shares[4]->isEmpty()): ?>
                        <table class="table table-striped">
                            <tbody>
                                <?php foreach ($shares[4] as $share): ?>
                                    <tr>
                                        <td><?php echo $share->member->full_name ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>   
        </div>
    </div>
</div>
@stop