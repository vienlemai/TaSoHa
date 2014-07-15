@section('header_content')
<h1>
    <?php echo trans('menu.manage_articles'); ?>
    <small><?php echo trans('menu.list_articles'); ?></small>
</h1>
<ol class="breadcrumb">
    <li><a href="<?php echo route('admin.root') ?>"><i class="fa fa-dashboard"></i> <?php echo trans('messages.dashboard'); ?></a></li>
    <li class="active"><?php echo trans('menu.list_articles'); ?></li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="table-wrap">
            <div class="table-header">
                <a href="{{route('admin.articles.create')}}" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> <?php echo trans('messages.add_article'); ?>
                </a>
                <div class="col-md-4 pull-right no-padding">
                    <?php echo View::make('admin.partials.search_tool')->render(); ?>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 5%">#</th>
                        <th><?php echo trans('messages.article_title'); ?></th>
                        <th><?php echo trans('messages.article_category'); ?></th>
                        <th><?php echo trans('messages.created_at'); ?></th>
                        <th style="width: 15%"><?php echo trans('messages.actions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $index = $articles->getFrom(); ?>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td><?php echo $index++ ?></td>
                            <td>
                                <a href="<?php echo route('admin.articles.edit', $article->id) ?>">
                                    <?php echo $article->title ?>
                                </a>

                            </td>
                            <td>{{$article->category->name or ''}}</td>
                            <td><?php echo $article->created_at->format('d/m/Y, H:i') ?></td>
                            <td>
                                <a href="<?php echo route('admin.articles.edit', $article->id) ?>">
                                    <i class="fa fa-edit"> <?php echo trans('button.edit'); ?></i>
                                </a>
                                <?php
                                $deleteUrl = route('admin.articles.destroy', $article->id);
                                $confirmMsg = trans('confirmation.delete_article', array('title' => $article->title));
                                ?>
                                <a href="<?php echo $deleteUrl ?>" class="text-danger" data-method="delete" data-confirm="<?php echo $confirmMsg ?>">
                                    <i class="fa fa-times"> <?php echo trans('button.delete'); ?></i>
                                </a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="table-footer">
                <div class="info-left">
                    <?php
                    echo trans('messages.paging_info', array(
                        'from' => $articles->getFrom(),
                        'to' => $articles->getTo(),
                        'total' => $articles->getTotal(),
                    ));
                    ?>
                </div>
                <div class="info-right">
                    <?php echo $articles->links(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
@stop