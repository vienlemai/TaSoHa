<?php
echo Former::select('category_id')
    ->fromQuery($categories, 'name', 'id');
echo Former::text('title');

?>
<div class="form-group">
    <label for="title" class="control-label col-lg-4 col-sm-4">Hình đại diện</label>
    <div class="col-lg-8 col-sm-8">
        <div class="thumbnail-select" id="elfinder_button" for="#thumbnail">
            <?php if (isset($article)): ?>
                <img src="<?php echo $article->getThumbnailUrl() ?>"/>
            <?php else: ?>
                Click để chọn hình
            <?php endif; ?>
        </div>
        <input name="thumbnail" id="thumbnail" type="hidden" value="<?php echo isset($article) ? $article->thumbnail : null ?>" >
    </div>
</div>
<?php
echo Former::textarea('content')
    ->label(Lang::get('messages.article_content'))
    ->id('ck-editor')

?>