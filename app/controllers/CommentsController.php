<?php

namespace app\controllers;

use app\models\CommentModel;
use DateInterval;
use DateTime;

class CommentsController extends Controller
{
    /**
     * @return false|string
     */
    public function add()
    {
        $view = $this->registry->get('view');

        $commentText = $_POST['comment'] ?? 'No Text';
        $commentAuthorName = $_POST['author_name'] ?? '';
        $parentId = $_POST['parentId'] ?? 0;

        $commentModel = new CommentModel($this->registry->get('db'));
        $commentId = $commentModel->add($commentText, session_id(), $commentAuthorName, $parentId);
        $comment = $commentModel->getOne($commentId);

        /** TODO: HTML to JS Render */
        return json_encode(['commentId', $commentId, 'comment' => $comment, 'html' => $view->render('comment', ['userSid' => session_id(), 'comment' => $comment])]);
    }

    /**
     * @return false|string
     * @throws \Exception
     */
    public function delete()
    {
        $id = $_POST['id'] ?? 0;

        $commentModel = new CommentModel($this->registry->get('db'));
        $comment = $commentModel->getOne((int) $id);

        /** TODO: Дубль Кода! */
        $dateComment = new DateTime($comment['date']);
        $dateComment->add(new DateInterval('PT1H'));
        $thisDate = new DateTime();

        if (session_id() === $comment['authorId']) {
            if ($thisDate < $dateComment) {
                $commentModel->delete((int) $id);
                return json_encode(['status' => true]);
            }
        }

        return json_encode(['status' => false]);
    }
}