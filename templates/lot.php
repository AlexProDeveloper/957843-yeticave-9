<?php //require 'D:\сайты\php\ospanel\domains\localhost\data.php'; ?>
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
            <p class="lot-item__category">Категория: <span><?= $good2['cat']; ?></span></p>
            <p class="lot-item__description"><?= htmlspecialchars($good['description']); ?></p>
        </div>
        <div class="lot-item__right">
            <?php // if($is_auth == 1) {  ?>
            <div class="lot-item__state">
                <div class="lot-item__timer timer <?= htmlspecialchars((isDead($good['ended_at']))) ? 'timer--finishing' : ''; ?>">
                    <?= getTime($good['ended_at']); ?>
                </div>
                <div class="lot-item__cost-state">
                    <div class="lot-item__rate">
                        <span class="lot-item__amount">Текущая цена</span>
                        <span class="lot-item__cost"><?= asCurrancy($good['price']); ?></span>
                    </div>
                    <div class="lot-item__min-cost">
                        Мин. ставка <span><?= asCurrancy(htmlspecialchars($good['start_price'])); ?></span>
                    </div>
                </div>
                <form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post" autocomplete="off">
                    <p class="lot-item__form-item form__item form__item--invalid">
                        <label for="cost">Ваша ставка</label>
                        <input id="cost" type="text" name="cost" placeholder="12 000">
                        <span class="form__error">Введите наименование лота</span>
                    </p>
                    <button type="submit" class="button">Сделать ставку</button>
                </form>
            </div>
            <?php //} else {} ?>
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