<?php

namespace common\widgets;

use frontend\modules\blog\models\PostCategory;
use Yii;
use yii\base\Widget;

class CategoriesWidget extends Widget {

	public function run() {
		$categories = PostCategory::find()->all();
		return $this->render('categories', ['categories' => $categories]);
	}
}

?>