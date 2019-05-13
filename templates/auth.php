<?php if($is_auth /*|| isOver($good['ended_at']) */ && $user_id != $user['user_id']) {  ?>
    <div class="lot-item__state">
        <div class="lot-item__timer timer <?= isDead($good['ended_at']) ? 'timer--finishing' : ''; ?>">
            <?= getTime($good['ended_at']); ?>
        </div>
        <div class="lot-item__cost-state">
            <div class="lot-item__rate">
                <span class="lot-item__amount">Текущая цена</span>
                <span class="lot-item__cost"><?= asCurrancy($good['start_price']); ?></span>
            </div>
            <div class="lot-item__min-cost">
                Мин. ставка <span><?= asCurrancy($good['start_price'] + $good['step']); ?></span>
                <?php// $currentPrice = $good['start_price'] + $good['step']; ?>
            </div>
        </div>
        <form class="lot-item__form" action="lot.php?id=<?= $good['id']; ?>" method="post" autocomplete="off">
            <p class="lot-item__form-item form__item form__item--invalid">
                <label for="cost">Ваша ставка</label>
                <input id="cost" type="text" name="cost" placeholder="" value="<?= $_POST['cost']; ?>">
                <span class="form__error"><?= $errors['cost']; ?></span>
            </p>
            <button type="submit" class="button">Сделать ставку</button>
        </form>
    </div>
<?php } else {} ?>

