<?php

session_start();

use \Openclassrooms\Blog\controller\Controller;

require_once('controller/frontend.php');

$controller = new Controller();

try {

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            $controller->listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller->post();
            }
            else {
                throw new Exception('aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    $controller->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new Exception('tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('aucun identifiant de billet envoyé');
            }
        }
        elseif($_GET['action'] == 'signaler'){
            if (isset($_GET['comment_id']) && $_GET['comment_id'] > 0){
                $controller->reportComment();
            }
            else{
                throw new Exception('pas d\'id de commentaire');
            }
        }
        elseif($_GET['action'] == 'connexionPage'){
            $controller->displayConnexionPage();
        }
        elseif($_GET['action'] == 'adminConnect'){
            if ($_POST['user'] && $_POST['password']) {
                $controller->getConnected();
            }
            else{
                throw new Exception('Veuillez renseigner un identifiant et un mot de passe');
            }
        }


        /* ADMIN PART */


        elseif (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {

            if ($_GET['action'] == 'adminPage') {
                $controller->displayAdminPage();
            }
            elseif ($_GET['action'] == 'commentEditor') {
                if (isset($_GET['comment_id']) && $_GET['comment_id'] > 0) {
                    $controller->displayEditor();
                }
                else{
                    throw new Exception('pas d\'identifiant de commentaire');
                }
            }
            elseif ($_GET['action'] == 'editComment') {
                if (isset($_GET['comment_id']) && $_GET['comment_id'] > 0) {
                    if (!empty($_POST['newComment'])) {
                        $controller->editComment($_POST['newComment']);
                    }
                    else{
                        throw new Exception('aucun nouveau commentaire détecté');
                    }
                }
                else{
                    throw new Exception('aucun identifiant de commentaire envoyé');
                }
            }
            elseif ($_GET['action'] == 'createPost') {
                if (!empty($_POST['titleCreated']) && !empty($_POST['contentCreated'])) {
                    $controller->createPost();
                }
                else{
                    throw new Exception('Veuillez renseigner un titre ainsi qu\'un contenu');
                }
            }
            elseif ($_GET['action'] == 'adminUpdatePage') {
                if (isset($_GET['post_id'])) {
                    $controller->displayPostToUpdate();
                }
                else{
                    throw new Exception('pas d\'identifiant de billet');
                }
            }
            elseif ($_GET['action'] == 'updatePost'){
                if (!empty($_POST['titleUpdated']) && !empty($_POST['contentUpdated'])) {
                    if (isset($_GET['post_id'])) {
                        $controller->updatePost();
                    }
                    else{
                        throw new Exception('pas d\'identifiant de billet');
                    }
                }
                else{
                    throw new Exception('Veuillez renseigner un titre et un contenu');
                }
            }
            elseif ($_GET['action'] == 'deletePost') {
                if (isset($_GET['post_id'])) {
                    $controller->deletePost();
                }
                else{
                    throw new Exception('pas d\'identifiant de billet détecté');
                }
            }
            elseif ($_GET['action'] == 'deconnexion') {
                $_SESSION['isLoggedIn'] = false;
                $controller->listPosts();
            }
            elseif ($_GET['action'] == 'removeReport') {
                if($_GET['comment_id']){
                    $controller->removeReport();
                }
                else{
                    throw new Exception('impossible d\'enlever le report');
                }
            }
            elseif ($_GET['action'] == 'deleteComment') {
                $controller->deleteComment();
            }
        }
        else{
            throw new Exception('Cette page n\'existe pas');
        }
    }
    else{
        $controller->listPosts();
    }
}
catch(Exception $e){
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}