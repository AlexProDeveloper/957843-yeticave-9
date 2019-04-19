<?php
function getTime() {
    $midnight = date_create("tomorrow midnight");
    $today = date_create("now");
    $diff = date_diff($today, $midnight);
    $currentDiff = date_interval_format($diff, "%h<span>:</span>%I");
    return $currentDiff;
}
?>
<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <!--заполните этот список из массива категорий-->

        <?php foreach ($categories  as $category) { ?>
            <li class="promo__item promo__item--boards">
                <a  class="promo__link" href="pages/all-lots.html"><?php print htmlspecialchars($category); ?></a>
            </li>
        <?php } ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <!--заполните этот список из массива с товарами-->
        <?php foreach ($goods as $good) { ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?=$good["url"]; ?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?= htmlspecialchars($good["category"]); ?></span>
                    <h3 class="lot__title"><a class="text-link" href="pages/lot.html"><?= htmlspecialchars($good["name"]); ?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?= asCurrancy(htmlspecialchars($good["price"])); ?></span>
                        </div>
                        <?php if(getTime() <= 1) { ?>
                        <div class="lot__timer timer timer--finishing">
                            <?php print getTime(); ?>
                        <?php } else {?>
                        <div class="lot__timer timer">
                            <?php print getTime(); } ?>

                        </div>
                    </div>
                </div>
            </li>
        <?php } ?>
    </ul>
</section>