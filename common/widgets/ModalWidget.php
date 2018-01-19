<?php
namespace common\widgets;

use Yii;
use yii\base\Widget;

class ModalWidget extends Widget {

	public $options = [
		'success',
		'error',
		'arcticmodal',
	];

	public function run() {
		$session = Yii::$app->session;
		$message = [];
		$options = $this->options;
		$status = false;
		for ($i=0; count($options) > $i; $i++) {
			if ($session->hasFlash($options[$i])) {
				$message[$options[$i]] = $session->getFlash($options[$i]);
				$status = true;
			}
		}
		if ($status) {
			return $this->render('modal', ['message' => $message]);
		}
	}
}

?>