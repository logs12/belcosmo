<?php

    if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    global $APPLICATION;
    $aMenuLinksExt=$APPLICATION->IncludeComponent
    (
        "bitrix:menu.sections", "left",
        array
        (
            "IS_SEF" => "Y",
            "SEF_BASE_URL" => "/catalog/",
            "SECTION_PAGE_URL" => "#SECTION_ID#/",
            "DETAIL_PAGE_URL" => "#SECTION_ID#/#ELEMENT_ID#.html",
            "IBLOCK_TYPE" => "catalog",
            "IBLOCK_ID" => "2",
            "DEPTH_LEVEL" => "3",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "36000000"
        ),
        false
    );
    //echo "<xmp>"; var_dump($aMenuLinksExt); echo "</xmp>";
    $aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);

?>

<?php


/*


if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
if(CModule::IncludeModule("iblock")) {
    // из какого инфоблока берем элементы

    // Идентификатор раздела
    $iblockId = 1;

    /*
    // сортируем по возрастанию
    $arOrder = array("SORT"=>"ASC");
    // фильтруем
    $arSelect = array("ID", "NAME", "IBLOCK_ID", "DETAIL_PAGE_URL");
    $arFilter = Array("IBLOCK_ID"=>$iblockId, "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
    While ($ob = $res->GetNextElement())
    {
        $arFields = $ob->GetFields();

        $arMenuLinksExtEl[] = array(
            $arFields["NAME"],
            $arFields["DETAIL_PAGE_URL"],
            array(),
            array(),
            ""
        );
    }
    $arMenuLinksExt = array();
    $arMenuLinksExt = array_merge($arMenuLinksExt,$arMenuLinksExtEl);
    $aMenuLinks = array_merge($arMenuLinksExt,$aMenuLinks);
    //echo "<xmp>"; var_dump($arMenuLinks);echo "</xmp>";
    //echo "<xmp>"; var_dump($arFields);echo "</xmp>";


    // выборка разделов

    // сортируем по возрастанию
    $arOrder = array("SORT"=>"ASC");
    $arFilter = Array("IBLOCK_ID"=>$iblockId, "ACTIVE"=>"Y");
    $res = CIBlockSection::GetList($arOrder, $arFilter, false, false, array());
    while($ob = $res->GetNextElement())
    {
        $arSection = $ob->GetFields();
        $arSectionExt[] = array(
            $arSection["NAME"],
            $arSection["SECTION_PAGE_URL"],
            $arSection["LIST_PAGE_URL"],
            array(),
            $arSection["DEPTH_LEVEL"],
        );
    }
    //echo "<xmp>"; var_dump($arSectionExt);echo "</xmp>";
    //$arMenuLinksExt = array_merge($arMenuLinksExt,$arSectionExt);
    $aMenuLinks = array_merge($arSectionExt,$aMenuLinks);
}
echo "<xmp>aMenuLinks = "; var_dump($aMenuLinks);echo "</xmp>";
*/
?>