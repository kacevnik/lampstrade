<?php
$page['name'] = 'index';
$page['title'] = 'lampstrade';
include('part/header.php');
require_once ('storege/utm_source.php');
?>
    <section id="promo" class="promo">
        <div class="container container_promo">
            <div class="promo__content">
                <div class="promo__header">
                    <h1 class="promo__title"><?= $promo__title; ?></h1>
                    <div class="promo__service">
                        <?= $promo__service?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container container_promo">
            <div class="promo__buttons">
                <a href="#give-price" class="promo__button button button_fix js-popup">
                    <span class="button__text">скачать прайс-лист</span>
                </a>
                <?php include('part/popup-give-price.php'); ?>
                <a href="#consultation" class="promo__button button button_fix button_light button_u js-popup">
                    <span class="button__text">заказать консультацию</span>
                </a>
                <?php include('part/popup-consultation.php'); ?>
            </div>
            <div class="promo__search">Не нашли в прайсе нужную позицию? <a href="#to-us" class="link-parent js-popup">Сообщите
                    нам!</a></div>
            <?php include('part/popup-to-us.php'); ?>
        </div>
        <div class="container container_promo promo__distributors distributors">
            <div class="distributors__header">Мы работаем с производителями:</div>
            <div class="distributors__row">
                <div class="distributors__item">
                    <img src="images/distributor/1.png" alt="" class="distributors__img">
                </div>
                <div class="distributors__item">
                    <img src="images/distributor/2.png" alt="" class="distributors__img">
                </div>
                <div class="distributors__item">
                    <img src="images/distributor/3.png" alt="" class="distributors__img">
                </div>
                <div class="distributors__item">
                    <img src="images/distributor/4.png" alt="" class="distributors__img">
                </div>
                <div class="distributors__item">
                    <img src="images/distributor/5.png" alt="" class="distributors__img">
                </div>
                <div class="distributors__item">
                    <img src="images/distributor/6.png" alt="" class="distributors__img">
                </div>
                <div class="distributors__item">
                    <img src="images/distributor/7.png" alt="" class="distributors__img">
                </div>
            </div>
        </div>
        <a href="#one-click-block" class="promo__scroll js-scroll-to">
            <i class="icon icon-scroll promo__scroll-ico"></i>
            Больше информации
        </a>
    </section>

    <section id="one-click-block" class="section section_gradient one-click">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">заказ в 1 клик</h2>
            </div>

            <form action="#one-click" method="post" enctype="multipart/form-data" class="form one-click__form js-form-popup upload">
                <div class="form__header">Укажите наименования ламп или загрузите файл со списком.</div>

                <div class="form__line">
                    <div class="form__field">
                        <textarea name="text" data-placeholder></textarea>
                    </div>
                </div>
                <div class="form__line">
                    <div class="form__field">
                        <input id="images" type="file" name="file" data-placeholder="Загрузить файл...">
                    </div>
                </div>

                <div class="form__submit">
                    <input type="submit" value="оформить заказ" class="button button_fix">
                </div>
            </form>
            <?php include('part/popup-one-click.php'); ?>
        </div>
    </section>

    <section id="catalog" class="section section_dark section_bg stocks">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">товары в акции</h2>
            </div>
        </div>

        <div class="container container_stocks">
            <div class="stocks__items js-stocks owl-carousel">
                <?php include_once('storege/lamp_array.php');
                foreach ($lamps as $lamp) : ?>
                    <div class="stocks__item">
                        <div class="product">
                            <div class="product__image">
                                <img src="<?= $lamp['image'] ?>" alt="" class="product__img">
                            </div>
                            <div class="product__title"><?= $lamp['product_name'] ?></div>
                            <div class="product__description"><?= $lamp['product_desc'] ?></div>
                            <div class="product__parameters parameters">
                                <div class="parameter">
                                    <div class="parameter__label key">Напряжение:</div>
                                    <div class="parameter__label parameter__value"><?= $lamp['param_n'] ?></div>
                                </div>
                                <div class="parameter">
                                    <div class="parameter__label key">Мощность:</div>
                                    <div class="parameter__label parameter__value"><?= $lamp['param_m'] ?></div>
                                </div>
                                <div class="parameter">
                                    <div class="parameter__label key">Цоколь:</div>
                                    <div class="parameter__label parameter__value"><?= $lamp['param_tc'] ?></div>
                                </div>
                                <div class="parameter">
                                    <div class="parameter__label key">Тип лампы:</div>
                                    <div class="parameter__label parameter__value"><?= $lamp['param_l'] ?></div>
                                </div>
                                <div class="parameters__hidden">
                                    <div class="parameter">
                                        <div class="parameter__label">Срок службы:</div>
                                        <div class="parameter__label parameter__value"><?= $lamp['param_n_hid'] ?></div>
                                    </div>
                                    <div class="parameter">
                                        <div class="parameter__label">Цветовая температура:</div>
                                        <div class="parameter__label parameter__value"><?= $lamp['param_m_hid'] ?></div>
                                    </div>
                                    <div class="parameter">
                                        <div class="parameter__label">Световой поток:</div>
                                        <div class="parameter__label parameter__value"><?= $lamp['param_tc_hid'] ?></div>
                                    </div>
                                    <div class="parameter">
                                        <div class="parameter__label">Страна производства:</div>
                                        <div class="parameter__label parameter__value"><?= $lamp['param_l_hid'] ?></div>
                                    </div>
                                </div>
                                <div class="parameters__toggle js-parameters-toggle">
                                    <div class="parameters__toggler parameters__toggler_show">
                                        Еще характеристики<i class="fa fa-angle-down"></i>
                                    </div>
                                    <div class="parameters__toggler parameters__toggler_hide">
                                        Свернуть<i class="fa fa-angle-up"></i>
                                    </div>
                                </div>
                            </div>
                            <a href="#product" class="button button_gray button_wide button_small js-popup buy">
                                <span class="button__text">заказать</span>
                            </a>
                            <div class="product__sale"><?= $lamp['product_sale'] ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php include('part/popup-product.php'); ?>

        <div class="container">
            <div class="stocks__download">На сайте показаны не все лампы по акциям, чтобы увидеть все, скачайте
                список.
            </div>

            <a href="#stocks"  class="button button_light button_wide button_download js-popup">
                <span class="button__text button__text_u">скачать список ламп в акции</span>
            </a>
            <?php include('part/popup-stocks.php'); ?>
        </div>
    </section>

    <section class="section clients">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">с нами работают</h2>
            </div>

            <div class="clients__items js-clients owl-carousel">
                <a href="#opinion_1" class="clients__link js-popup">
				<span class="clients__image">
					<span class="clients__img-wrap">
						<img src="images/client/Б1.jpg" alt="" class="clients__img clients__img_grayscale">
						<img src="images/client/Большой цирк на фонтанке.jpg" alt="" class="clients__img clients__img_color">
					</span>
				</span>
                    <span class="clients__text">Отзыв</span>
                </a>
                <a href="#opinion_2" class="clients__link js-popup">
				<span class="clients__image">
					<span class="clients__img-wrap">
						<img src="images/client/Н1.jpg" alt="" class="clients__img clients__img_grayscale">
						<img src="images/client/Норильский заполярный театр драмы им.Вл.Маяковского.jpg" alt="" class="clients__img clients__img_color">
					</span>
				</span>
                    <span class="clients__text">Отзыв</span>
                </a>
                <a href="#opinion_3" class="clients__link js-popup">
				<span class="clients__image">
					<span class="clients__img-wrap">
						<img src="images/client/ТЛ1.jpg" alt="" class="clients__img clients__img_grayscale">
						<img src="images/client/Театр Ленсовета.jpg" alt="" class="clients__img clients__img_color">
					</span>
				</span>
                    <span class="clients__text">Отзыв</span>
                </a>
                <a href="#opinion_4" class="clients__link js-popup">
				<span class="clients__image">
					<span class="clients__img-wrap">
						<img src="images/client/ТК1.jpg" alt="" class="clients__img clients__img_grayscale">
						<img src="images/client/Театр музыкальной комедии.png" alt="" class="clients__img clients__img_color">
					</span>
				</span>
                    <span class="clients__text">Отзыв</span>
                </a>
                <a href="#opinion_5" class="clients__link js-popup">
				<span class="clients__image">
					<span class="clients__img-wrap">
						<img src="images/client/Т1.jpg" alt="" class="clients__img clients__img_grayscale">
						<img src="images/client/Театр комедии им. Н.П.Акимова.jpg" alt="" class="clients__img clients__img_color">
					</span>
				</span>
                    <span class="clients__text">Отзыв</span>
                </a>
                <a href="#opinion_6" class="clients__link js-popup">
				<span class="clients__image">
					<span class="clients__img-wrap">
						<img src="images/client/Теай1.jpg" alt="" class="clients__img clients__img_grayscale">
						<img src="images/client/Театральный центр на коломенской.jpg" alt="" class="clients__img clients__img_color">
					</span>
				</span>
                    <span class="clients__text">Отзыв</span>
                </a>
                <a href="#opinion_7" class="clients__link js-popup">
				<span class="clients__image">
					<span class="clients__img-wrap">
						<img src="images/client/Театр Мастерская.jpg" alt="" class="clients__img clients__img_grayscale">
						<img src="images/client/Театр Мастерская.jpg" alt="" class="clients__img clients__img_color">
					</span>
				</span>
                    <span class="clients__text">Отзыв</span>
                </a>
                <a href="#opinion_8" class="clients__link js-popup">
				<span class="clients__image">
					<span class="clients__img-wrap">
						<img src="images/client/Интерьерный театр.png" alt="" class="clients__img clients__img_grayscale">
						<img src="images/client/Интерьерный театр.png" alt="" class="clients__img clients__img_color">
					</span>
				</span>
                    <span class="clients__text">Отзыв</span>
                </a>
            </div>
            <?php include('part/popup-opinion_1.php'); ?>
            <?php include('part/popup-opinion_2.php'); ?>
            <?php include('part/popup-opinion_3.php'); ?>
            <?php include('part/popup-opinion_4.php'); ?>
            <?php include('part/popup-opinion_5.php'); ?>
            <?php include('part/popup-opinion_6.php'); ?>
            <?php include('part/popup-opinion_7.php'); ?>
            <?php include('part/popup-opinion_8.php'); ?>
        </div>
    </section>

    <section class="section section_gradient rare">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">редкие лампы</h2>
            </div>

            <form action="#rare" method="post" class="form rare__form js-form-popup upload">
                <div class="form__header">Если вы не можете найти нужную вам лампу, введите название (или несколько)
                    <br>в поле ниже или загрузите файл со списком.
                </div>

                <div class="form__line">
                    <div class="form__field">
                        <textarea name="text" placeholder="Пример: RADIUM RKP 1000W/24/KV/K39D"></textarea>
                    </div>
                </div>
                <div class="form__line">
                    <div class="form__field">
                        <input type="file" data-placeholder="Загрузить файл...">
                    </div>
                </div>

                <div class="form__submit">
                    <input type="submit" value="отправить запрос" class="button button_fix">
                </div>
            </form>
            <?php include('part/popup-rare.php'); ?>
        </div>
    </section>

    <section id="services" class="section section_dark section_bg services">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">участник госзакупок</h2>
                <div class="section__description">Наша команда состоит из надежных и ответственных людей, поэтому мы
                    регулярно участвуем в госзакупках согласно 223 и 44 ФЗ.<br>Для этого мы взаимодействуем с
                    заказчиками с помощью некоторых <a href="#places" class="js-popup">площадок</a>.
                </div>
                <?php include('part/popup-places.php'); ?>

                <a href="#consultation" class="button button_light button_fix button_u js-popup">
                    <span class="button__text">заказать консультацию</span>
                </a>
            </div>

            <div class="container__row services__items">
                <div class="container__col services__item">
                    <div class="services__ico">
                        <i class="icon icon-kommercheskoe"></i>
                    </div>
                    <div class="services__title">
                        сделаем Коммерческое <br>
                        предложение за час
                    </div>
                    <div class="services__text">Попробуйте!</div>
                    <div class="services__timer js-timer">01:00:00</div>
                    <div class="services__button">
                        <a href="#counter" class="button button_fix js-popup">
                            <span class="button__text">запустить счетчик</span>
                        </a>
                    </div>
                    <?php include('part/popup-counter.php'); ?>
                </div>
                <div class="container__col services__item">
                    <div class="services__ico">
                        <i class="icon icon-tehnicheskoe"></i>
                    </div>
                    <div class="services__title">
                        составим за вас <br>
                        Техническое задание
                    </div>
                    <div class="services__text">Пропишем подходящие для Ваших задач характеристики товара и отправим Вам
                        готовое техническое задание.
                    </div>
                    <div class="services__button">
                        <a href="#tz" class="button button_fix js-popup">
                            <span class="button__text">получить тех. задание</span>
                        </a>
                    </div>
                    <?php include('part/popup-tz.php'); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="section sertificates">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">сертификаты</h2>
            </div>

            <div class="container__row sertificates__items">
                <div class="sertificates__item">
                    <a href="#sertificate_osram" class="sertificates__link js-sertificate">
					<span class="sertificates__ico">
						<i class="icon icon-certificate"></i>
					</span>
                        <span class="sertificates__title">OSRAM</span>
                        <span class="sertificates__view">
						Просмотр
						<i class="fa fa-long-arrow-right"></i>
					</span>
                    </a>
                    <?php include('part/popup-sertificate_osram.php'); ?>
                </div>
                <div class="sertificates__item">
                    <a href="#sertificate_philips" class="sertificates__link js-sertificate">
					<span class="sertificates__ico">
						<i class="icon icon-certificate"></i>
					</span>
                        <span class="sertificates__title">philips</span>
                        <span class="sertificates__view">
						Просмотр
						<i class="fa fa-long-arrow-right"></i>
					</span>
                    </a>
                    <?php include('part/popup-sertificate_philips.php'); ?>
                </div>
                <div class="sertificates__item">
                    <a href="#sertificate_ge" class="sertificates__link js-sertificate">
					<span class="sertificates__ico">
						<i class="icon icon-certificate"></i>
					</span>
                        <span class="sertificates__title">GE</span>
                        <span class="sertificates__view">
						Просмотр
						<i class="fa fa-long-arrow-right"></i>
					</span>
                    </a>
                    <?php include('part/popup-sertificate_ge.php'); ?>
                </div>
                <div class="sertificates__item">
                    <a href="#sertificate_sylvania" class="sertificates__link js-sertificate">
					<span class="sertificates__ico">
						<i class="icon icon-certificate"></i>
					</span>
                        <span class="sertificates__title">sylvania</span>
                        <span class="sertificates__view">
						Просмотр
						<i class="fa fa-long-arrow-right"></i>
					</span>
                    </a>
                    <?php include('part/popup-sertificate_sylvania.php'); ?>
                </div>
                <div class="sertificates__item">
                    <a href="#sertificate_roccer" class="sertificates__link js-sertificate">
					<span class="sertificates__ico">
						<i class="icon icon-certificate"></i>
					</span>
                        <span class="sertificates__title">roccer</span>
                        <span class="sertificates__view">
						Просмотр
						<i class="fa fa-long-arrow-right"></i>
					</span>
                    </a>
                    <?php include('part/popup-sertificate_roccer.php'); ?>
                </div>
                <div class="sertificates__item">
                    <a href="#sertificate_radium" class="sertificates__link js-sertificate">
					<span class="sertificates__ico">
						<i class="icon icon-certificate"></i>
					</span>
                        <span class="sertificates__title">radium</span>
                        <span class="sertificates__view">
						Просмотр
						<i class="fa fa-long-arrow-right"></i>
					</span>
                    </a>
                    <?php include('part/popup-sertificate_radium.php'); ?>
                </div>
                <div class="sertificates__item">
                    <a href="#sertificate_lisma" class="sertificates__link js-sertificate">
					<span class="sertificates__ico">
						<i class="icon icon-certificate"></i>
					</span>
                        <span class="sertificates__title">lisma</span>
                        <span class="sertificates__view">
						Просмотр
						<i class="fa fa-long-arrow-right"></i>
					</span>
                    </a>
                    <?php include('part/popup-sertificate_lisma.php'); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="section delivery">
        <div class="container container_delivery">
            <div class="section__header">
                <h2 class="section__title">Доставка</h2>
            </div>

            <div class="delivery__items">
                <div class="delivery__item">
                    <div class="delivery__text">Бесплатная доставка в санкт-петербурге</div>
                    <a href="#approve" class="button button_fix js-popup">
                        <span class="button__text">согласовать дату и время</span>
                    </a>
                    <?php include('part/popup-approve.php'); ?>
                </div>
                <div class="delivery__item">
                    <div class="delivery__text">доставка по всей россии</div>
                    <a href="#delivery" class="button button_fix js-popup">
                        <span class="button__text">выбрать службу доставки</span>
                    </a>
                    <?php include('part/popup-delivery.php'); ?>
                </div>
                <div class="delivery__item">
                    <div class="delivery__text">самовывоз с нашего склада</div>
                    <a href="#contacts" class="button button_fix js-scroll">
                        <span class="button__text">схема проезда</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="section section_bg section_dark about">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">о нас</h2>
            </div>

            <div class="about__text">
                <p>Непоколебимыми принципами нашей компании всегда были и будут оставаться качественный сервис и лучшие условия поставки. </p>
                <p>За 12 лет работы в сфере шоу-техники в театрах, кино, клубах, на концертных площадках, нам точно стали известны проблемы и сложности возникающие при необходимости приобретения ламп для оборудования..</p>
                <p>В первую очередь, мы обеспечиваем бесперебойную работу площадок и не допускаем остановку постановочного процесса в виду отсутствия оборудования, длительного согласования закупки, подготовки документации, проведения мониторинга и прочих препон. </p>
                <p>Все наши специалисты имеют максимум полномочий и компетенций для оперативного решения задач любой сложности.   Мы всегда готовы взять на себя часть работы и ответственности технических служб или отделов снабжения. </p>
                <p>Во главу наших отношений с заказчиками мы всегда ставим доверие, лучшие цены и строгое соблюдение данных нами обещаний. Все это достигается за счет наличия на складе более 500 наименований товара, отлаженной логистике, оперативного менеджмента и высокого профессионализма нашей команды.</p>
            </div>
        </div>
    </section>

    <section class="section section_bg advantages">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">ваши выгоды</h2>
            </div>

            <div class="container__row advantages__items">
                <div class="container__col advantages__item">
                    <div class="advantages__ico">
                        <i class="icon icon-bez-predoplati"></i>
                    </div>
                    <div class="advantages__title">
                        работаем <br>
                        без предоплаты
                    </div>
                    <div class="advantages__text">Для оперативности поставки и закреплению надежных и долгосрочных отношений мы поставляем товар без предоплаты.
                    </div>
                </div>
                <div class="container__col advantages__item">
                    <div class="advantages__ico">
                        <i class="icon icon-dop-skidka"></i>
                    </div>
                    <div class="advantages__title">
                        допольнительные<br>
                        скидки
                    </div>
                    <div class="advantages__text">Мы всегда стремимся дать лучшие цены, но если Вы нашли цены ниже, сообщите нам, мы улучшим наше предложение.
                    </div>
                </div>
                <div class="container__col advantages__item">
                    <div class="advantages__ico">
                        <i class="icon icon-dostavka"></i>
                    </div>
                    <div class="advantages__title">
                        оперативная<br>
                        доставка
                    </div>
                    <div class="advantages__text">Мы проверили на себе много транспортных компаний и выбрали лучших, что бы Вы получали товар в срок.
                    </div>
                </div>
                <div class="container__col advantages__item">
                    <div class="advantages__ico">
                        <i class="icon icon-garantia"></i>
                    </div>
                    <div class="advantages__title">гарантия</div>
                    <div class="advantages__text">Мы гарантируем, что товар будет оригинальным и новым; что мы не сорвем сроки; что Вы останетесь довольны сотрудничеством.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="order" class="section section_gradient order">
        <div class="container">
            <div class="section__header">
                <h2 class="section__title">заказ в 1 клик</h2>
            </div>

            <form action="#one-click" method="post" class="form order__form js-form-popup upload">
                <div class="form__header">Введите позиции или загрузите файл со списком.</div>

                <div class="form__line">
                    <div class="form__field">
                        <textarea name="text" data-placeholder></textarea>
                    </div>
                </div>
                <div class="form__line">
                    <div class="form__field">
                        <input type="file" data-placeholder="Загрузить файл...">
                    </div>
                </div>

                <div class="form__submit form__submit_order">
                    <input type="submit" value="оформить заказ" class="button button_fix">
                    <a href="#give-price" target="_blank" class="button button_gray button_fix button_u order__download js-popup">
                        <span class="button_text">скачать прайс-лист</span>
                    </a>
                </div>
                <div class="order__search">Не нашли в прайсе нужную позицию? <a href="#to-us"
                                                                                class="link-parent js-popup">Сообщите нам!</a>
                </div>
            </form>
        </div>
    </section>

    <section id="contacts" class="contacts">
        <div class="container container_contacts">
            <div class="contacts__content">
                <h2 class="contacts__title">контакты</h2>

                <div class="contacts__item">
                    <div class="fa fa-home contacts__ico"></div>
                    Санкт-Петербург,<br>
                    ш. Революции 83Б,<br>
                    БЦ Эра-кросс, офис 404<br>
                </div>

                <a href="mailto:sale@lampstrade.ru" class="contacts__item">
                    <span class="fa fa-envelope contacts__ico contacts__ico_mail"></span>
                    sale@lampstrade.ru
                </a>

                <div class="contacts__phones">
                    <a href="tel:88124094991" class="contacts__item">
                        <span class="fa fa-phone contacts__ico contacts__ico_phone"></span>
                        8 (812) 409-49-91
                    </a>
                </div>

                <div class="contacts__socials">
                    <div class="socials">
                        <a href="https://vk.com/svetimuzika" class="socials__link" target="_blank">
                            <i class="fa fa-vk"></i>
                        </a>
                        <a href="https://www.facebook.com/svetimuzika/" class="socials__link" target="_blank">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="https://www.instagram.com/svetimuzika/" class="socials__link" target="_blank">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
        <div id="map" class="contacts__map"></div>
    </section>

<?php
include('part/footer.php');
?>