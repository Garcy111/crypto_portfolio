<?php

/* @var $user app\modules\user\models\User */
use yii\helpers\Html;


echo 'Привет '.Html::encode($user->username).'.<br/>';

echo Html::a('Для активации своего аккаунта перейдите по этой ссылке.',
	Yii::$app->urlManager->createAbsoluteUrl(
		[
			'/user/default/activation',
			'id' => $user->id,
			'hash' => $user->activation
		]
	));