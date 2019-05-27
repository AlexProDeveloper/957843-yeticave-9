<nav class="nav nav_top">
    <ul class="nav__list container">
        <?php foreach ($categories as $category) { ?>
            <li class="nav__item">
                <a href="all-lots.php?category_id=<?= $category['id'];?>"><?= htmlspecialchars($category['name']); ?></a>
            </li>
        <?php } ?>
    </ul>
</nav>
<section class="rates container mt">
    <h2>Мои ставки</h2>
    <table class="rates__list">
        <?php foreach ($bets as $bet) { ?>
            <tr class="rates__item  <?php if ($bet['winner_id'] === $_SESSION['user']['id']) { print 'rates__item--win'; } ?>">
                <td class="rates__info">
                    <div class="rates__img">
                        <img src="uploads/<?= $bet['url']; ?>" width="54" height="40" alt="Сноуборд">
                    </div>
                    <h3 class="rates__title">
                        <a href="lot.php?id=<?= $bet['lot_id'];?>"><?= htmlspecialchars($bet['name']); ?></a>
                        <?php if ($bet['winner_id'] === $_SESSION['user']['id']) { print "<p>" . $bet['description'] . "</p>"; } ?>
                    </h3>
                </td>
                <td class="rates__category">
                    <?= htmlspecialchars($bet['cat']) ?>
                </td>
                <td class="rates__timer">
                    <div class="timer  <?php if (isDead($bet['ended_at']) && $bet['winner_id'] !== $_SESSION['user']['id']) { print 'timer--finishing'; } elseif ($bet['winner_id'] === $_SESSION['user']['id']) { print 'timer--win';} ?>"><?php if ($bet['winner_id'] === $_SESSION['user']['id']) { print 'Стака сыграла'; } else { print  getTime($bet['ended_at']); } ?></div>
                </td>
                <td class="rates__price">
                    <?= asCurrancy($bet['bet_price']); ?>
                </td>
                <td class="rates__time">
                    <?= getBetTime($bet['bet_create']); ?>
                </td>
            </tr>
        <?php }  ?>
    </table>
</section>
