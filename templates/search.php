<nav class="nav">
    <ul class="nav__list container">
        <?php foreach ($categories as $category) { ?>
            <li class="nav__item">
                <a href="all-lots.php?category_id=<?= $category['id']; ?>"><?= htmlspecialchars($category['name']); ?></a>
            </li>
        <?php } ?>
    </ul>
</nav>
<div class="container">
    <section class="lots">
        <h2>Результаты поиска по запросу «<span><?= $search; ?></span>»</h2>
        <ul class="lots__list">
            <?php if($goods) { foreach ($goods as $good) { ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="uploads/<?= htmlspecialchars($good['url']); ?>" width="350" height="260" alt="Сноуборд">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?= htmlspecialchars($good['cat']); ?></span>
                    <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?= $good['id'];?>"><?= htmlspecialchars($good['name']); ?></a></h3>
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
            </li>
            <?php } ?>
        </ul>
    </section>
    <ul class="pagination-list">
        <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
        <li class="pagination-item pagination-item-active"><a>1</a></li>
        <li class="pagination-item"><a href="#">2</a></li>
        <li class="pagination-item"><a href="#">3</a></li>
        <li class="pagination-item"><a href="#">4</a></li>
        <li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
    </ul>
    <?php } else { ?>
        <h2>По вашему запросу ничего не найденно</h2>
    <?php } ?>
</div>