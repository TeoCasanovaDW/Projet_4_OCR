<?php

namespace Openclassrooms\Blog\Model;

require_once('model/Manager.php');

class AdminManager extends PostManager
{

	public function getConnexionPage(){
		$db = $this->dbConnect();
		$user = $db->query('SELECT * FROM `admin` WHERE id= 1');

		return $user;
	}

	public function getConnected(){
		$db = $this->dbConnect();
		$userConnect = $db->query('SELECT user, password FROM `admin` WHERE id= 1');
		$userConnected = $userConnect->fetch();

		return $userConnected;
	}

	public function createPost($title, $content){
		$db = $this->dbConnect();
		$post = $db->prepare('INSERT INTO `posts`(`title`, `content`, `creation_date`) VALUES (?, ?, NOW())');
		$createdPost = $post->execute(array($title, $content));

		return $createdPost;
	}

	public function updatePost($title, $content, $post_id){
		$db = $this->dbConnect();
		$post = $db->prepare('UPDATE `posts` SET `title`=?, `content`=?, `creation_date`=NOW() WHERE id=?');
		$updatePost = $post->execute(array($title, $content, $post_id));

		return $updatePost;
	}

	public function deletePost($post_id){
		$db = $this->dbConnect();
		$post = $db->prepare('DELETE FROM `posts` WHERE id= ?');
		$deletedPost = $post->execute(array($post_id));

		return $deletedPost;
	}

}