<?php

session_start();

require('controller/frontend.php');

try {

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception('aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
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
                reportComment();
            }
            else{
                throw new Exception('pas d\'id de commentaire');
            }
        }
        elseif($_GET['action'] == 'connexionPage'){
            displayConnexionPage();
        }
        elseif($_GET['action'] == 'adminConnect'){
            getConnected();
        }


        /* ADMIN PART */


        elseif ($_SESSION['isLoggedIn'] == true) {

            if ($_GET['action'] == 'adminPage') {
                displayAdminPage();
            }
            elseif ($_GET['action'] == 'commentEditor') {
                if (isset($_GET['comment_id']) && $_GET['comment_id'] > 0) {
                    displayEditor();
                }
                else{
                    throw new Exception('pas d\'identifiant de commentaire');
                }
            }
            elseif ($_GET['action'] == 'editComment') {
                if (isset($_GET['comment_id']) && $_GET['comment_id'] > 0) {
                    if (!empty($_POST['newComment'])) {
                        editComment($_POST['newComment']);
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
                    createPost();
                }
                else{
                    throw new Exception('Veuillez renseigner un titre ainsi qu\'un contenu');
                }
            }
            elseif ($_GET['action'] == 'adminUpdatePage') {
                if (isset($_GET['post_id'])) {
                    displayPostToUpdate();
                }
                else{
                    throw new Exception('pas d\'identifiant de billet');
                }
            }
            elseif ($_GET['action'] == 'updatePost'){
                if (!empty($_POST['titleUpdated']) && !empty($_POST['contentUpdated'])) {
                    if (isset($_GET['post_id'])) {
                        updatePost();
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
                    deletePost();
                }
                else{
                    throw new Exception('pas d\'identifiant de billet détecté');
                }
            }
            elseif ($_GET['action'] == 'deconnexion') {
                $_SESSION['isLoggedIn'] = false;
                listPosts();
            }
        }
        else{
            throw new Exception('Vous devez être administrateur pour accéder ici');
        }
    }
    else {
        $_SESSION['isLoggedIn'] = false;
        listPosts();
    }
}
catch(Exception $e){
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}