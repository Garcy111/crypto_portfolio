<?php

/* @var $user app\modules\user\models\User */
use yii\helpers\Html;


echo 'Привет '.Html::encode($user->username).'.<br/>';

echo '<h2>Мы получили запрос на изменение пароля вашей учетной записи.</h2>';
echo '<p>Если вы отправляли запрос на изменение пароля для учетной записи ' . $user->username . ', нажмите на эту ' . Html::a('ссылку', Yii::$app->urlManager->createAbsoluteUrl(['/user/default/recovery', 'id' => $user->id, 'pass' => $user->recovery])) . '. Если вы не отправляли этого запроса, игнорируйте данное сообщение электронной почты.</p>';