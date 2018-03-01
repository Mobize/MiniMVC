<?php
class DefaultController {

	public function indexAction() {
		//echo '<h1>Hello world</h1>';
		header('Location: '.ROOT_HTTP.'post/');
	}
}