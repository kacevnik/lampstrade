<?php

$adminEmail = 'kacevnik@yandex.ru';

function upload()
{
    $uploaddir = './images/uploads/';
    $uploadfile = $uploaddir . basename($_FILES['uploadfile']['name']);
// Копируем файл из каталога для временного хранения файлов:
    if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile)) {
        echo "<h3>Файл успешно загружен на сервер</h3>";
    } else {
        echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['send'])) {
        $form = $_POST['send']['form'];
        if (isset($_POST['utm'])) {
            $utm = $_POST['utm'];
        }
        switch ($form) {
            case 'give-price' :
                $array = $_POST['send'];
                $path = __DIR__ . "/files/PriceLAMPSTRADE.xlsx";
                send_price($array, $path, $adminEmail);
                break;

            case 'consultation':
                $array = $_POST['send'];
                send_first($array, $utm, $adminEmail);
                break;

            case 'popup-to-us':
                $array = $_POST['send'];
                send_first($array, $utm, $adminEmail);
                break;

            case 'one-click':
                $array = $_POST['send'];
                send_first($array, $utm, $adminEmail);
                break;

            case 'product':
                $array = $_POST['send'];
                send_second($array, $utm, $adminEmail);
                break;

            case 'stocks':
                $array = $_POST['send'];
                $path = __DIR__ . "/files/akcionn_price.pdf";
                send_price($array, $path, $adminEmail);
                break;

            case 'rare':
                $array = $_POST['send'];
                send_first($array, $utm, $adminEmail);
                break;

            case 'counter':
                $array = $_POST['send'];
                send_first($array, $utm, $adminEmail);
                break;

            case 'tz':
                $array = $_POST['send'];
                send_first($array, $utm, $adminEmail);
                break;

            case 'approve':
                $array = $_POST['send'];
                send_first($array, $utm, $adminEmail);
                break;

            case 'delivery':
                $array = $_POST['send'];
                send_first($array, $utm, $adminEmail);
                break;
        }
    }
}


function send_first($array, $utm, $adminEmail)
{
    require 'PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.mail.ru';                         // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'zhk.veneciya@mail.ru';             // SMTP username
    $mail->Password = 'Z9564665z';                        // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->setFrom('zhk.veneciya@mail.ru', 'Лампы');
    $mail->addAddress($adminEmail, $adminEmail);          // Add a recipient

    $mail->isHTML(true);                           // Set email format to HTML

//    $to = 'sale@lampstrade.ru';
//    $headers = 'From: Лампы<idntity@lampsTrade.com>' . "\r\n";
//    $headers .= 'MIME-Version: 1.0' . "\r\n";
//    $headers .= 'Content-type: text/html; charset=utf-8';
      $subject = 'Заявка с сайта Lamps-trade:';

    $message = '<div class="container" style="position: relative;margin: 0 auto;padding: 78px 90px;max-width: 730px;background: #fff;color: #333;">
<div class="popup__header" style="    margin-bottom: 30px;background: rgba(153, 153, 153, 0.1);;font-size: 27px;line-height: 1.33333333;font-family: \'Roboto Condensed\', sans-serif;letter-spacing: -1px;text-align: center;">
		<a href="" class="logo" style="    display: inline-block;align-items: center;padding-bottom: 6px;color: #333;">
		<img src="http://dev.borodaboroda.com/lamps-trade/images/logo.png" alt="" class="logo__img">
						<span class="logo__text">
							lamps<span class="logo__b" style="font-weight: bold;">trade</span>
						</span>
					</a> <a style="display: inline-block;padding-top: 4px;width: 100%;">
		' . $array['title'] . '</a>
	</div>
<div class="popup__content" style="margin: 0 auto;width: 100%;max-width: 360px;">
		<div class="form js-form-send">
			<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>Имя *: </b>  ' . $array['name'] . '
				</div>
			</div>
			<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>Телефон *:</b>  ' . $array['phone'] . '
				 </div>
			</div>
			<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>E-mail :</b>  ' . $array['mail'] . '
				</div>
			</div>
			</div>';
    if (isset($array['message'])) {
        $message .= '<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>Ваше сообщение:</b>  ' . $array['message'] . '
				</div>
			</div>';
    }
    if (isset($array['subtext'])) {
        $message .= '<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>Ваше заказ:</b>  ' . $array['subtext'] . '
				</div>
			</div>';
    }
    if (isset($array['subtext'])) {
        $message .= '<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>Ваше заказ:</b>  ' . $array['subtext'] . '
				</div>
			</div>';
    }
    if (isset($utm)) {
        $message .= '<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>utm_campaign:</b>  ' . $utm['utm_campaign'] . '<br>
					<b>utm_source:</b>  ' . $utm['utm_source'] . '<br>
					<b>utm_term:</b>  ' . $utm['utm_term'] . '<br>
					<b>utm_content:</b>  ' . $utm['utm_content'] . '<br>
				</div>
			</div>';
    }
    $message .= '</div>
	</div></div>';

    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();


    //mail($to, $subject, $message, $headers);
}

