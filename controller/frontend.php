<?php

namespace Openclassrooms\Blog\Controller;

use \Openclassrooms\Blog\Model\PostManager;
use \Openclassrooms\Blog\Model\CommentManager;
use \Openclassrooms\Blog\Model\AdminManager;

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/AdminManager.php');

class Controller
{

    public function listPosts(){

        $postManager = new PostManager();
    	$posts = $postManager->getPosts();

    	require('view/frontend/listPostsView.php');
    }

    public function post(){

        $postManager = new PostManager();
        $commentManager = new CommentManager();

    	$post = $postManager->getPost($_GET['id']);

        if($post){
        	$comments = $commentManager->getComments($_GET['id']);
        	require('view/frontend/postView.php');
        }
        else{
            echo ('le post n\'existe pas !');
        }
    }

    public function addComment($postId, $author, $comment){

        $commentManager = new CommentManager();

        $affectedLines = $commentManager->postComment($postId, $author, $comment);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $postId);
        }

    }

    public function displayEditor(){
        $commentManager = new CommentManager();

        $old_comment = $commentManager->displayCommentEditor($_GET['comment_id']);

        require('view/backend/modifyCommentView.php');
    }

    public function editComment($newComment)
    {
        $commentManager = new CommentManager();

        $affectedComments = $commentManager->modifyComment($newComment, $_GET['comment_id']);

        header('Location: index.php?action=listPosts');
    }

    public function reportComment(){
        $commentManager = new CommentManager();

        $reportedComment = $commentManager->reportComment($_GET['comment_id']);

        header('Location: index.php?action=listPosts');
    }

    public function displayConnexionPage(){
        $adminManager = new AdminManager();
        $adminManager->getConnexionPage();

        require('view/backend/connexionAdminView.php');
    }

    public function getConnected(){
        $adminManager = new AdminManager();

        $user = $adminManager->getConnected();

        if($_POST['user'] == $user['user'] && password_verify($_POST['password'], $user['password'])){
            $_SESSION['isLoggedIn'] = true;
            header('Location: index.php?action=adminPage');
        }
        else{
            throw new Exception('Mauvais identifiants !');
        }
    }

    public function displayAdminPage(){

        $postManager = new PostManager();
        $commentManager = new CommentManager();   
        $posts = $postManager->getPosts();
        $AllComments = $commentManager->getAllComments();

        require('view/backend/adminView.php');
    }

    public function createPost(){
        $adminManager = new AdminManager();
        $createdPost = $adminManager->createPost($_POST['titleCreated'], $_POST['contentCreated']);

        header('Location: index.php?action=listPosts');
    }

    public function displayPostToUpdate(){
        $adminManager = new AdminManager();
        $displayPostToUpdate = $adminManager->getPost($_GET['post_id']);

        require('view/backend/adminUpdateView.php');
    }

    public function updatePost(){
        $adminManager = new AdminManager();
        $updatePost = $adminManager->updatePost($_POST['titleUpdated'], $_POST['contentUpdated'], $_GET['post_id']);

        header('Location: index.php?action=listPosts');
    }

    public function deletePost(){
        $adminManager = new AdminManager();
        $deletePost = $adminManager->deletePost($_GET['post_id']);

        header('Location: index.php?action=listPosts');
    }

}