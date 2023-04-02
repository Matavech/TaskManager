<?php

/**
 * @var CMain $APPLICATION
 */
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
\Bitrix\Main\Loader::includeModule('up.tasks');
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("TaskManager");

$id = (int)\Bitrix\Main\Context::getCurrent()->getRequest()->getPost('id');
\Up\Tasks\Tasks::deleteTask($id);

LocalRedirect('/');

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>





