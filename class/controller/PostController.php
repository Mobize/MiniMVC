<?php
class PostController extends BaseController {

	public function indexAction() {
		return $this->listAction();
	}

	public function listAction() {

		$posts = Post::getList('SELECT * FROM post ORDER BY date DESC');

	    if (empty($posts)) {
	        throw new Exception('No post from db');
	    }

	    if (@$_GET['json']) echo json_encode($posts);

	    $this->smarty->assign('posts', $posts);
	    $this->smarty->display('post/list.tpl');
	}

	public function randomAction() {

		$post = Post::get('SELECT * FROM post ORDER BY RAND() LIMIT 1');

	    if (empty($post)) {
	        throw new Exception('No post from db');
	    }

	    if (@$_GET['json']) echo json_encode($post);

	    $this->smarty->assign('post', $post);
	    $this->smarty->display('post/view.tpl');
	}

	public function viewAction($param) {

		$id = (int) $param;

		if (empty($id)) {
	        throw new Exception('Undefined post id');
	    }

	    $post = Post::getById($id);

	    if (empty($post)) {
	        throw new Exception('Undefined post for id = ['.$id.']');
	    }

	    if (@$_GET['json']) echo json_encode($post);

	    $this->smarty->assign('post', $post);
	    $this->smarty->display('post/view.tpl');
	}

	public function searchAction($param) {

		$search = array('q' => $param);

		$search_results = Post::search($search);

		$posts = $search_results->results;

		if (@$_GET['json']) echo json_encode($search_results);

		$this->smarty->assign('search', htmlspecialchars($param));
		$this->smarty->assign('posts', $posts);
	    $this->smarty->display('post/list.tpl');
	}
}