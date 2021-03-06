<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
        <?php foreach ($categories  as $category) { ?>
            <li class="promo__item promo__item--<?= htmlspecialchars($category['code']); ?>">
                <a class="promo__link" href="all-lots.php?category_id=<?= $category['id'];?>"><?= htmlspecialchars($category['name']); ?></a>
            </li>
        <?php }  ?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
        <?php foreach ($goods as $good) { ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="/uploads/<?= htmlspecialchars($good["url"]); ?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?= htmlspecialchars($good["cat"]); ?></span>
                    <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?= $good['id']; ?>"><?= htmlspecialchars($good["name"]); ?></a></h3>
                     <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?= asCurrancy($good["start_price"]); ?></span>
                        </div>
                        <div class="lot__timer timer <?= (isDead($good['ended_at'])) ? 'timer--finishing' : ''; ?> ">
                            <?= getTime($good['ended_at']); ?>
                        </div>
                    </div>
            </li>
        <?php } ?>
    </ul>
</section>