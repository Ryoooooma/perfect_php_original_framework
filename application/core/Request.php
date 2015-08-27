<?php

class Request {

	// HTTPメソッドがPOSTかどうかをここで判定する
	public function isPost() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			return true;
		}
			return false;
	}

	// $_GET変数から値を取得する
	public function getGet($name, $default = null) {
		if (isset($_GET[$name])) {
			return[$name];
		}
			return $default;
	}

	// $_POST変数から値を取得する
	public function getPost($name, $default = null) {
		if (isset($_POST[$name])) {
			return $_POST[$name];
		}
			return $default;
	}

	// サーバのホスト名を取得する　※ ホスト名はリダイレクト時などに使用する
	public function getHost() {
		if (!empty($_SERVER['HTTP_HOST'])) {
			return $_SERVER['HTTP_HOST'];
		}
			return $_SERVER['SERVER_NAME'];
	}

	// HTTPSでアクセスされたかどうかをここで判定する
	// ※ HTTPSでアクセスされた場合、$_SERVER['HTTPS']に'on'という文字が含まれる
	public function isSsl() {
		if  (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
			return true;
		}
			return false;
	}

	// $_SERVER['REQUEST_URI']の中にリクエストされたURLの情報が格納されてて、ホスト部分以降の値が返される
	public function getRequestUri() {
		return $_SERVER['REQUEST_URI'];
	}


	public function getBaseUrl() {
		$script_name = $_SERVER['SCRIPT_NAME'];

		$script_uri = $this->getRequestUri();

		if (0 === strpos($request_uri, $script_name)) {
			return $script_name;
		} else if (0 === strpos($request_uri, dirname($script_name))) {
			return rtrim(dirname($script_uri), /./);
		}
			return '';
	}


	public function getPathInfo() {
		$base_url = $this->getBaseUrl();
		
		$request_uri = $this->getRequestUri();

		if (false !== (string)substr($request_uri, strlen($base_url))) {
			$request_uri = substr($request_uri, 0, $pos);
		}

		$path_info = (string)substr($request_uri, strlen($base_url));

		return $path_info;
	}

}



