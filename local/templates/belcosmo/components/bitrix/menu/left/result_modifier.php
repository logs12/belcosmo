<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

//determine if child selected

$bWasSelected = false;
$arParents = array();
$depth = 1;
foreach($arResult as $i=>$arMenu)
{
	$depth = $arMenu['DEPTH_LEVEL'];

	if($arMenu['IS_PARENT'] == true)
	{
		$arParents[$arMenu['DEPTH_LEVEL']-1] = $i;
	}
	elseif($arMenu['SELECTED'] == true)
	{
		$bWasSelected = true;
		break;
	}
}
//echo "bWasSelected = ".$bWasSelected;
// если выбран пункт у которого есть дети, то добавляеться к родительскому пункту CHILD_SELECTED
if($bWasSelected)
{
	for($i=0; $i<$depth-1; $i++)
		$arResult[$arParents[$i]]['CHILD_SELECTED'] = true;
}
//echo "<xmp>"; print_r($arResult); echo "</xmp>";
?>
