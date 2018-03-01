<?php
class Post extends Model {

	public $id;
	public $type;
	public $author;
	public $title;
	public $content;
	public $picture;
	public $date;

	const POST_TYPE_DEFAULT = 1;
	const POST_TYPE_LINK = 2;
	const POST_TYPE_LOCATION = 3;

	public static $type_labels = array(
		self::POST_TYPE_DEFAULT => 'article',
		self::POST_TYPE_LINK => 'lien',
		self::POST_TYPE_LOCATION => ''
	);

	/* Setters */
	public function setId($id) {
		if (!is_numeric($id) || $id < 0) {
			throw new Exception('Post id must be a number > 0');
		}
		$this->id = $id;
	}
	public function setType($type) {
		if (!is_numeric($type) || $type < 0 || $type > 99) {
			throw new Exception('Post type must be a number between 0 and 99');
		}
		$this->type = $type;
	}
	public function setAuthor($author) {
		if (empty($author) || !is_string($author) || strlen($author) > 100) {
			throw new Exception('Post author must be a string and 100 chars max');
		}
		$this->author = $author;
	}
	public function setTitle($title) {
		if (empty($title) || !is_string($title) || strlen($title) > 100) {
			throw new Exception('Post title must be a string and 100 chars max');
		}
		$this->title = $title;
	}
	public function setContent($content) {
		if (!is_string($content) && strlen($content) >  65536) {
			throw new Exception('Post content must be a string and 65536 chars max');
		}
		$this->content = $content;
	}
	public function setPicture($picture) {
		if (strlen($picture) > 100) {
			throw new Exception('Post picture must be a string and 100 chars max');
		}
		$this->picture = $picture;
	}
	public function setDate($date) {
		if (strtotime($date) === false) {
			throw new Exception('Post date format must be Y-m-d H:i:s');
		}
		$this->date = $date;
	}

	/* Getters */
	public function getId() {
		return $this->id;
	}
	public function getType() {
		return $this->type;
	}
	public function getAuthor() {
		return ucfirst($this->author);
	}
	public function getTitle() {
		return ucfirst($this->title);
	}
	public function getContent($max_length = 0, $end = '...') {
		return nl2br(Utils::cutString($this->content, $max_length, $end));
	}
	public function getPicture($default = '') {
		$picture = $default ?: IMG_HTTP.'post/article.png';
		if (!empty($this->picture)) {
			$path = 'post/'.$this->picture;
			if (file_exists(IMG_PATH.$path)) {
				return IMG_HTTP.$path;
			}
		}
		return $picture;
	}
	public function getDate($format = 'Y-m-d H:i:s') {
		return date($format, strtotime($this->date));
	}

	public function getLink() {
		//return ROOT_HTTP.'post/'.$this->getId().'-'.Utils::slugify($this->getTitle());
		return ROOT_HTTP.'post.php?id='.$this->getId();
	}

	/* Display */
	public static function getTypeLabel($type) {
		if (isset(self::$type_labels[$type])) {
			return self::$type_labels[$type];
		}
		return 'article';
	}

	/* Search */
	public static function search($input) {

		$entity = self::getClass();

		if (empty($input)) {
			return new Search($entity);
		}

		$quick_search = !empty($input['q']) ? $input['q'] : '';

		$search_filters = array();
		if (!empty($quick_search)) {
			$separator = 'OR';
			$search_filters = array(
				'author' => '%'.$quick_search.'%',
				'title' => '%'.$quick_search.'%',
				'content' => '%'.$quick_search.'%'
			);
		} else {
			$separator = 'AND';
			foreach($input as $key => $value) {
				if (!empty($value) && property_exists($entity, $key)) {
					$search_filters[$key] = (is_numeric($value) ? $value : '%'.$value.'%');
				}
			}
		}

		return new Search($entity, $input, $search_filters, $separator);
	}

}