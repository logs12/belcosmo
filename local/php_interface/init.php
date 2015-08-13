<?php
/**
 * Created by PhpStorm.
 * User: work
 * Date: 10.08.2015
 * Time: 19:56
 */


/**
 *
 */
AddEventHandler("main", "OnPageStart", "AutoLoadFrontLib");
function AutoLoadFrontLib()
{
    require_once($_SERVER["DOCUMENT_ROOT"]."/local/config/frontend.php");
}