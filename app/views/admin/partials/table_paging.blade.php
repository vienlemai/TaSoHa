<div class="clearfix">
    <div class="col-xs-6">
        <div class="pull-left">
            <?php
            echo trans('messages.paging_info', array(
                'from' => $collection->getFrom(),
                'to' => $collection->getTo(),
                'total' => $collection->getTotal(),
            ));
            ?>
        </div>
    </div>
    <div class="col-xs-6">
        <div class="pull-right">
            <?php echo $collection->links(); ?>
        </div>
    </div>
</div>
