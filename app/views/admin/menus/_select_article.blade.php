<table class="table table-bordered">
    <thead>
        <tr>
            <th style="width: 5%">#</th>
            <th><?php echo trans('messages.article_title'); ?></th>
            <th><?php echo trans('messages.article_category'); ?></th>
            <th><?php echo trans('messages.created_at'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><input class="menu-check-item" type="checkbox" value="<?php echo $row['Post']['id'] ?>"/></td>
                <td class="select-name">
                    <?php echo $article->title ?>
                </td>
                <td>{{$article->category->name or ''}}</td>
                <td><?php echo $article->created_at->format('d/m/Y, H:i') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>