<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Добавление лота</title>
  <link href="../css/normalize.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/flatpickr.min.css" rel="stylesheet">
</head>
<body>
      <nav class="nav">
          <ul class="nav__list container">
              <?php foreach ($categories as $category_id) { ?>
                  <li class="nav__item">
                      <a href="all-lots.html"><?= $category_id['name'];?></a>
                  </li>
              <?php } ?>
          </ul>
      </nav>
    <form action="add.php" method="post" class="form form--add-lot container <?= (count($errors)) ? 'form--invalid' : ''; ?> ">  <!-- form--invalid -->
        <h2>Добавление лота</h2>
        <div class="form__container-two">
            <div class="form__item <?php if($errors['name']) { print 'form__item--invalid';  } ?>"> <!-- form__item--invalid -->
                <label for="name">Наименование <sup>*</sup></label>
                <input id="name" type="text" name="name" placeholder="Введите наименование лота" value="<?= $_POST['name']; ?>" >
                <span class="form__error"><?= $errors['name']; ?></span>
            </div>
            <div class="form__item <?php if($errors['category_id']) { print 'form__item--invalid'; }?>">
                <label for="category_id">Категория <sup>*</sup></label>
                <select id="category_id" name="category_id">
                    <option>Выберите категорию</option>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?= $category['id']; ?>">
                            <?= $category['name']; ?>
                        </option>
                    <?php } ?>
                </select>
                <span class="form__error">Выберите категорию</span>
            </div>
        </div>
        <div class="form__item form__item--wide <?php if($errors['description']) { print 'form__item--invalid'; }?>">
            <label for="message">Описание <sup>*</sup></label>
            <textarea id="message" name="description" placeholder="Напишите описание лота"><?=$_POST['description']; ?></textarea>
            <span class="form__error"><?= $errors['description']; ?></span>
        </div>
        <div class="form__item form__item--file <?php if($errors['url']) { print 'form__item--invalid'; }?>">
            <label>Изображение <sup>*</sup></label>
            <div class="form__input-file">
                <input class="visually-hidden" type="file" id="url" value="" name="url">
                <label for="url">
                    Добавить
                </label>

            </div>
            <span class="form__error"><?= $errors['url']; ?></span>
        </div>
        <div class="form__container-three">
            <div class="form__item form__item--small <?php if($errors['start_price']) { print 'form__item--invalid'; }?>">
                <label for="start_price">Начальная цена <sup>*</sup></label>
                <input id="start_price" type="text" name="start_price" placeholder="0" value="<?= $_POST['start_price']; ?>">
                <span class="form__error"><?=$errors['start_price']; ?></span>
            </div>
            <div class="form__item form__item--small <?php if($errors['step']) { print 'form__item--invalid'; }?>">
                <label for="step">Шаг ставки <sup>*</sup></label>
                <input id="step" type="text" name="step" placeholder="0" value="<?= $_POST['step']; ?>">
                <span class="form__error"><?= $errors['step']; ?></span>
            </div>
            <div class="form__item <?php if($errors['ended_at']) { print 'form__item--invalid'; }?>">
                <label for="ended_at">Дата окончания торгов <sup>*</sup></label>
                <input class="form__input-date" id="ended_at" type="text" name="ended_at" placeholder="Введите дату в формате ГГГГ-ММ-ДД" value="<?= $_POST['ended_at']; ?>">
                <span class="form__error"><?= $errors['ended_at']; ?></span>
            </div>
        </div>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <button type="submit" class="button">Добавить лот</button>
    </form>





