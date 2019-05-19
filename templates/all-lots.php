<nav class="nav nav_top">
    <ul class="nav__list container">
        <?php foreach ($categories as $category) { ?>
            <li class="nav__item">
                <a href="all-lots.php?category_id=<?= $category['id'];?>"><?= htmlspecialchars($category['name']); ?></a>
            </li>
        <?php } ?>
    </ul>
</nav>
<section class="lots mt">
    <?php if(count($goods[0]['count']) > 0) { ?>
    <h2>Все лоты в категории <span>«<?= $goods[0]['cat']; ?>»</span></h2>
<ul class="lots__list">
    <?php foreach ($goods as $good) { ?>
    <li class="lots__item lot">
        <div class="lot__image">
            <img src="/uploads/<?= htmlspecialchars($good['url']); ?>" width="350" height="260" alt="Сноуборд">
        </div>
        <div class="lot__info">
            <span class="lot__category"><?= htmlspecialchars($good['cat']); ?></span>
            <h3 class="lot__title"><a class="text-link" href="../lot.php?id=<?= $good['lot_id'];?>"><?= htmlspecialchars($good['name']);?></a></h3>
            <div class="lot__state">
                <div class="lot__rate">
                    <span class="lot__amount">Стартовая цена</span>
                    <span class="lot__cost"><?= asCurrancy($good['start_price']); ?></span>
                </div>
                <div class="lot-item__timer timer <?= isDead($good['ended_at']) ? 'timer--finishing' : ''; ?>">
                    <?= getTime($good['ended_at']); ?>
                </div>
            </div>
        </div>
    <?php } } else {?>
    <h2>В данной категории пока нет лотов</h2>
    <?php } ?>
    </section>