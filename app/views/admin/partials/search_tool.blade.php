<?php echo Former::open()->method('get')->class('form-table-search') ?>
<div class="box-tools">
    <div class="input-group">
        <input type="text" name="keyword" class="form-control input-sm pull-right input-table-search" value="{{$input['keyword'] or ''}}" placeholder="<?php echo trans('messages.search'); ?>">
        <div class="input-group-btn">
            <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
        </div>
    </div>
</div>
<?php echo Former::close(); ?>