function send_second($array, $utm, $adminEmail)
{

    require 'PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.mail.ru';                         // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'zhk.veneciya@mail.ru';             // SMTP username
    $mail->Password = 'Z9564665z';                        // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->setFrom('zhk.veneciya@mail.ru', 'Лампы');
    $mail->addAddress($adminEmail, $adminEmail);          // Add a recipient

    $mail->isHTML(true);                           // Set email format to HTML

//    $to = 'sale@lampstrade.ru';
//    $headers = 'From: Лампы<idntity@lampsTrade.com>' . "\r\n";
//    $headers .= 'MIME-Version: 1.0' . "\r\n";
//    $headers .= 'Content-type: text/html; charset=utf-8';
      $subject = 'Заявка с сайта Lamps-trade:';


    $message = '<div class="container" style="position: relative;margin: 0 auto;padding: 78px 90px;max-width: 730px;background: #fff;color: #333;">
<div class="popup__header" style="    margin-bottom: 30px;background: rgba(153, 153, 153, 0.1);;font-size: 27px;line-height: 1.33333333;font-family: \'Roboto Condensed\', sans-serif;letter-spacing: -1px;text-align: center;">
		<a href="" class="logo" style="    display: inline-block;align-items: center;padding-bottom: 6px;color: #333;">
		<img src="http://dev.borodaboroda.com/lamps-trade/images/logo.png" alt="" class="logo__img">
						<span class="logo__text">
							lamps<span class="logo__b" style="font-weight: bold;">trade</span>
						</span>
					</a> <a style="display: inline-block;padding-top: 4px;width: 100%;">
		' . $array['title'] . '</a>
	</div>';

    $message .= '<div class="popup__content" style="margin: 0 auto;width: 100%;max-width: 360px;">
                <div class="product__image" style="display: flex;align-items: center;margin-bottom: 10px;height: 212px">
                                <img src="http://dev.borodaboroda.com/lamps-trade/' . $array['product__image'] . '" alt="" class="product__img" style="margin: 0 auto;">
                            </div>
                            <div class="product__title" style="    margin-bottom: 13px;color: #333; font-weight: bold;font-size: 18px;font-family: \'Roboto Condensed\', sans-serif;text-align: center;text-transform: uppercase;">' . $array['product__title'] . '</div>
                            <div class="product__description" style="    margin-bottom: 18px;text-align: center;letter-spacing: 0.4px;">' . $array['product__description'] . '</div>
</div>';

    $message .= '<div class="popup__content" style="margin: 0 auto;width: 100%;max-width: 360px;">
		<div class="form js-form-send">
			<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>Имя *: </b>  ' . $array['name'] . '
				</div>
			</div>
			<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>Телефон *:</b>  ' . $array['phone'] . '
				 </div>
			</div>
			<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>E-mail :</b>  ' . $array['mail'] . '
				</div>
			</div>
			</div>';
    if (isset($utm)) {
        $message .= '<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>utm_campaign:</b>  ' . $utm['utm_campaign'] . '<br>
					<b>utm_source:</b>  ' . $utm['utm_source'] . '<br>
					<b>utm_term:</b>  ' . $utm['utm_term'] . '<br>
					<b>utm_content:</b>  ' . $utm['utm_content'] . '<br>
				</div>
			</div>';
    }
    $message .= '</div>
	</div></div>';

    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();

    //mail($to, $subject, $message, $headers);
}


