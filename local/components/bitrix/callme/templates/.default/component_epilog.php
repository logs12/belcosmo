<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
global $APPLICATION;

// подключение js
//$APPLICATION->AddHeadScript($templateFolder."/js/jquery-2.1.4.js");
$APPLICATION->AddHeadScript($templateFolder."/js/popup.js");
$APPLICATION->AddHeadScript($templateFolder."/js/jquery.form.js");
$APPLICATION->AddHeadScript($templateFolder."/js/FormValidate.js");


//подключение php классов
//require_once($templateFolder."/classes/valid.class.php");



?>