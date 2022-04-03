<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/main.css">
	<title>Городской портал - создать аккаунт</title>
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="header__content">
				<a href="index.php" class="logo">
					<img class="logo__img" src="assets/img/logo-light.png" alt="">
				</a>
				<div class="header__inline">
					<a href="login.php" class="btn">Войти</a>
					<a href="index.php" class="btn btn_outline">На главную</a>
				</div>
			</div>
		</div>
	</header>
	<main class="main">
		<!-- создать аккаунт -->
		<section class="section">
			<div class="container">
				<div class="section__heading">
					<h1 class="section__title">Городской портал - создать аккаунт</h1>
				</div>
				<div class="section__content">
					<div class="alert">
						<div class="alert__content">
							<span class="alert__text">
								ФИО должно начинаться с большой буквы.
							</span>
							<button class="alert__close">&times;</button>
						</div>
					</div>
					<form class="form">
						<input required name="name" type="text" class="input input_danger" placeholder="ФИО">
						<input required name="login" type="text" class="input" placeholder="Логин">
						<input required name="email" type="email" class="input" placeholder="Почта">
						<input required name="password" type="password" class="input" placeholder="Пароль">
						<input required name="password-repeat" type="password" class="input" placeholder="Повторите пароль">
						<div class="label-checkbox">
							<input type="checkbox" name="privacy" id="privacy">
							<label for="privacy">Согласен на обработку персональных данных</label>
						</div>
						<button class="btn">Войти</button>
					</form>
				</div>
			</div>
		</section>
	</main>
	<footer class="footer">
		<div class="container">
			<div class="footer__content">
				<small class="text-muted">2022. Никита Кирша</small>
			</div>
		</div>
	</footer>
	
	<script src="assets/js/main.js"></script>
</body>
</html>