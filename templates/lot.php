<?php
require 'D:\сайты\php\ospanel\domains\localhost\data.php';
?>
<nav class="nav">
    <ul class="nav__list container">
        <?php foreach ($categories as $category) { ?>
            <li class="nav__item">
                <a href="all-lots.html"><?= htmlspecialchars($category['name']); ?></a>
            </li>
        <?php } ?>
    </ul>
</nav>
<section class="lot-item container">
    <h2><?= htmlspecialchars($good['name']);?></h2>
    <div class="lot-item__content">
        <div class="lot-item__left">
            <div class="lot-item__image">
                <img src="<?= htmlspecialchars($good['url']); ?>" width="730" height="548" alt="Сноуборд">
            </div>
            <p class="lot-item__category">Категория: <span><?= $good['cat']; ?></span></p>
            <p class="lot-item__description"><?= htmlspecialchars($good['description']); ?></p>
        </div>
        <div class="lot-item__right">
            <?php require 'auth.php';
            //print $auth;
            ?>
            <div class="history">
                <h3>История ставок (<span><?= count($betHistory); ?></span>)</h3>
                <table class="history__list">
                    <?php foreach ($betHistory as $bet) { ?>
                        <tr class="history__item">
                            <td class="history__name"><?= $bet['name'] ?></td>
                            <td class="history__price"><?= asCurrancy($bet['bet_price']); ?></td>
                            <td class="history__time">5 минут назад</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</section>