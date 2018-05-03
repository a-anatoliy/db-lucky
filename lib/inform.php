<?php

/**
 * Created by PhpStorm.
 * User: Tolya
 * Date: 18.02.2018
 * Time: 14:04
 */

/**
 * Class Mail
 <?php
    $mail = new Mail("no-reply@mysite.ru"); // Создаём экземпляр класса
    $mail->setFromName("Иван Иванов"); // Устанавливаем имя в обратном адресе
    if ($mail->send("abc@mail.ru", "Тестирование", "Тестирование<br /><b>письма<b>")) echo "Письмо отправлено";
    else echo "Письмо не отправлено";
 ?>
 */

class Mail {

    private $from;
    private $from_name = "";
    private $type = "text/html";
    private $encoding = "utf-8";
    private $notify = false;

    /* Конструктор принимающий обратный e-mail адрес */
    public function __construct($from) { $this->from = $from; }

    /* Изменение обратного e-mail адреса */
    public function setFrom($from) { $this->from = $from; }

    /* Изменение имени в обратном адресе */
    public function setFromName($from_name) { $this->from_name = $from_name; }

    /* Изменение типа содержимого письма */
    public function setType($type) { $this->type = $type; }

    /* Нужно ли запрашивать подтверждение письма */
    public function setNotify($notify) { $this->notify = $notify; }

    /* Изменение кодировки письма */
    public function setEncoding($encoding) { $this->encoding = $encoding; }

    /* Метод отправки письма */
    public function send($to, $subject, $message) {
        $from = "=?utf-8?B?".base64_encode($this->from_name)."?="." <".$this->from.">"; // Кодируем обратный адрес (во избежание проблем с кодировкой)

        $headers = "From: ".$from."\r\nReply-To: ".$from."\r\nContent-type: ".$this->type."; charset=".$this->encoding."\r\n"; // Устанавливаем необходимые заголовки письма

        if ($this->notify) $headers .= "Disposition-Notification-To: ".$this->from."\r\n"; // Добавляем запрос подтверждения получения письма, если требуется
        $subject = "=?utf-8?B?".base64_encode($subject)."?="; // Кодируем тему (во избежание проблем с кодировкой)

        // creating the message body
        $msg  = "<html><body style='font-family:Arial,sans-serif;'>";
        $msg .= "<h2 style='font-weight:bold;border-bottom:1px dotted #ccc;'>Cообщение с сайта</h2>\r\n";
        $msg .= "<p><strong>От:</strong> ".$username."</p>\r\n";
        $msg .= "<p><strong>Почта:</strong> ".$usermail."</p>\r\n";
        $msg .= "<p><strong>Phone number:</strong> ".$usertel."</p>\r\n\n";
        $msg .= $message;
        $msg .= "</body></html>";

        return mail($to, $subject, $message, $headers); // Отправляем письмо и возвращаем результат
    }

}


