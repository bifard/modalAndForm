
<?php
    $msg_box = ""; // в этой переменной будем хранить сообщения формы
    $errors = array(); // контейнер для ошибок
    
    // проверяем корректность полей
    if($_POST['tel'] == "")    $errors[] = "Поле 'Ваше имя' не заполнено!";
    if($_POST['name'] == "")   $errors[] = "Поле 'Ваш e-mail' не заполнено!";

    if (!empty($_FILES['file']['tmp_name'])) { 
        $path = $_SERVER['DOCUMENT_ROOT']."/upload/".$_FILES['file']['name']; 
        if (copy($_FILES['file']['tmp_name'], $path)){ 
            $myFaile = $path; 
            $file_name = $_FILES['file']['name'];
        }
    } 
 
    // если форма без ошибок
    if(empty($errors)){     
        // собираем данные из формы
        $message  = "Номер: " . $_POST['tel'] . "<br/>";
        $message .= "Имя: " . $_POST['name'] . "<br/>";    
        $message .= "Данные для сметы: " . $_POST['smeta'] . "<br/>";    
        send_mail($message); // отправим письмо
        // выведем сообщение об успехе
        $msg_box = "true"; //"<span style='color: green;'>Сообщение успешно отправлено!</span>";
        
    }else{
        // если были ошибки, то выводим их
        $msg_box = "";
        foreach($errors as $one_error){
            $msg_box .= "false";   //"<span style='color: red;'>$one_error</span><br/>";
            
        }
    }
 
    // делаем ответ на клиентскую часть в формате JSON
    echo json_encode(array('result' => $msg_box));
    
     
     
    // функция отправки письма
    function send_mail($message){
        // почта, на которую придет письмо
        $mail_to = "leks11172@mail.ru"; 
        // тема письма
        $subject = "Письмо с обратной связи";
         
        // заголовок письма
        $headers= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
        $headers .= "From: Тестовое письмо <info@shri.fun>\r\n"; // от кого письмо
         
        // отправляем письмо 
        mail($mail_to, $subject, $message, $headers);
    }
     
?>
