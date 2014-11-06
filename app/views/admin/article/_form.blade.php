<div class="form-group">
    <label for="title" class="control-label col-lg-4 col-sm-4">Chọn danh mục</label>
    <div class="col-lg-8 col-sm-8">
        <select class="form-control" id="select-menu-type" name="category_id">
            <option value="<?php echo ArticleCategory::$CAT_INTRO ?>"><?php echo $categories[ArticleCategory::$CAT_INTRO] ?></option>
            <optgroup label="Tin tức">
                <?php foreach (ArticleCategory::$CAT_NEWS as $value) : ?>
                    <option value="<?php echo $value ?>"><?php echo $categories[$value] ?></option>
                <?php endforeach; ?>
            </optgroup>
            <optgroup label="Tuyển dụng">
                <?php foreach (ArticleCategory::$CAT_RECRUITMENTS as $value): ?>
                    <option value="<?php echo $value ?>"><?php echo $categories[$value] ?></option>
                <?php endforeach; ?>
            </optgroup>
            <option value="<?php echo ArticleCategory::$CAT_PRODUCT ?>"><?php echo $categories[ArticleCategory::$CAT_PRODUCT] ?></option>
            <option value="<?php echo ArticleCategory::$CAT_TRANING ?>"><?php echo $categories[ArticleCategory::$CAT_TRANING] ?></option>
            <option value="<?php echo ArticleCategory::$CAT_EVENT ?>"><?php echo $categories[ArticleCategory::$CAT_EVENT] ?></option>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="thumbnail" class="control-label col-lg-4 col-sm-4">Hình đại diện</label>
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
echo Former::text('title');
echo Former::textarea('content')
    ->label(Lang::get('messages.article_content'))
    ->id('ck-editor');
