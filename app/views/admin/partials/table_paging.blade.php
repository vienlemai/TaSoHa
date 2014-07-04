<div class="table-footer">
    <div class="info-left">
        <?php
        echo trans('messages.paging_info', array(
            'from' => $collection->getFrom(),
            'to' => $collection->getTo(),
            'total' => $collection->getTotal(),
        ));

        ?>
    </div>
    <div class="info-right">
        <?php echo $collection->links(); ?>
    </div>
</div>