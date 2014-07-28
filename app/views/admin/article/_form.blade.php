<?php
echo Former::select('category_id')
    ->label(trans('model.Article.category_id'))
    ->fromQuery($categories, 'name', 'id')
    ->class('form-control');
echo Former::text('title')
    ->label(trans('model.Article.title'))
    ->class('form-control');

?>
<div class="form-group">
    <label for="title" class="control-label col-lg-3 col-sm-3">Hình đại diện</label>
    <div class="col-lg-9 col-sm-9">
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