function send_price($array, $path, $adminEmail)
{
    $to = $array['mail'];
//    $boundary = "--" . md5(uniqid(time()));
//    $headers = 'From: Лампы<idntity@lampsTrade.com>' . "\r\n";
//    $headers .= 'MIME-Version: 1.0' . "\r\n";
//    $headers .= "Content-Type: multipart/alternative; boundary=\"$boundary\"\n";
    $subject = 'Письмо Lamps-trade:';
//    $kod = 'windows-1251'; // или $kod = 'windows-1251';

    require 'PHPMailer/PHPMailerAutoload.php';

    $mail = new PHPMailer;
    $mail->CharSet = 'UTF-8';
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.mail.ru';                         // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'zhk.veneciya@mail.ru';             // SMTP username
    $mail->Password = 'Z9564665z';                        // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->setFrom('zhk.veneciya@mail.ru', 'Лампы');
    $mail->addAddress($to, $to);          // Add a recipient

    $mail->isHTML(true);

    $message = '<div class="container" style="position: relative;margin: 0 auto;padding: 78px 90px;max-width: 730px;background: #fff;color: #333;">
<div class="popup__header" style="    margin-bottom: 30px;background: rgba(153, 153, 153, 0.1);;font-size: 27px;line-height: 1.33333333;font-family: \'Roboto Condensed\', sans-serif;letter-spacing: -1px;text-align: center;">
		<a href="" class="logo" style="    display: inline-block;align-items: center;padding-bottom: 6px;color: #333;">
		<img src="http://dev.borodaboroda.com/lamps-trade/images/logo.png" alt="" class="logo__img">
						<span class="logo__text">
							lamps<span class="logo__b" style="font-weight: bold;">trade</span>
						</span>
					</a> <a style="display: inline-block;padding-top: 4px;width: 100%;">
		' . $array['title'] . '</a>
	</div>
<div class="popup__content" style="margin: 0 auto;width: 100%;max-width: 360px;">
		<div class="form js-form-send">
			<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>Здравствуйте *: </b>  ' . $array['name'] . '
				</div>
			</div>
			</div>';
    $message .= '</div></div>';

    $mail->addAttachment($path);

//    $fp = fopen($path, "r");
//    if (!$fp) {
//        print "Файл $path не может быть прочитан";
//        exit();
//    }
//    $file = fread($fp, filesize($path));
//    fclose($fp);
//
//    $multipart = "--$boundary\n";
//    $multipart .= "Content-Type: text/html; charset=utf-8";
//    $multipart .= "Content-Transfer-Encoding: Quot-Printed\n\n";
//    $multipart .= "$message\n\n";
//
//    $message_part = "--$boundary\n";
//    $message_part .= "Content-Type: application/octet-stream\n";
//    $message_part .= "Content-Transfer-Encoding: base64\n";
//    $message_part .= "Content-Disposition: attachment; filename = \"" . $path . "\"\n\n";
//    $message_part .= chunk_split(base64_encode($file)) . "\n";
//    $multipart .= $message_part . "--$boundary--\n";

    $mail->Subject = $subject;
    $mail->Body    = $message;

    $mail->send();

    $message = '';

    $mail2 = new PHPMailer;
    $mail2->CharSet = 'UTF-8';
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail2->isSMTP();                                      // Set mailer to use SMTP
    $mail2->Host = 'smtp.mail.ru';                         // Specify main and backup SMTP servers
    $mail2->SMTPAuth = true;                               // Enable SMTP authentication
    $mail2->Username = 'zhk.veneciya@mail.ru';             // SMTP username
    $mail2->Password = 'Z9564665z';                        // SMTP password
    $mail2->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail2->Port = 465;                                    // TCP port to connect to

    $mail2->setFrom('zhk.veneciya@mail.ru', 'Лампы');
    $mail2->addAddress($adminEmail, $adminEmail);          // Add a recipient

    $mail2->isHTML(true);

    $subject = 'Заявка с сайта Lamps-trade:';

    $message = '<div class="container" style="position: relative;margin: 0 auto;padding: 78px 90px;max-width: 730px;background: #fff;color: #333;">
<div class="popup__header" style="    margin-bottom: 30px;background: rgba(153, 153, 153, 0.1);;font-size: 27px;line-height: 1.33333333;font-family: \'Roboto Condensed\', sans-serif;letter-spacing: -1px;text-align: center;">
		<a href="" class="logo" style="    display: inline-block;align-items: center;padding-bottom: 6px;color: #333;">
		<img src="http://dev.borodaboroda.com/lamps-trade/images/logo.png" alt="" class="logo__img">
						<span class="logo__text">
							lamps<span class="logo__b" style="font-weight: bold;">trade</span>
						</span>
					</a> <a style="display: inline-block;padding-top: 4px;width: 100%;">
		' . $array['title'] . '</a>
	</div>
<div class="popup__content" style="margin: 0 auto;width: 100%;max-width: 360px;">
		<div class="form js-form-send">
			<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>Имя *: </b>  ' . $array['name'] . '
				</div>
			</div>
			<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>Телефон *:</b>  ' . $array['phone'] . '
				 </div>
			</div>
			<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>E-mail :</b>  ' . $array['mail'] . '
				</div>
			</div>
			</div>';
    if (isset($array['message'])) {
        $message .= '<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>Ваше сообщение:</b>  ' . $array['message'] . '
				</div>
			</div>';
    }
    if (isset($array['subtext'])) {
        $message .= '<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>Ваше заказ:</b>  ' . $array['subtext'] . '
				</div>
			</div>';
    }
    if (isset($array['subtext'])) {
        $message .= '<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>Ваше заказ:</b>  ' . $array['subtext'] . '
				</div>
			</div>';
    }
    if (isset($utm)) {
        $message .= '<div class="form__line" style="display: flex;flex-flow: row wrap;flex-grow: 1;position: relative;margin: 0 -5px 10px;width: 100%;">
				<div class="form__field" style="    display: block;flex-grow: 1;padding: 15px 5px;width: 100%;border: 1px solid #e6e6e6;">
					<b>utm_campaign:</b>  ' . $utm['utm_campaign'] . '<br>
					<b>utm_source:</b>  ' . $utm['utm_source'] . '<br>
					<b>utm_term:</b>  ' . $utm['utm_term'] . '<br>
					<b>utm_content:</b>  ' . $utm['utm_content'] . '<br>
				</div>
			</div>';
    }
    $message .= '</div>
	</div></div>';

    $mail2->Subject = $subject;
    $mail2->Body    = $message;

    $mail2->send();

    //mail($to, $subject, $multipart, $headers);
}