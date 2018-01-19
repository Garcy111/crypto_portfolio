<?php

namespace common\widgets;

use frontend\modules\blog\models\Tags;
use Yii;
use yii\base\Widget;

class TagsWidget extends Widget {

	public function run() {
		$tags = Tags::find()->all();
		return $this->render('tags', ['tags' => $tags]);
	}
}

?>