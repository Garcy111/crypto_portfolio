<?php
    use yii\helpers\Html;

    $controller = $this->context->action->controller->id;
    $route = $this->context->action->uniqueId;
?>
<nav>
<ul class="nav">

	<div class="profile">
		<?php $user = Yii::$app->user->identity; ?>
		<?= Html::img($user->avatar, ['class' => 'profile-avatar']) ?>
		<?= '<h1 class="profile-username">' . $user->username . '</h1>' ?>
		<p class="profile-status"><span class="ind"></span> Online</p>
	</div>

	<li <?php if ($route === 'default/index'): ?> class="click" <?php endif?>>
		<?= Html::a('<i class="fa fa-home" aria-hidden="true"></i> Главная', ['/']); ?>
	</li>

	<li <?php if ($controller === 'coins'): ?> class="click" <?php endif?>>
		<?= Html::a('<i class="fa fa-file-text" aria-hidden="true"></i> Монеты', ['/coins']); ?>
	</li>

	<div class="nav-part">
	<div class="nav-parent">
		<li <?php if ($controller == 'users'): ?> class="click" <?php endif?>>
			<?= Html::a('<i class="fa fa-user"></i> Пользователи <i class="fa fa-angle-right" aria-hidden="true"></i>', ['/users']); ?>
		</li>
	</div>
	<div class="nav-child">
		<li <?php if ($route === 'users/index'): ?> class="click" <?php endif?>>
			<?= Html::a('Все пользователи', ['/users']); ?>
		</li>
		<li <?php if ($route === 'users/create'): ?> class="click" <?php endif?>>
			<?= Html::a('Создать пользователя', ['/users/create']); ?>
		</li>
	</div>
	</div>
</ul>
</nav>