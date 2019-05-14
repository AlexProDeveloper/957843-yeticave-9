<nav class="nav">
    <ul class="nav__list container">
        <?php foreach ($categories as $category) { ?>
            <li class="nav__item">
                <a href="all-lots.php"><?= htmlspecialchars($category['name']); ?></a>
            </li>
        <?php } //var_dump($bets['url']);?>
    </ul>
</nav>
<section class="rates container">
    <h2>Мои ставки</h2>
    <table class="rates__list">
        <?php foreach ($bets as $bet) { ?>
        <tr class="rates__item">
            <td class="rates__info">
                <div class="rates__img">
                    <img src="uploads/<?= $bet['url']; ?>" width="54" height="40" alt="Сноуборд">
                </div>
                <h3 class="rates__title"><a href="lot.php?id=<?= $bet['lot_id'];?>"><?= htmlspecialchars($bet['name']); ?></a></h3>
            </td>
            <td class="rates__category">
                <?= htmlspecialchars($bet['cat']) ?>
            </td>
            <td class="rates__timer">
                <div class="timer timer--finishing">07:13:34</div>
            </td>
            <td class="rates__price">
                <?= htmlspecialchars($bet['bet_price']); ?>
            </td>
            <td class="rates__time">
                5 минут назад
            </td>
        </tr>
        <?php } ?>
    </table>
</section>