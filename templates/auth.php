<?php  if(isset($_SESSION['user']) && isOver($good['ended_at'])) {  ?>
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
                Мин. ставка <span><?= asCurrancy($good['start_price'] + $good['price']); ?></span>
                <?php $currentPrice = $good['start_price'] + $good['price'] ?>
            </div>
        </div>
        <!--                <form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post" autocomplete="off">-->
        <!--                    <p class="lot-item__form-item form__item form__item--invalid">-->
        <!--                        <label for="cost">Ваша ставка</label>-->
        <!--                        <input id="cost" type="text" name="cost" placeholder="--><?//= $currentPrice; ?><!--">-->
        <!--                        <span class="form__error">Введите наименование лота</span>-->
        <!--                    </p>-->
        <!--                    <button type="submit" class="button">Сделать ставку</button>-->
        <!--                </form>-->
    </div>
<?php } else {} ?>

