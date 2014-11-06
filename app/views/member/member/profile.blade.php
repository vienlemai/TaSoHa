@section('content')
<div class="row">
    <div class="col-lg-12 pull-right">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-certificate"></i> Thông tin cá nhân</h3>
            </div>
            <div class="panel-body" id="personal-info-wrap">
                <h4 class="right-sub-title">Thành viên <?php echo $member->full_name ?></h4>
                <table class="table table-bordered table-striped ml20">
                    <tbody>
                        <tr>
                            <td>Mã số</td>
                            <td><?php echo $member->uid; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $member->email ?></td>
                        </tr>
                        <tr>
                            <td>Điện thoại</td>
                            <td><?php echo $member->phone ?></td>
                        </tr>
                        <tr>
                            <td>Chứng minh nhân dân</td>
                            <td><?php echo $member->identify_number ?></td>
                        </tr>
                        <tr>
                            <td>Ngày tham gia</td>
                            <td><i><?php echo $member->created_at->format('m/Y') ?></i></td>
                        </tr>
                        <?php if(!empty($member->sunMember->parent)): ?>
                        <tr>
                            <td>Người giới thiệu</td>
                            <td>{{$member->sunMember->parent->member->full_name or ''}}</td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($member->binaryMember->parent)): ?>
                        <tr>
                            <td>Người quản lý</td>
                            <td>{{$member->binaryMember->parent->member->full_name or ''}}</td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td>Cấp bậc hiện tại</td>
                            <td><strong><?php echo Member::$regencyLabel[$member->regency] ?></strong></td>
                        </tr>
                        <tr>
                            <td>Điểm tích lũy</td>
                            <td style="color: #F57D30"><strong><?php echo Common::IntToString($member->score) ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop