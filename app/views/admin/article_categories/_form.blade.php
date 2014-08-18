<?php
echo Former::text('name')
    ->label(Lang::get('messages.category_name'))
    ->class('form-control');

?>
<div class="form-group">
    <label for="title" class="control-label col-lg-4 col-sm-4">Hình đại diện</label>
    <div class="col-lg-8 col-sm-8">
        <div class="thumbnail-select" id="elfinder_button" for="#thumbnail">
            <?php if (isset($category)): ?>
                <img src="<?php echo $category->getThumbnailUrl() ?>"/>
            <?php else: ?>
                Click để chọn hình
            <?php endif; ?>
        </div>
        <input name="thumbnail" id="thumbnail" type="hidden" value="<?php echo isset($category) ? $category->photo : null ?>">
    </div>
</div>
<?php
echo Former::textarea('description')->rows(5)
    ->label(trans('model.ArticleCategory.description'))
    ->class('form-control');

?>