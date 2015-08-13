<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 26.07.2015
 * Time: 22:50
 */
// подключение ядра битрикса
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

global $APPLICATION;

// проверяем подключенно ли ядро
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

// подключаем класс валидации
$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."classes/FormValidate.php", Array(), Array());

/*
$APPLICATION->IncludeFile($APPLICATION->GetCurDir()."classes/Form.class.php", Array(), Array());

$fields1 = array(
	'validation_function' => array('validation_empty'=>array()),
	'items' => array(
		'name'	=> array(
			'validation_function' => array('validation_empty'=>array()),
			'error_message' => array
			(
				'validation_empty' => "Заполните поле !!!!",
			),
		),

		'phone'	=> array(
			'validation_function' => array('validation_empty'=>array()),
			'error_message' => array
			(
				'validation_empty' => "Заполните поле !!!!",
			),
		),
		'email'	=> array(
			'validation_function' => array('validation_empty'=>array()),
			'error_message' => array
			(
				'validation_empty' => "Заполните поле !!!!",
			),
		)
	),
);
$f = new Form($fields1);
$f->execute();
*/

$fields = array(
	'name' => array(
		'validationFunction'=>array(
			'validationEmpty'=>array(),
			'validationText'=>array()
		),
		'errorMessage' => array
		(
			'validationEmpty' => "Пожалуйста, заполните поле!",
			'validationText' => "Убедитесь что Имя содержит от 2 до 30 символов и не содержит цифр"
		),
	),
	'phone' => array(
		'validationFunction'=>array(
			'validationEmpty'=>array(),
			'validationPhone'=>array()
		),
		'errorMessage' => array
		(
			'validationEmpty' => "Пожалуйста, заполните поле!",
			'validationPhone' => "Убедитесь что телефон содержит от содержит только цифры"
		),
	),
	'email' => array(
		'validationFunction'=>array(
			'validationEmail'=>array()
		),
		'errorMessage' => array
		(
			'validationEmail' => "Убедитесь что вы ввели корректный Email"
		),
	)
);

//echo "<xmp>"; var_dump($_POST); echo "</xmp>";

$form = new FormValidate($fields);
$values = $form->execute();

//echo "<xmp>values1 = "; var_dump($values); echo "</xmp>";
//echo "<xmp>"; var_dump($form->fieldsError); echo "</xmp>";

try{
	if (!$values) throw new Exception();

	global $USER;
	CModule::IncludeModule('iblock');

	//  запись в инфоблок
	$el = new CIBlockElement;

	$PROP = array();
	$PROP['name'] = $values['name'];
	$PROP['email'] = $values['email']; ;
	$PROP['phone'] = $values['phone']; ;

	//формируем имя элемента
	$NAME = 'callMe'.' ('.date('d-M-y H:i:s').')';
	$arLoadFields = Array(
		"MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
		"IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
		"IBLOCK_ID"      => 4,
		"PROPERTY_VALUES"=> $PROP,
		"NAME"           => $NAME,
		"ACTIVE"         => "Y",            // активен
		"PREVIEW_TEXT"   => "текст для списка элементов",
		"DETAIL_TEXT"    => "текст для детального просмотра",
		"DETAIL_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/image.gif")
	);

	if(!$ELEMENT_ID = $el->Add($arLoadFields)) throw new Exception($el->LAST_ERROR);

	$result['IS_SUCCESS'] = 1;
}
catch(Exception $e)
{
	//$result['error'] = $e->getMessage();
	$result['IS_SUCCESS'] = 0;
	$result['ERROR_FIELDS'] = $form->fieldsError;
}
echo json_encode($result);
exit();
?>



