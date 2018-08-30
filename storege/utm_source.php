<?php
// UTM работает только когда видит 4 запроса в url "?utm_campaign&utm_source&utm_term&utm_content"
// После, проверет по условию, чему равны эти параметры "?utm_campaign=test&utm_source=vk.com&utm_term&utm_content"
// если utm_campaign равен test и utm_source равен vk.com то выведет нужный заголовок, как показанно в "тестовом кейсе"
// В "тестовом кейсе" метод сравнения "и" "&&"
// так же возможно использовать метод сравнения "или" "||" как указанно в "тестовом кейсе или"
//
if (isset($_GET)) {
    var_dump($_GET);
    echo '<div id="utm" style="display: none">
            <input type="hidden" name="utm_campaign" value="' . $_GET['utm_campaign'] . '">
            <input type="hidden" name="utm_source" value="' . $_GET['utm_source'] . '">
            <input type="hidden" name="utm_term" value="' . $_GET['utm_term'] . '">
            <input type="hidden" name="utm_content" value="' . $_GET['utm_content'] . '">
            </div>';
//    услове проверки 4х запросов в url
    if (isset($_GET['utm_campaign']) && isset($_GET['utm_source']) && isset($_GET['utm_term']) && isset($_GET['utm_content'])) {
        $utm_campaign = $_GET['utm_campaign'];
        $utm_source = $_GET['utm_source'];
        $utm_term = $_GET['utm_term'];
        $utm_content = $_GET['utm_content'];
        switch (TRUE) {
//            Тестовый кейс
            case $utm_campaign === 'test' && $utm_source === 'vk.com' :
                $promo__title = 'Доставим вам лампы для любого концертного светового оборудования дешевле и быстрее конкурентов.';
                $promo__service = 'Любые лампы <br> для светового оборудования <br> для концертных площадок и театров';
                break;
//            Тестовый кейс или
            case $utm_campaign === 'test' || $utm_source === 'vk.com' :
                $promo__title = 'Доставим вам лампы для любого концертного светового оборудования дешевле и быстрее конкурентов.';
                $promo__service = 'Любые лампы <br> для светового оборудования <br> для концертных площадок и театров';
                break;
            /*---новые сюда V ---*/
            case $utm_campaign === 'test' && $utm_source === 'vk.com' && $utm_term ==='fb.com' :
                $promo__title = '!!Доставим вам лампы для любого концертного светового оборудования дешевле и быстрее конкурентов.';
                $promo__service = 'Любые лампы <br> для светового оборудования <br> для концертных площадок и театров';
                break;

            /*---новые сюда ^ ---*/

            default:
                $promo__title = 'Любые лампы <br> для светового оборудования <br> для концертных площадок и театров';
                $promo__service = 'Доставим вам лампы для любого концертного светового оборудования дешевле и быстрее конкурентов.';
                break;
        }
    }else{
        $promo__title = 'Любые лампы <br> для светового оборудования <br> для концертных площадок и театров';
        $promo__service = 'Доставим вам лампы для любого концертного светового оборудования дешевле и быстрее конкурентов.';
    }
} else {
    $promo__title = 'Любые лампы <br> для светового оборудования <br> для концертных площадок и театров';
    $promo__service = 'Доставим вам лампы для любого концертного светового оборудования дешевле и быстрее конкурентов.';
}

