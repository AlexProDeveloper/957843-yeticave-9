<nav class="nav">
    <ul class="nav__list container">
        <?php foreach ($categories as $category) { ?>
            <li class="nav__item">
                <a href="all-lots.html"><?= $category['name']; ?></a>
            </li>
        <?php } ?>
    </ul>
</nav>
<form class="form mt container <?php if (count($errors)) { print 'form--invalid';} ?>" action="login.php" enctype="multipart/form-data" method="post">
    <h2>Вход</h2>
    <div class="form__item <?php if (isset($errors['email'])) { print 'form__item--invalid';} ?>">
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?php if (isset($_POST['email'])){ print $_POST['email']; } ?>">
        <span class="form__error"><?php if (isset($errors['email'])) { print $errors['email']; } ?></span>
    </div>
    <div class="form__item form__item--last <?php if(isset($errors['password'])) { print 'form__item--invalid'; } ?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" placeholder="Введите пароль" value="<?php if (isset($_POST['password'])) { print $_POST['password']; } ?>">
        <span class="form__error"><?php if (isset($errors['password'])) { print $errors['password']; } ?></span>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Войти</button>
</form>
