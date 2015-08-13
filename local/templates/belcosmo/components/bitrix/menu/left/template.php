<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?php //echo "<xmp>"; print_r($arResult); echo "</xmp>";?>
<?if (!empty($arResult)):?>
<aside class="col-md-3">
<div id="accordion">
        <ul >

            <?
            $previousLevel = 0;
            foreach($arResult as $arItem):
            ?>
                <?php //если уровень вложенности меньше счетчика $previousLevel то это последний элемент и нужно закрыть теги?>
                <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
                    <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
                <?endif?>
                <?if ($arItem["IS_PARENT"]):?>
                    <?php if(!empty($arItem['CHILD_SELECTED'])): ?>
                        <li class = "active">
                            <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                           <span class="glyphicon glyphicon-triangle-top"></span>
                    <?else:?>
                        <li class = "inactive">
                            <a class="men" href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                        <span class="glyphicon glyphicon-triangle-bottom"></span>
                    <?endif?>
                            <ul>
                <?else:?>
                    <?if ($arItem["PERMISSION"] > "D"):?>
                        <li>
                            <a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
                        </li>
                    <?endif?>
                <?endif?>
                <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
            <?endforeach?>

            <?if ($previousLevel > 1)://close last item tags?>
                <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
            <?endif?>
            </li>
        </ul>
</div>
</aside>
<?endif?>
