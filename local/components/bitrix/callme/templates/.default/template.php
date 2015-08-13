<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 24.06.2015
 * Time: 21:41
 */
?>
<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?></p>
<h2>Элементы инфоблока</h2>
<?// foreach($arResult as $res): ?>
<!--    <div>Название: --><?//=$res['NAME']?><!--</div>-->
<!--    <div>Детальное описание: --><?//=$res['DETAIL_TEXT']?><!--</div>-->
<a class="click">Заказать обратный звонок</a>


<script>
$( document ).ready(function() {

    /**
     *  показ popup окна
     */
    var obj = {};
    obj['url'] = {
        0: {
            "url": <?php echo "'".$this->GetFolder()."'"?>+'/formCallback/formCallback.php',
            "type": 'tpl'
        }
    };
    // элемент на который вешаеться событие вызова popup
    obj['el'] = jQuery('.click');
    // title popup окна
    obj['title'] = obj['el'].text();

    var ObjShowDialog = new showDialog(obj['el'],obj['url'],obj['title'],'400px');

    ObjShowDialog.afterSubmit = function(){

        //вызов js валидатора
        var valObj = new FormValidate(
            'formCallme',
            'bootstrap',
            <?php echo "'".$this->GetFolder()."'"?>+'/controller.php',
            true
        );
        valObj.success = function(res)
        {
            if (res.IS_SUCCESS == 1)
            {
                $('#formCallme').remove();
                $("<span/>", {
                    text: "Спасибо, ваша заявка принята!Менеджер свяжеться с Вами в близжайшее время.",
                }).css({
                    'margin' : '20px',
                    'display': 'block'
                }).appendTo("#modal");
                setTimeout(function() {
                    ObjShowDialog.close();
                }, 1000);
            }
        }

    };

});

</script>