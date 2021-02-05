<?php


namespace app\controllers;


use app\models\CommentModel;

class IndexController extends Controller
{
    public function index()
    {
        $commentModel = new CommentModel($this->registry->get('db'));

        $view = $this->registry->get('view');
        echo $view->render('index', ['view' => $view, 'userSid' => session_id(), 'comments' => $commentModel->getShowComments()]);
    }
}