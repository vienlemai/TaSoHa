<?php
echo Former::select('product_category_id')
    ->options($categories)
    ->class('form-control');
echo Former::text('name')
    ->class('form-control');
echo Former::text('code')
    ->class('form-control');

?>
<div class="form-group">
    <label for="title" class="control-label col-lg-3 col-sm-3">Hình đại diện</label>
    <div class="col-lg-9 col-sm-9">
        <div class="thumbnail-select" id="elfinder_button" for="#thumbnail">
            <?php if (isset($product)): ?>
                <img src="<?php echo $product->getThumbnailUrl() ?>"/>
            <?php else: ?>
                Click để chọn hình
            <?php endif; ?>
        </div>
        <input name="thumbnail" id="thumbnail" type="hidden" value="<?php echo isset($product) ? $product->thumbnail : null ?>">
    </div>
</div>
<?php
echo Former::textarea('description')
    ->id('ck-editor')

?>
