<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<div class="col-md-6">
    <?
    $cnt = 0;

    foreach($arResult as $arItem):
        $cnt++;
        if ($cnt > 3) continue; ?>

            <?php if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;?>
            <?if($arItem["SELECTED"]):?>
                <li><a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a></li>
            <?else:?>
                <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
            <?endif?>

    <?endforeach?>
</div>
<div class="col-md-6">
    <?
    $cnt = 0;
    foreach($arResult as $arItem):
        $cnt++;
        if ($cnt <= 3) continue; ?>

        <?php if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) continue;?>
        <?if($arItem["SELECTED"]):?>
        <li><a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a></li>
    <?else:?>
        <li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
    <?endif?>

    <?endforeach?>
</div>
<?endif?>