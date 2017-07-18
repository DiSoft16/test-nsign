/**
 * Created by vaio_b970 on 01.07.2017.
 */

// Dependend dropdown for ingredients
$("#dish-ingredient_2nd").depdrop({
    depends: ['dish-ingredient_1st'],
    language: 'ru',
    url: '/dish/ingredient-lists'
});

$("#dish-ingredient_3rd").depdrop({
    depends: ['dish-ingredient_2nd'],
    language: 'ru',
    url: '/dish/ingredient-lists'
});

$("#dish-ingredient_4th").depdrop({
    depends: ['dish-ingredient_3rd'],
    language: 'ru',
    url: '/dish/ingredient-lists'
});

$("#dish-ingredient_5th").depdrop({
    depends: ['dish-ingredient_4th'],
    language: 'ru',
    url: '/dish/ingredient-lists'
});

// подключение для просмотра промо
$(document).ready(function () {
    $("a.fancyimage").fancybox(
        {
            openEffect: 'elastic',
            closeEffect: 'elastic'
        }
    );
});


$('#form-filter_dish').on('beforeSubmit', function (e) {
    var form = $(this);
    var formData = form.serialize();
    $.ajax({
        url: form.attr("action"),
        type: form.attr("method"),
        data: formData,
        success: function (dataJSON) {
            //dataArray = dataJSON != "" ? $.parseJSON(dataJSON) : {};
           // alert(dataJSON);
           // $('#publishreviewform-description').summernote('reset'); // reset summernote
            document.getElementById("form-filter_dish").reset();
        },
        error: function () {
            //alert(formData);
        }
    });
}).on('submit', function (e) {
    e.preventDefault();
});