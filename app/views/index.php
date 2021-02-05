<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<!------ Include the above in your HEAD tag ---------->

<link href="/web/css/main.css" rel="stylesheet" id="bootstrap-css">
<script src="/web/js/main.js"></script>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Comments Test</a>
        </div>
    </div><!-- /.container-fluid -->
</nav>

<div class="container mb-4">
    <div class="row mb-4">
        <div class="col-8">
            <p>This is the reference image I used for this demonstration, a photo I took of the
                Bombay Gin Distillery near Basingstoke.</p>

            <p>As you can see this is a complex reference image that contains perspective and buildings of different
                sizes, plus reflections, etc. Getting a good representation of this reference image is important and the
                process below should you with that.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <p>Having loaded in your photo reference image
                Select Menu Filters – Edge Detect – Edge and that will produce this effect</p>
        </div>
    </div>
</div>

<div class="container">
    <div class="post-comments">
        <form>
            <div class="form-group">
                <label for="comment">Автор</label>
                <input type="text" name="author_name" value=""/>
            </div>
            <div class="form-group">
                <label for="comment">Комментарий</label>
                <textarea name="comment" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-default send">Отправить</button>
        </form>
        <div class="row" id="comments">
            <?php foreach($comments as $comment): ?>
                <?php if (isset($comment['id'])) : ?>
                    <?php echo $view->render('comment', ['view' => $view, 'userSid' => $userSid, 'comment' => $comment, 'level' => 0]) ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>