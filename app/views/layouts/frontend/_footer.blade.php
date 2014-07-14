<footer>
    <div class="row">
        <div class="col-lg-12 text-center">
            <hr>
            <ul class="list-unstyled list-inline">
                <li class="pull-right"><a href="#" id="go-top" class="btn btn-xs btn-primary" title="Lên đầu trang"><i class="fa fa-angle-up"></i></a></li>
                <li><a href="<?php echo route('fe.root') ?>"><i class="fa fa-home"></i> Trang chủ</a></li>
                <li><a href="<?php echo route('fe.page.show', Page::TASOHA_CONTACT) ?>"><i class="fa fa-envelope"></i> <?php echo Page::textForPage(Page::TASOHA_CONTACT) ?></a></li>
                <li><a href="<?php echo route('fe.page.show', Page::TASOHA_TERMS_OF_USE) ?>"><i class="fa fa-list"></i> <?php echo Page::textForPage(Page::TASOHA_TERMS_OF_USE) ?></a></li>                                
            </ul>
            <p>Copyright <a href="#" rel="nofollow">Tasoha Group</a> 2014</p>
        </div>
    </div>

</footer>