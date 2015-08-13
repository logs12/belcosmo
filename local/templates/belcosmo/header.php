<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__); //чтобы данные файлы нельзя было вызвать напрямую из окна браузера
$curPage = $APPLICATION->GetCurPage(true);//захватываем адрес страницы где сейчас находимся
?>

<html>
<head>
    <?php CJSCore::Init(array("jqueryMy")); // подключение jQuery ?>
    <?php CJSCore::Init(array("bootstrap")); // подключение bootstrap ?>
    <?$APPLICATION->ShowHead();?>
    <title><?$APPLICATION->ShowTitle(false)?></title>
    <?$APPLICATION->ShowMeta("keywords") // ключевые слова?>
    <?$APPLICATION->ShowMeta("description") // описание SEO?>
</head>

<body>
    <div id="panel"><?$APPLICATION->ShowPanel();//подключение админ панели битрикса?></div>
    <?if($USER->IsAdmin()):?>
	<?endif?>

    <div class="wrapper">

        <header>
            <div class="container">
                <div id="zagolovok" class = "col-md-9">
                    Натуральная Белоруская бытовая химия и косметика оптом.
                </div>
                <div id="contakty" class = "col-md-3">
<!--                    <ul>-->
<!--                        <li></li>-->
<!--                        <li>8(950)-629-70-35</li>-->
<!--                    </ul>-->
<!--                    <a href="" class="">Заказать звонок</a>-->
                </div>
            </div>
        </header>
        <nav class="navbar navbar-default" >

            <?$APPLICATION->IncludeComponent(
                "bitrix:menu",
                "top",
                array(
                    "ROOT_MENU_TYPE" => "top",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "MENU_CACHE_GET_VARS" => array(
                    ),
                    "MAX_LEVEL" => "1",
                    "CHILD_MENU_TYPE" => "left",
                    "USE_EXT" => "N",
                    "DELAY" => "N",
                    "ALLOW_MULTI_SELECT" => "N"
                ),
                false
            );?>

        </nav>




        <div class="row container">

                <?$APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "left",
                    array(
                        "ROOT_MENU_TYPE" => "left",
                        "MENU_CACHE_TYPE" => "N",
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "MAX_LEVEL" => "3",
                        "CHILD_MENU_TYPE" => "left",
                        "USE_EXT" => "Y",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "IS_SEF" => "Y",
                        "SEF_BASE_URL" => "/catalog/",
                        "SECTION_PAGE_URL" => "#SECTION_ID#/",
                        "DETAIL_PAGE_URL" => "#SECTION_ID#/#ELEMENT_CODE#",
                        "IBLOCK_TYPE" => "catalog",
                        "IBLOCK_ID" => "2",
                        "DEPTH_LEVEL" => "3",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000"
                    ),
                    false
                );?>
            <section class="col-md-9">