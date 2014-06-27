@extends('layouts.admin-login')
@section('content')
<div class="form-box" id="login-box">
    <div class="header"><?php echo trans('messages.sign_in'); ?></div>
    <form action="<?php echo route('admin.login') ?>" method="post">
        <div class="body bg-gray">
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="<?php echo trans('messages.email'); ?>"/>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="<?php echo trans('messages.password'); ?>"/>
            </div>          
            <div class="form-group">
                <input type="checkbox" name="remember_me"/> <?php echo trans('messages.remember_me'); ?>
            </div>
        </div>
        <div class="footer">                                                               
            <button type="submit" class="btn bg-olive btn-block"><?php echo trans('messages.sign_in'); ?></button>  
            <p><a href="#"><?php echo trans('messages.forgot_password'); ?></a></p>
        </div>
    </form>
</div>
@stop