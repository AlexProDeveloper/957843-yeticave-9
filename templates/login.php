<nav class="nav nav_top">
    <ul class="nav__list container">
        <?php foreach ($categories as $category) { ?>
            <li class="nav__item">
                <a href="all-lots.php?category_id=<?= $category['id'];?>"><?= htmlspecialchars($category['name']); ?></a>
            </li>
        <?php } ?>
    </ul>
</nav>
<<<<<<< Updated upstream
<form class="form container <?php if(count($errors)) { print 'form--invalid';} ?>" action="login.php" method="post"> <!-- form--invalid -->
=======
<form class="mt form container <?php if(count($errors)) { print 'form--invalid';} ?>" action="login.php" enctype="multipart/form-data" method="post"> <!-- form--invalid -->
>>>>>>> Stashed changes
    <h2>Вход</h2>
    <div class="form__item <?php if($errors['email']) { print 'form__item--invalid';} ?>"> <!-- form__item--invalid -->
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= $_POST['email']; ?>">
        <span class="form__error"><?= $errors['email']; ?></span>
    </div>
    <div class="form__item form__item--last <?php if($errors['password']) { print 'form__item--invalid';} ?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" placeholder="Введите пароль" value="<?= $_POST['password']; ?>">
        <span class="form__error"><?= $errors['password']; ?></span>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Войти</button>
</form>