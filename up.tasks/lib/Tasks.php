<?php
namespace Up\Tasks;

use Bitrix\Main\Context;
use Bitrix\Main\Type\Date;
use Bitrix\Main\Type\DateTime;
use Up\Tasks\Model\TasksTable;

class Tasks
{

    public static function getTasks()
    {
        return TasksTable::getList(['select' => ['*']])->fetchAll();
    }

    public static function getTaskByID($id)
    {
        return TasksTable::getById($id);
    }

    public static function createTask($arguments)
    {
		$regexp = '/[1-9][0-9][0-9]{2}-([0][1-9]|[1][0-2])-([1-2][0-9]|[0][1-9]|[3][0-1])/';
		if (!preg_match($regexp, $arguments['deadline']))
		{
			$deadline = '';
		}
		else
		{
			$deadline = $arguments['deadline'];
		}
        return TasksTable::createObject()
            ->setTitle($arguments['title'])
            ->setDescription($arguments['description'] ?: '')
            ->setDateCreation(new \Bitrix\Main\Type\DateTime())
            ->setDateDeadline($deadline ? new \Bitrix\Main\Type\DateTime($deadline, 'Y-m-d') : '')
            ->setPriority($arguments['priority'])
            ->save();
    }
    public static function deleteTask($id)
    {
       return TasksTable::delete($id);

    }

    public static function updateTask($arguments)
    {
		$result = TasksTable::getById((int)$arguments['ID'])->fetchObject();
		if (!$result)
		{
			LocalRedirect('/');
		}
		$regexp = '/[1-9][0-9][0-9]{2}-([0][1-9]|[1][0-2])-([1-2][0-9]|[0][1-9]|[3][0-1])/';
		if (!preg_match($regexp, $arguments['DATE_DEADLINE']))
		{
			$deadline = '';
		}
		else
		{
			$deadline = $arguments['DATE_DEADLINE'];
		}
        return $result
            ->setTitle($arguments['TITLE'])
            ->setDescription($arguments['DESCRIPTION'] ?: '')
            ->setDateDeadline($deadline ? new \Bitrix\Main\Type\DateTime($deadline, 'Y-m-d') : '')
            ->setPriority($arguments['Priority'])
            ->setStatus($arguments['Status'])
            ->setDateUpdate(new \Bitrix\Main\Type\DateTime())
            ->save();
    }

	public static function getStatuses()
	{
		// i'm tired of creating config | db table or something so i decided to put it here
		return [
			'New',
			'Processing',
			'Completed',
		];
	}

	public static function getPriorities()
	{
		// same with getStatuses
		return [
			'Low',
			'Normal',
			'High',
		];
	}
}