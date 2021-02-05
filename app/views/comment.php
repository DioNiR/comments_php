<?php

/** @var $comment */
/** @var $userSid */
$level = $level ?? 0;
$no_level = $no_level ?? false;
$level++;

/** TODO: По хорошему такое надо в модельку */
$dateComment = new DateTime($comment['date']);
$dateComment->add(new DateInterval('PT1H'));
$thisDate = new DateTime();

$showDelete = false;
if ($userSid === $comment['authorId']) {
    if ($thisDate < $dateComment) {
        $showDelete = true;
    }
}
?>
<div class="media" id="comment_<?php echo $comment['id']; ?>">
    <div class="media-heading">
        <button class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse"
                data-target="#collapse<?php echo $comment['id']; ?>" aria-expanded="false" aria-controls="collapseExample"><span
                    class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
        <span class="label label-info"><?php echo $comment['author_name']; ?></span> <?php echo $comment['date']; ?>
    </div>
    <div class="panel-collapse collapse in" id="collapse<?php echo $comment['id']; ?>">

        <div class="media-left">
            <div class="vote up">
                <i class="glyphicon glyphicon-menu-up"></i>
            </div>
            <div class="vote inactive">
                <i class="glyphicon glyphicon-menu-down"></i>
            </div>
        </div>

        <div class="media-body">
            <p><?php echo $comment['comment_text']; ?></p>
            <div class="comment-meta">
                <?php if (true === $showDelete): ?>
                <span><a href="#" class="delete_comment" data-id="<?php echo $comment['id']; ?>">Удалить</a></span>
                <?php endif; ?>
                <span>
                    <a class="" role="button" data-toggle="collapse" href="#replyComment_<?php echo $comment['id']; ?>" aria-expanded="false"
                       aria-controls="collapseExample">Ответить</a>
                  </span>
                <div class="collapse" id="replyComment_<?php echo $comment['id']; ?>">
                    <form>
                        <input type="hidden" name="parentId" value="<?php echo $comment['id']; ?>"/>
                        <div class="form-group">
                            <label for="comment">Автор</label>
                            <input type="text" name="author_name" value=""/>
                        </div>
                        <div class="form-group">
                            <label for="comment">Комментарий</label>
                            <textarea name="comment" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="comments" id="comments_<?php echo $comment['id']; ?>">
            <?php if (isset($comment['comments']) && count($comment['comments']) > 0): ?>
                <?php if (false == $no_level && $level < 3): ?>
                    <?php /** TODO: Дубль кода! */ ?>
                    <?php foreach ($comment['comments'] as $comment): ?>
                        <?php echo $view->render('comment', ['view' => $view, 'userSid' => $userSid, 'comment' => $comment, 'level' => $level]) ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <?php if (false == $no_level): ?>
                        <div><a class="show_comments" data-id="<?php echo $comment['id']; ?>">Показать комментарии</a></div>
                    <?php endif; ?>
                    <div class="hide_comments">
                        <?php /** TODO: Дубль кода! */ ?>
                        <?php foreach ($comment['comments'] as $comment): ?>
                            <?php echo $view->render('comment', ['view' => $view, 'userSid' => $userSid, 'comment' => $comment, 'no_level' => true]) ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>