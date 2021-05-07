
       // $(document).ready(function(){
            $('.footer_submit').click(function(event)
            {
                // собираем данные с формы
                event.preventDefault();
                var tel    = $('.footer_tell').val();
                var smeta   = $('.footer_textarea').val();
                var name    = $('.footer_name').val();
                var files = $('.form_file').files;
                // отправляем данные
                $.ajax
                ({
                    url: "form.php", // куда отправляем
                    type: "post", // метод передачи
                    dataType: "json", // тип передачи данных
                    data: { // что отправляем
                        "tel":      tel,
                        "smeta":    smeta,
                        "name":     name,
                        "files":     files,
                    },
                    // после получения ответа сервера
                    success: function(data)
                    {   
                        if(data.result == 'true'){
                               console.log("true");
                                $('.mod-window').css('display','flex');
                                $('p.text').text(name + " ваша заявка принята!" + "Свяжемся с вами по номеру: " + tel);
                                $('.footer_textarea').val(''); //Очищаем поле сметы
                                $('.footer_tell').val(''); //Очищаем поле телефон
                                $('.footer_name').val(''); //Очищаем поле телефон
                        }
                        if(data.result == 'false'){
                            console.log("false");
                            $('.mod-window').css('display','flex');
                            $('p.text').text(name + " ваша заявка принята!" + "Свяжемся с вами по номеру: " + tel);
                            $('.footer_textarea').val(''); //Очищаем поле сметы
                            $('.footer_tell').val(''); //Очищаем поле телефон
                            $('.footer_name').val(''); //Очищаем поле телефон
                    }
                    }
                });
            });
            $('.close').click(function(event){
                event.preventDefault();
                $('.mod-window').css('display','none')
            });

           
        //});
  