<?php

namespace backend\controllers;

use backend\controllers\BehaviorsController;
use backend\models\ImageManager; // ActiveRecord Object
use backend\models\SimpleImage; // Resizing images class
use backend\models\FileUpload; // Uploader handler class
use Yii;

class UploaderController extends BehaviorsController {

	public $enableCsrfValidation = false;

	public function actionDelete()
    {
    	$name = Yii::$app->request->post('img');
    	$model = new ImageManager();
    	$model->delImage($name);
    }

    public function actionUpload()
    {
    	$dir = Yii::$app->urlManagerUploads->baseUrl . '/';
		$valid_extensions = ['gif', 'png', 'jpeg', 'jpg'];

		$Upload = new FileUpload();
		$result = $Upload->handleUpload($dir, $valid_extensions);

		if (!$result) {
		    echo json_encode(['success' => false, 'msg' => $Upload->getErrorMsg()]);   
		} else {

			// Resize uploaded image
			$image = new SimpleImage();
			$dir_resize = $dir . '/min/';
			$image->load($dir . $Upload->newFileName);
			$image->resize(200, 200);
			$image->save($dir_resize . $Upload->newFileName);

			// Save image in db
			$file = $dir . $Upload->newFileName;
			if (file_exists($file)) {
				$model = new ImageManager();
				$model->name = $Upload->newFileName;
				$model->save(false);
			}

		    echo json_encode(['success' => true, 'file' => $Upload->getFileName()]);
		}
    }
}