<?php

namespace app\models;

class CommentModel extends Model
{
    /**
     * @return false|\PDOStatement
     */
    public function getAll()
    {
        $sql = 'SELECT * FROM comments WHERE hide = :hide';
        $select = $this->db->prepare($sql);
        /** TODO: Hide to Const! */
        $select->execute([':hide' => 0]);
        return $select->fetchAll();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getOne(int $id)
    {
        $sql = 'SELECT * FROM comments WHERE id = :id AND hide = :hide';
        $select = $this->db->prepare($sql);
        /** TODO: Hide to Const! */
        $select->execute([':id' => $id, ':hide' => 0]);
        return $select->fetch();
    }

    /**
     * @return array
     */
    public function getShowComments(): array
    {
        $comments = [];

        foreach ($this->getAll() as $row) {
            $row['comments'] = [];
            $comments[$row['id']] = $row;
        }

        foreach ($comments as $key => &$comment) {
            if (!empty($comment['parentId'])) {
                $comments[$comment['parentId']]['comments'][] =& $comment;
            }
        }
        unset($comment);

        foreach ($comments as $key => $comment) {
            if (!empty($comment['parentId'])) {
                unset($comments[$key]);
            }
        }

        return $comments;
    }

    /**
     * @param string $text
     * @param string $authorId
     * @param string $authorName
     * @param int $parentId
     * @return bool
     */
    public function add(string $text, string $authorId, string $authorName, $parentId = 0)
    {
        try {
            /** TODO: SQL */
            $sql = 'INSERT INTO comments SET parentId = :parentId, comment_text = :comment_text, authorId = :authorId, author_name = :author_name';
            $insert = $this->db->prepare($sql);
            $insert->execute([':parentId' => $parentId, ':comment_text' => $text, ':authorId' => $authorId, ':author_name' => $authorName]);
            /** TODO: SQL Error Report */
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }

        return $this->db->lastInsertId();
    }

    public function delete(int $id)
    {
        try {
            /** TODO: SQL */
            $sql = 'UPDATE comments SET hide = :hide WHERE id = :id';
            $update = $this->db->prepare($sql);
            /** TODO: Hide to Const! */
            $update->execute([':id' => $id, ':hide' => 1]);
            /** TODO: SQL Error Report */
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}