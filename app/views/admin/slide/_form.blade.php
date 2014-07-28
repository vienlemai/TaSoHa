<div class="form-group">
    <label for="title" class="control-label col-lg-3 col-sm-3">Chọn ảnh</label>
    <div class="col-lg-9 col-sm-9">
        <div class="slide-select" id="elfinder_button" for="#thumbnail">
            <?php if (isset($slide)): ?>
                <img src="<?php echo $slide->getThumbnailUrl() ?>"/>
            <?php else: ?>
                <div class="thumbnail-select"> Click để chọn hình</div>
            <?php endif; ?>
        </div>
        <input name="url" id="thumbnail" type="hidden" value="<?php echo isset($slide) ? $slide->url : null ?>">
    </div>
</div>
<?php
echo Former::textarea('description')
    ->rows(5);

?>