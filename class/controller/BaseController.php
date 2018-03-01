<?php
class BaseController {

	protected $smarty;

	public function __construct() {
		$this->smarty = new Smarty();
		$this->smarty->setTemplateDir(VIEWS_PATH);
		$this->smarty->assign('ROOT_PATH', ROOT_HTTP);
	}

}