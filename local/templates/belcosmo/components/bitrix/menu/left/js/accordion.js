/**
 * Created by work on 22.06.2015.
 */

$(document).ready(function(){
    // создаем стрелочку вниз
    var strBottom = $('<span/>',{
        'class': 'glyphicon glyphicon-triangle-bottom'
    });

    // создаем стрелочку вверх
    var strTop = $('<span/>',{
        'class': 'glyphicon glyphicon-triangle-top'
    });

    // устанавливаем стрелочку при начальной загрузке страницы при открытом пункте меню
    var el = $('#accordion ul > li').filter(':first');
    el.find('.glyphicon').remove();
    el.find('> a').after(strTop);


    // при первой загрузке скрываем все пункты меню кроме первого
    $('#accordion ul > li ul').click(function(event){
        event.stopPropagation();
    }).filter(':not(:first)').hide();



    // событие на клик по ссылке меню
    //$('#accordion ul > li').click(function(event){
    $('.inactive > a').click(function(event){
        console.log(this);
        // запрещаем переход по ссылке у родительской ссылки
        event.preventDefault();

        // true - эелемент меню свернут, false - элемент меню развернут
        //var selfClick = $(this).find('ul:first').is(':visible');
        var selfClick = $(this).siblings('ul').is(':visible');
        console.log(selfClick);
        // скроем развернутый сейчас элемент, если только этот элемент не тот, на который кликнули (selfClick)
        if (!selfClick){
            var elVis = $(this)
                .parent()
                .parent()
                .find(' > li ul:visible');
            console.log(elVis);
            elVis.slideToggle();// удаляем у развернутого элемента строку вверх
            elVis.parent().find('.glyphicon').remove();

            // добавляем к развернотому элементу стрелку вниз
            elVis.parent().find('> a').after(strBottom);

            // удаляем стрелочку вниз у текущего
            $(this).parent().find('.glyphicon').remove();

            // добавляем стрелочку вверх у текущего(метод clone() нужен чтобы не осуществлялось переноса элемента)
            $(this).parent().find('> a').after(strTop.clone());

        }
        else {
            // удаляем стрелочку вверх
            $(this).parent().find('.glyphicon').remove();
            // добавляем стрелочку вниз
            //strBottom.clone().insertAfter($(this).find('> a'));
            $(this).parent().find('.men').after(strBottom.clone());
        }

        $(this)
            .siblings('ul')
            // true-останавливает всю очередь анимации и true-эелемент принимает то состояние, которое он должен принять по завершении
            .stop(true, true)
            .slideToggle();
        /*
        if (!selfClick){
            var elVis = $(this)
                .parent()
                .find(' > li ul:visible');
            elVis.slideToggle();



        // переключаем состояние пункта, на который нажали: сворачиваем его. Если он открыт, и разворачиваем, если скрыт
        $(this)
                .find('ul:first')
                // true-останавливает всю очередь анимации и true-эелемент принимает то состояние, которое он должен принять по завершении
                .stop(true, true)
                .slideToggle();
         */
    });
});

