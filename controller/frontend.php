<?php

use \Openclassrooms\Blog\Model\PostManager;
use \Openclassrooms\Blog\Model\CommentManager;
use \Openclassrooms\Blog\Model\AdminManager;

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/AdminManager.php');

function listPosts(){

    $postManager = new PostManager();
	$posts = $postManager->getPosts();

	require('view/frontend/listPostsView.php');
}

function post(){

    $postManager = new PostManager();
    $commentManager = new CommentManager();

	$post = $postManager->getPost($_GET['id']);
	$comments = $commentManager->getComments($_GET['id']);

	require('view/frontend/postView.php');

}

function addComment($postId, $author, $comment){

    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }

}

function displayEditor(){
    $commentManager = new CommentManager();

    $old_comment = $commentManager->displayCommentEditor($_GET['comment_id']);

    require('view/frontend/modifyCommentView.php');
}

function editComment($newComment)
{
    $commentManager = new CommentManager();

    $affectedComments = $commentManager->modifyComment($newComment, $_GET['comment_id']);

    header('Location: index.php?action=listPosts');
}

function reportComment(){
    $commentManager = new CommentManager();

    $reportedComment = $commentManager->reportComment($_GET['comment_id']);

    header('Location: index.php?action=listPosts');
}

function displayConnexionPage(){
    $adminManager = new AdminManager();
    $adminManager->getConnexionPage();

    require('view/backend/connexionAdminView.php');
}

function getConnected(){
    $adminManager = new AdminManager();

    $user = $adminManager->getConnected();

    if($_POST['user'] == $user['user'] && password_verify($_POST['password'], '$2y$10$/HyKYr1NmWM5KS5NTFoLROsGlL8sdMxqFrXvJBIxbq9wd8OCpq2nm')){
        $_SESSION['isLoggedIn'] = true;
        header('Location: index.php?action=adminPage');
    }
    else{
        throw new Exception('Mauvais identifiants !');
    }
}

function displayAdminPage(){

    $postManager = new PostManager();
    $commentManager = new CommentManager();   
    $posts = $postManager->getPosts();
    $AllComments = $commentManager->getAllComments();

    require('view/backend/adminView.php');
}

function createPost(){
    $adminManager = new AdminManager();
    $createdPost = $adminManager->createPost($_POST['titleCreated'], $_POST['contentCreated']);

    header('Location: index.php?action=listPosts');
}

function displayPostToUpdate(){
    $adminManager = new AdminManager();
    $displayPostToUpdate = $adminManager->getPost($_GET['post_id']);

    require('view/backend/adminUpdateView.php');
}

function updatePost(){
    $adminManager = new AdminManager();
    $updatePost = $adminManager->updatePost($_POST['titleUpdated'], $_POST['contentUpdated'], $_GET['post_id']);

    header('Location: index.php?action=listPosts');
}

function deletePost(){
    $adminManager = new AdminManager();
    $deletePost = $adminManager->deletePost($_GET['post_id']);

    header('Location: index.php?action=listPosts');
}