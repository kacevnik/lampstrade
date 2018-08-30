$(function () {
    // сдвиг шапки при прокрутке
    // 				           - [all]
    function pagerScroll() {
        var t = $(window).scrollTop();
        var promo = $('.promo').offset().top + $('.promo').outerHeight() - 50;

        if (t > promo) {
            $('.header').addClass('header_smaller');
        }
        else {
            $('.header').removeClass('header_smaller');
        }
    }

    $(window).scroll(function () {
        pagerScroll();
    });
    pagerScroll();

    // Открытие модальных окон
    // 						 - [all]
    $('.js-popup').magnificPopup({
        type: 'inline',
        midClick: true,
        closeMarkup: '<button title="%title%" type="button" class="mfp-close mfp-close_orange"><i class="fa fa-close"></i></button>',
        closeOnBgClick: false,
        mainClass: 'mfp-fade',
        removalDelay: 300,
    });
    // $('.js-popup[href="#opinion_2"]').click();
    // $('.js-popup[href="#places"]').click();
    // $('.js-popup[href="#give-price"]').click();
    // $('.js-popup[href="#consultation"]').click();
    // $('.js-popup[href="#to-us"]').click();
    // $('.js-popup[href="#order"]').click();
    // $('.js-popup[href="#stocks"]').click();
    // $('.js-popup[href="#counter"]').click();
    // $('.js-popup[href="#tz"]').click();
    // $('.js-popup[href="#approve"]').click();
    // $('.js-popup[href="#delivery"]').click();

    // Открытие модальных окон из форм
    // 						 		 - index
    $('.js-form-popup').submit(function (e) {
        e.preventDefault();
        var action = $(this).attr('action');
        $.magnificPopup.open({
            type: 'inline',
            items: {
                src: action
            },
            closeMarkup: '<button title="%title%" type="button" class="mfp-close mfp-close_orange"><i class="fa fa-close"></i></button>',
            closeOnBgClick: false,
            mainClass: 'mfp-fade',
            removalDelay: 300,
        });
    });
    // $('.js-form-popup[action="#one-click"]').submit();
    // $('.js-form-popup[action="#rare"]').submit();

    // правила валидации
    var req_rules = {
        name: /^.+$/,
        phone: /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/,
        mail: /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i,
        message: /^.+$/,
    }
    // отправка формы и показ благодарности
    // 						 		      - index
    $('.js-form-send').submit(function (e) {
        e.preventDefault();

        var form = $(this);

        form.find('*[data-req]').each(function () {
            var name = $(this).attr('name'),
                value = $(this).val(),
                line = $(this).closest('.form__field');
            if (req_rules[name].test(value)) {
                line.removeClass('form__field_invalid');
            }
            else {
                line.addClass('form__field_invalid');
            }
        });

        if (form.find('.form__field_invalid').length) {
            if (window.innerWidth <= 768) {
                $('html, body').animate({
                    scrollTop: $('.form__field_invalid:eq(0)').offset().top - 10,
                }, 300);
            }
        }
        else {
            var $data = {};
            form.find('input, textarea, select').each(function () {
                $data[this.name] = $(this).val();
            });
            var $utm = {};
            $('#utm').find('input').each(function () {
                $utm[this.name] = $(this).val();
            });
            $.post(
                'sender.php', {
                    send: $data,
                    utm:$utm,
                },
                function (result) {
                    if (result == 'success') {

                    }
                }, 'text'
            );


            if (form.hasClass('js-form-counter')) {
                counter_start();
            }

            // показываем модальное окно "спасибо"
            $.magnificPopup.open({
                type: 'inline',
                items: {
                    src: '#thanks'
                },
                closeMarkup: '<button title="%title%" type="button" class="mfp-close mfp-close_orange"><i class="fa fa-close"></i></button>',
                closeOnBgClick: false,
                mainClass: 'mfp-fade',
                removalDelay: 300,
            });
        }
    });

    $('.js-form-send').on('change', '.form__field_invalid *[data-req]', function () {
        var name = $(this).attr('name'),
            value = $(this).val(),
            line = $(this).closest('.form__field');
        if (req_rules[name].test(value)) {
            line.removeClass('form__field_invalid');
        }
    });

    jQuery.fn.exists = function () {
        return $(this).length;
    }

    //upload image

    $('.buy').on('click', function () {
        var id = $(this).attr('href');
        console.log(id);

        var product_img = $(this).parent().find('.product__image img').attr('src');
        var product_name = $(this).parent().find('.product__title').text();
        var product_desc = $(this).parent().find('.product__description').text();

        if ($(id).find('form input[name="product__image"] , input[name="product__title"], input[name="product__description"]').exists()) {
            $(id).find('form input[name="product__image"]').val(product_img);
            $(id).find('form input[name="product__title"]').val(product_name);
            $(id).find('form input[name="product__description"]').val(product_desc);
        } else {
            $(id).find('form').append('<input type="hidden" name="product__image" value="' + product_img + '">');
            $(id).find('form').append('<input type="hidden" name="product__title" value="' + product_name + '">');
            $(id).find('form').append('<input type="hidden" name="product__description" value="' + product_desc + '">');
        }


    });


    $('.upload').submit(function (e) {
        e.preventDefault();
        var text = $(this).find('textarea').val();
        var id = $(this).attr('action');
        if (text !== '') {
            $(id).find('form').append('<input type="hidden" name="subtext" value="' + text + '">')
        }
    });


    // валидация формы при вводе
    // 							 - [all]
    $('.js-form-send').on('change', '.form__field_invalid *[data-req]', function () {
        var name = $(this).attr('name'),
            value = $(this).val(),
            line = $(this).closest('.form__field');
        if (req_rules[name].test(value)) {
            line.removeClass('form__field_invalid');
        }
    });

    // запуск счетчика
    // 						 		 - index
    var timer;

    function counter_start() {
        timer = setInterval(function () {
            var str = $('.js-timer').text().split(':');
            var h = Number(str[0]),
                m = Number(str[1]),
                s = Number(str[2]);
            s--;
            if (s < 0) {
                s = 59;
                m--;
            }
            if (m < 0 && s == 59) {
                m = 59
                h--;
            }
            if (h < 0 && m == 59) {
                h = 23;
                d--;
            }

            if (h < 10) {
                h = '0' + h;
            }
            if (m < 10) {
                m = '0' + m;
            }
            if (s < 10) {
                s = '0' + s;
            }
            str = [h, m, s];
            $('.js-timer').text(str.join(':'));
        }, 1000);
    }

    $('.js-popup[href="#counter"]').click(function () {
        if ($('.js-timer').text() == '01:00:00') {
            $('.js-timer').text('00:59:59');
        }
    });

    // Открытие модальных сертификатов
    // 						         - [all]
    $('.js-scroll').click(function (e) {
        e.preventDefault();
        var to = $($(this).attr('href')).offset().top;
        $('html, body').animate({
            scrollTop: to
        }, 1000);
    });

    // Открытие модальных сертификатов
    // 						         - [all]
    $('.js-sertificate').magnificPopup({
        type: 'inline',
        midClick: true,
        closeMarkup: '<button title="%title%" type="button" class="mfp-close mfp-close_orange"><i class="fa fa-close"></i></button>',
        closeOnBgClick: false,
        mainClass: 'mfp-fade',
        removalDelay: 300,
    });
    // $('.js-sertificate').eq(0).click();

    // стилизация элементов форм
    // 						   - [all]
    $('input[type="file"]').styler();

    // Открытие / закрытие мобильного меню
    // 									 - [all]
    $('.js-burger, .js-context .context__overlay').click(function () {
        if (!$('.context__content').hasClass('context__content_open')) {
            $('.context__content').addClass('context__content_open');
            $('.context__overlay').addClass('context__overlay_open');
            $('html').addClass('no-scroll');
        }
        else {
            $('.context__content').removeClass('context__content_open');
            $('.context__overlay').removeClass('context__overlay_open');
            $('html').removeClass('no-scroll');
        }
    });

    // слайдер акций
    //             - главная
    var owlStocks = $('.js-stocks');
    owlStocks.owlCarousel({
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            992: {
                items: 3,
            },
        },
        loop: true,
        smartSpeed: 900,
        slideBy: 1,
        nav: true,
        navContainerClass: 'owl-nav',
        navText: [
            '<i class="fa fa-angle-left owl-nav__ico"></i>',
            '<i class="fa fa-angle-right owl-nav__ico"></i>'
        ],
        dots: false,
    });

    // слайдер клиентов
    //             - главная
    var owlClients = $('.js-clients');
    owlClients.owlCarousel({
        responsive: {
            0: {
                items: 2,
            },
            420: {
                items: 3,
            },
            768: {
                items: 4,
            },
            992: {
                items: 6,
            },
        },
        loop: true,
        smartSpeed: 1000,
        slideBy: 1,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 1500,
        autoplayHoverPause: false,
    });
    owlClients.on('mouseenter', function(e) {
        $(this).trigger('stop.owl.autoplay');
    });
    owlClients.on('mouseleave', function(e) {
        $(this).trigger('play.owl.autoplay');
    });
    owlClients.find('.js-popup').click(function (e) {
        if($(this).parent().hasClass('cloned')) {
            owlClients.find('.js-popup[href="'+ $(this).attr('href') +'"]').each(function () {
                if(!$(this).parent().hasClass('cloned')) {
                    $(this).click();
                    return false;
                }
            });
            e.preventDefault();
        }
    });

    // слайдер сертификатов
    //                    - главная
    var owlSertificates = $('.js-sertificate-gallery');
    owlSertificates.owlCarousel({
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 2,
            },
            992: {
                items: 3,
                center: true,
            },
        },
        items: 3,
        loop: true,
        smartSpeed: 500,
        slideBy: 1,
        nav: true,
        navContainerClass: 'owl-nav owl-nav_sertificates-line',
        navText: [
            '<i class="fa fa-angle-left owl-nav__ico"></i>',
            '<i class="fa fa-angle-right owl-nav__ico"></i>'
        ],
        dots: false,
    });

    // слайдер площадок
    //                - главная
    var owlPlaces = $('.js-places');
    owlPlaces.owlCarousel({
        responsive: {
            0: {
                items: 1,
                nav: false,
            },
            768: {
                items: 1,
                nav: true,
            },
            992: {
                items: 2,
                nav: true,
            },
        },
        loop: false,
        smartSpeed: 500,
        slideBy: 1,
        navContainerClass: 'owl-nav owl-nav_places',
        navText: [
            '<i class="fa fa-angle-left owl-nav__ico"></i>',
            '<i class="fa fa-angle-right owl-nav__ico"></i>'
        ],
        dots: true,
    });

    // Раскрытие/скрытие дополнительных элементов
    //                                          - медиа
    $('.js-parameters-toggle').click(function () {
        var obj = $(this).closest('.parameters').find('.parameters__hidden');
        if (!$(this).hasClass('parameters__toggle_show')) {
            $(this).addClass('parameters__toggle_show');
            obj.addClass('parameters__hidden_show');
        }
        else {
            $(this).removeClass('parameters__toggle_show');
            obj.removeClass('parameters__hidden_show');
        }
    });

    // добавление маски в текстовые поля
    // 								   - [all]
    $('input[type="tel"]').inputmask('+7 (999) 999 99 99', {
        clearMaskOnLostFocus: true,
    });

    // Прижатие подвала
    // 				  - [all]
    setTimeout(function () {
        var wind = $(window).innerHeight(),
            body = $('footer').offset().top + $('footer').outerHeight(true);
        if (body < wind) {
            $('.footer').addClass('footer_attached-bottom');
        }
    }, 100);

    // активация вкладок
    //                 - [all]
    $('.js-tabs').each(function () {
        var to = $(this).find('.tabs__title_active').index();
        $(this).find('.tabs__content').eq(to).addClass('tabs__content_active');
    });
    $('.js-tabs').find('.tabs__title').click(function (e) {
        e.preventDefault();
        if (!$(this).hasClass('tabs__title_active')) {
            var to = $(this).index(),
                obj = $(this).closest('.tabs');

            obj.find('.tabs__title_active').removeClass('tabs__title_active');
            $(this).addClass('tabs__title_active');

            obj.find('.tabs__content_active').removeClass('tabs__content_active');
            obj.find('.tabs__content').eq(to).addClass('tabs__content_active');
        }
    });

    // механизм навигации (прокрутка, (де)активизация)
    // 				                                 - [all]
    $('.js-nav__link').click(function (e) {
        var href = $(this).attr('href'),
            offsetTop = href === '#' ? 0 : $(href).offset().top;
        offsetTop -= 55;
        if (offsetTop < 0) {
            offsetTop = 0;
        }
        $('html, body').stop().animate({
            scrollTop: offsetTop
        }, 1000);
        e.preventDefault();

        $('.context__content').removeClass('context__content_open');
        $('.context__overlay').removeClass('context__overlay_open');
        $('html').removeClass('no-scroll');
    });

    // скроллинг через якоря ссылок
    // 				              - [all]
    $('.js-scroll-to').click(function (e) {
        var href = $(this).attr('href'),
            offsetTop = href === '#' ? 0 : $(href).offset().top;
        offsetTop -= 55;
        $('html, body').stop().animate({
            scrollTop: offsetTop
        }, 500);
        e.preventDefault();
    });

    var PH = 'Пример: 1. OSRAM 93729 HPL 750/230 - 6 шт\n2. GE T27 - 2 шт \n3. PAR-64 - 10 шт. \n4. Лампы для приборов robe spot 575 xt – 4 шт';
    $('textarea[data-placeholder]').val(PH).addClass('placeholder');
    $('textarea[data-placeholder]').focus(function () {
        if ($(this).val() == PH) {
            $(this).val('').removeClass('placeholder');
        }
    }).blur(function () {
        if ($(this).val() == '') {
            $(this).val(PH).addClass('placeholder');
        }
    });

    // скрытие уведомления об отправке
    if ($('.sender').length) {
        setTimeout(function () {
            $('.sender').fadeOut(500);
        }, 3000);
    }
});