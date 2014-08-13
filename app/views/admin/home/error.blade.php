@extends('layouts.admin-login')
@section('content')
<div class="form-box" id="login-box">
    <?php if ($type == 'permission'): ?>
        <div class="alert alert-danger alert-dismissable">
            <i class="fa fa-ban"></i>
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <b>Error!</b> You don't have permission on that action
            <a href="<?php echo route('admin.root') ?>">Back to home</a>
        </div>
    <?php endif; ?>
</div>
@stop