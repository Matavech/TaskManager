<?php

class TaskDetailsComponent extends CBitrixComponent
{
	public function executeComponent()
	{
		\Bitrix\Main\Loader::includeModule('up.tasks');
		$this->fetchTask();
		$this->includeComponentTemplate();
	}


	protected function fetchTask()
    {
		$request = \Bitrix\Main\Context::getCurrent()->getRequest();
		$id = (int)$request->get('id');


		if ($request->getRequestMethod()==='POST')
		{
			$result = \Up\Tasks\Tasks::updateTask($request->getPostList());
			if (!$result->isSuccess())
			{
				$this->arResult['messages'] = $result->getErrorMessages();
			}
		}

		$result = \Up\Tasks\Tasks::getTaskByID($id)->fetch();
		if (!$result)
		{
			LocalRedirect('/');
		}

		foreach ($result as $key => $row)
		{
			$task[$key] = $row ?: 'Не указано';
		}
		if ($task['DATE_DEADLINE'] === 'Не указано')
        {
            unset($task['DATE_DEADLINE']);
        }

		$this->arResult['task'] = $task;

	}
}