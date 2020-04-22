<?php

namespace Openclassrooms\Blog\Model;

require_once('model/Manager.php');

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function getAllComments(){
        $db = $this->dbConnect();
        $AllComments = $db->query('SELECT id, post_id, author, comment, report, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments ORDER BY post_id DESC');

        return $AllComments;
    }

    public function deleteComment($comment_id){
        $db = $this->dbConnect();
        $comment = $db->prepare('DELETE FROM `comments` WHERE id=?');
        $deleteComment = $comment->execute(array($comment_id));

        return $deleteComment;
    }

    public function removeReport($comment_id){
        $db = $this->dbConnect();
        $comment = $db->prepare('UPDATE `comments` SET `report`= 0 WHERE id= ?');
        $removeReport = $comment->execute(array($comment_id));

        return $removeReport;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function displayCommentEditor($comment_id){
        $db = $this->dbConnect();
        $comment = $db->prepare('SELECT comment FROM comments WHERE id = ?');
        $comment->execute(array($comment_id));
        $old_comment = $comment->fetch();

        return $old_comment;
    }

    public function modifyComment($newComment, $comment_id)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE `comments` SET `comment`= ?,`comment_date`=NOW() WHERE id= ?');
        $affectedComments = $comments->execute(array($newComment, $comment_id));

        return $affectedComments;
    }

    public function reportComment($comment_id){
        $db = $this->dbConnect();
        $comment = $db->prepare('UPDATE `comments` SET `report`= report+1 WHERE id= ?');
        $reportedComment = $comment->execute(array($comment_id));

        return $reportedComment;
    }
}