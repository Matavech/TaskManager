<?php
/**
 * @var CMain $APPLICATION
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("TaskManager");

$APPLICATION->IncludeComponent('up:task.list', '', []);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>