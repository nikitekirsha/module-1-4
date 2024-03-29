<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/models/UserModel.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/models/AppModel.php';

	$userModel = new UserModel();
	$appModel = new AppModel();

	if (!$userModel->isLogged()) return $userModel->redirect('index.php');
	if ($userModel->isAdmin()) return $userModel->redirect('admin.php');	

	$status = $_GET['status'] ?? '';

	if (empty($status)) {
		$apps = $userModel->getApps();
	} else {
		$apps = $userModel->getAppsWithStatus($status);
	}

	$appsNotNull = !empty($apps);
?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/main.css">
	<title>Городской портал - <?= $userModel->get('name'); ?></title>
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="header__content">
				<a href="index.php" class="logo">
					<img class="logo__img" src="logo/logo.png" alt="">
				</a>
				<div class="header__inline">
					<a href="appAdd.php" class="btn">Создать заявку</a>
					<a href="actions/logout.php" class="btn btn_outline">Выйти</a>
				</div>
			</div>
		</div>
	</header>
	<main class="main">
		<!-- профиль -->
		<section class="section">
			<div class="container">
				<div class="section__heading">
					<h1 class="section__title">Добро пожаловать, <?= $userModel->get('name'); ?>. Вот ваши заявки:</h1>
				</div>
				<div class="section__content">
					<!-- фильтр -->
					<div class="space-b">
						<form class="form-inline">
							<select class="input" name="status">
								<option value="">Все</option>
								<option <?= $status == 'Новая' ? 'selected' : '' ?> value="Новая">Новая</option>
								<option <?= $status == 'Решена' ? 'selected' : '' ?> value="Решена">Решена</option>
								<option <?= $status == 'Отклонена' ? 'selected' : '' ?> value="Отклонена">Отклонена</option>
							</select>
							<button class="btn">Показать</button>
						</form>
					</div>
					<!-- заявки пользователя -->
					<?php if ($appsNotNull): ?>
						<div class="table">
							<table>
								<tbody>
									<tr>
										<th>Название</th>
										<th>Статус</th>
										<th>Категория</th>
										<th>Время</th>
										<th>Описание</th>
										<th>Действие</th>
									</tr>
									<?php foreach($apps as $app): ?>
										<?php
											$isNew = $appModel->getField('status', $app['id']) == 'Новая';
											$isApproved = $appModel->getField('status', $app['id']) == 'Решена';
											$isCancel = $appModel->getField('status', $app['id']) == 'Отклонена';

											$color = '';

											if ($isApproved) {
												$color = 'text-accent';
											} elseif ($isCancel) {
												$color = 'text-danger';
											}
										?>

										<tr>
											<td><?= $app['name'] ?></td>
											<td>
												<p class="<?= $color ?>"><?= $app['status'] ?></p>
												<p><?= $isCancel ? 'Причина: ' . $app['reason'] : '' ?></p>
											</td>
											<td><?= $appModel->getCat($app['cat_id']) ?></td>
											<td><?= $app['created'] ?></td>
											<td><?= $app['text'] ?></td>
											<?php if ($isNew): ?>
												<td><a href="#" data-modal-open="app-delete" data-app-id="<?= $app['id'] ?>" class="link link_danger">Удалить</a></td>
											<?php else: ?>
												<td><span class="link link_disabled">Недоступно</span></td>
											<?php endif; ?>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					<?php else: ?>
						<p>Заявок не найдено.</p>
					<?php endif; ?>
				</div>
			</div>
		</section>
	</main>
	<footer class="footer">
		<div class="container">
			<div class="footer__content">
				<small class="">2022. Никита Кирша</small>
			</div>
		</div>
	</footer>
	<!-- удалить заявку -->
	<div class="modal" id="app-delete">
		<div class="modal__overlay" data-modal-close></div>
		<div class="modal__window">
			<div class="modal__heading">
				<h3 class="modal__title">Удалить заявку?</h3>
				<button class="btn-close" data-modal-close>&times;</button>
			</div>
			<div class="modal__content">
				<p>Данное действие нельзя будет отменить.</p>
				<form style="width: 100%;" method="post" action="actions/appDelete.php">
					<input type="hidden" name="app-delete-id" id="app-delete-id">
					<div class="inline inline_grow">
						<button class="btn btn_danger">Удалить</button>
						<a class="btn btn_danger btn_outline" href="#" data-modal-close>Закрыть</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<script src="assets/js/main.js"></script>
	<script src="assets/js/modal.js"></script>
</body>
</html>