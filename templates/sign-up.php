<nav class="nav nav_top">
    <ul class="nav__list container">
        <?php foreach ($categories as $category) { ?>
            <li class="nav__item">
                <a href="all-lots.php?category_id=<?= $category['id'];?>"><?= htmlspecialchars($category['name']); ?></a>
            </li>
        <?php } ?>
    </ul>
</nav>

<form class="form mt container <?php  if(count($errors)) { print 'form--invalid';} ?>" action="sign-up.php" method="post" autocomplete="off">
    <h2>Регистрация нового аккаунта</h2>
    <div class="form__item <?php if($errors['email']) {print 'form__item--invalid';} ?>">
        <label for="email">E-mail <sup>*</sup></label>
        <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?php if (isset($_POST['email'])) { print $_POST['email']; } ?>">
        <span class="form__error"><?= $errors['email'] ?></span>
    </div>
    <div class="form__item <?php if($errors['password']) { print 'form__item--invalid';} ?>">
        <label for="password">Пароль <sup>*</sup></label>
        <input id="password" type="password" name="password" placeholder="Введите пароль" value="<?php if (isset($_POST['password'])) { print $_POST['password']; } ?>">
        <span class="error"><?php if (isset($errors['password'])) {print $errors['password']; } ?></span>
    </div>
    <div class="form__item <?php if($errors['name']) { print 'form__item--invalid';} ?>">
        <label for="name">Имя <sup>*</sup></label>
        <input id="name" type="text" name="name" placeholder="Введите имя" value="<?php if (isset($_POST['name'])) { print $_POST['name']; } ?>">
        <span class="form__error"><?= $errors['name']; ?></span>
    </div>
    <div class="form__item <?php if($errors['contacts']) { print 'form__item--invalid';} ?>">
        <label for="contacts">Контактные данные <sup>*</sup></label>
        <textarea id="contacts" name="contacts" placeholder="Напишите как с вами связаться"><?php if (isset($_POST['description'])) { $_POST['contacts']; } ?></textarea>
        <span class="form__error"><?= $errors['contacts']; ?></span>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Зарегистрироваться</button>
    <a class="text-link" href="../login.php">Уже есть аккаунт</a>
</form>