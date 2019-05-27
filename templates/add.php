<nav class="nav nav_top">
    <ul class="nav__list container">
        <?php foreach ($categories as $category) { ?>
            <li class="nav__item">
                <a href="all-lots.php?category_id=<?= $category['id'];?>"><?= htmlspecialchars($category['name']); ?></a>
            </li>
        <?php } ?>
    </ul>
</nav>
<form action="add.php" enctype="multipart/form-data" method="post" class="mt form form--add-lot container <?= (count($errors)) ? 'form--invalid' : ''; ?> ">
    <h2>Добавление лота</h2>
    <div class="form__container-two">
        <div class="form__item <?php if (isset($errors['name'])) { print 'form__item--invalid';  } ?>">
            <label for="name">Наименование <sup>*</sup></label>
            <input id="name" type="text" name="name" placeholder="Введите наименование лота" value="<?php if (isset($_POST['name'])) { print $_POST['name']; }?>" >
            <span class="form__error"><?php if (isset($errors['name'])){ $errors['name']; } ?></span>
        </div>
        <div class="form__item <?php if (isset($errors['category_id'])) { print 'form__item--invalid'; }?>">
            <label for="category_id">Категория <sup>*</sup></label>
            <select id="category_id" name="category_id">
                <option>Выберите категорию</option>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?= $category['id']; ?>">
                        <?= htmlspecialchars($category['name']); ?>
                    </option>
                <?php } ?>
            </select>
            <span class="form__error"><?php if (isset($errors['category_id'])) { print $errors['category_id']; } ?></span>
        </div>
    </div>
    <div class="form__item form__item--wide <?php if (isset($errors['description'])) { print 'form__item--invalid'; }?>">
        <label for="message">Описание <sup>*</sup></label>
        <textarea id="message" name="description" placeholder="Напишите описание лота"><?php if (isset($_POST['description'])) { print $_POST['description']; } ?></textarea>
        <span class="form__error"><?php if (isset($errors['description'])) { print $errors['description']; } ?></span>
    </div>
    <div class="form__item form__item--file <?php if (isset($errors['url'])) { print 'form__item--invalid'; }?>">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="url" value="" name="url">
            <label for="url">
                Добавить
            </label>

        </div>
        <span class="form__error"><?php if (isset($errors['url'])) { print $errors['url']; } ?></span>
    </div>
    <div class="form__container-three">
        <div class="form__item form__item--small <?php if(isset($errors['start_price'])) { print 'form__item--invalid'; }?>">
            <label for="start_price">Начальная цена <sup>*</sup></label>
            <input id="start_price" type="text" name="start_price" placeholder="0" value="<?php if (isset($_POST['start_price'])) { print $_POST['start_price']; } ?>">
            <span class="form__error"><?php if (isset($errors['start_price'])) { print $errors['start_price']; } ?></span>
        </div>
        <div class="form__item form__item--small <?php if ($errors['step']) { print 'form__item--invalid'; }?>">
            <label for="step">Шаг ставки <sup>*</sup></label>
            <input id="step" type="text" name="step" placeholder="0" value="<?php if (isset($_POST['step'])) { print $_POST['step']; } ?>">
            <span class="form__error"><?php if (isset($errors['step'])) { print $errors['step']; } ?></span>
        </div>
        <div class="form__item <?php if (isset($errors['ended_at'])) { print 'form__item--invalid'; }?>">
            <label for="ended_at">Дата окончания торгов <sup>*</sup></label>
            <input class="form__input-date" id="ended_at" type="text" name="ended_at" placeholder="Введите дату в формате ГГГГ-ММ-ДД" value="<?php if (isset($_POST['ended_at'])) { print $_POST['ended_at']; } ?>">
            <span class="form__error"><?php if (isset($errors['ended_at'])) { print $errors['ended_at']; } ?></span>
        </div>
    </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
</form>