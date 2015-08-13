<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
// echo '<pre>'; print_r($arParams); echo '</pre>';
if ($this->StartResultCache(3600))
{



    $idblock=$arParams["ID_BLOCK"];
    // echo $idblock;
    if(CModule::IncludeModule('iblock'))  //обязательное условие для работы указанных методов
    {
        $arSelect = Array("ID","NAME","DETAIL_TEXT");
        /// выборка значений полей.   DETAIL_TEXT - детальное описание элемента

        $arFilter = Array("IBLOCK_ID"=>$idblock, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
        $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>100), $arSelect); // nPageSize - количество элементов на 1 странице
        while($ob = $res->GetNextElement()) // "бежим" по элементам
        {
            $arResult[] = $ob->GetFields();  // $arResult массив значений полей текущего элемента
        }

    }
    //print_r($arResult);
    //print_r($_GET);
    $this->IncludeComponentTemplate();

}
?>