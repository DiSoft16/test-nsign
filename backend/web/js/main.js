/**
 * Created by vaio_b970 on 01.07.2017.
 */

// подключение для просмотра промо
$(document).ready(function () {
    $("a.fancyimage").fancybox(
        {
            openEffect: 'elastic',
            closeEffect: 'elastic'
        }
    );
});

// виджет поля загрузки файла
$("#input_file").fileinput({
    allowedFileExtensions: ["png", "JPG", "jpg", "jpeg", "gif"],
    maxFileCount: 1,
    language: "ru",
    elErrorContainer: "#errorBlock"
});