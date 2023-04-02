<?php
namespace Up\Tasks\Model;

use Bitrix\Main\Localization\Loc,
    Bitrix\Main\ORM\Data\DataManager,
    Bitrix\Main\ORM\Fields\DatetimeField,
    Bitrix\Main\ORM\Fields\IntegerField,
    Bitrix\Main\ORM\Fields\StringField,
    Bitrix\Main\ORM\Fields\Validators\LengthValidator;

Loc::loadMessages(__FILE__);

/**
 * Class Tasks
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> TITLE string(255) mandatory
 * <li> DESCRIPTION string(255) optional
 * <li> DATE_CREATION datetime mandatory
 * <li> DATE_DEADLINE datetime optional
 * <li> DATE_UPDATE datetime optional
 * <li> STATUS string(255) optional default 'new'
 * <li> PRIORITY string(255) optional default 'normal'
 * </ul>
 *
 * @package Bitrix\Tasks
 **/

class TasksTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'up_tasks_task';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return [
            new IntegerField(
                'ID',
                [
                    'primary' => true,
                    'autocomplete' => true,
                    'title' => Loc::getMessage('TASKS_ENTITY_ID_FIELD')
                ]
            ),
            new StringField(
                'TITLE',
                [
                    'required' => true,
                    'validation' => [__CLASS__, 'validateTitle'],
                    'title' => Loc::getMessage('TASKS_ENTITY_TITLE_FIELD')
                ]
            ),
            new StringField(
                'DESCRIPTION',
                [
                    'validation' => [__CLASS__, 'validateDescription'],
                    'title' => Loc::getMessage('TASKS_ENTITY_DESCRIPTION_FIELD')
                ]
            ),
            new DatetimeField(
                'DATE_CREATION',
                [
                    'required' => true,
                    'title' => Loc::getMessage('TASKS_ENTITY_DATE_CREATION_FIELD')
                ]
            ),
            new DatetimeField(
                'DATE_DEADLINE',
                [
                    'title' => Loc::getMessage('TASKS_ENTITY_DATE_DEADLINE_FIELD')
                ]
            ),
            new DatetimeField(
                'DATE_UPDATE',
                [
                    'title' => Loc::getMessage('TASKS_ENTITY_DATE_UPDATE_FIELD')
                ]
            ),
            new StringField(
                'STATUS',
                [
                    'default' => 'new',
                    'validation' => [__CLASS__, 'validateStatus'],
                    'title' => Loc::getMessage('TASKS_ENTITY_STATUS_FIELD')
                ]
            ),
            new StringField(
                'PRIORITY',
                [
                    'default' => 'normal',
                    'validation' => [__CLASS__, 'validatePriority'],
                    'title' => Loc::getMessage('TASKS_ENTITY_PRIORITY_FIELD')
                ]
            ),
        ];
    }

    /**
     * Returns validators for TITLE field.
     *
     * @return array
     */
    public static function validateTitle()
    {
        return [
            new LengthValidator(null, 255),
        ];
    }
    /**
     * Returns validators for DESCRIPTION field.
     *
     * @return array
     */
    public static function validateDescription()
    {
        return [
            new LengthValidator(null, 255),
        ];
    }

    /**
     * Returns validators for STATUS field.
     *
     * @return array
     */
    public static function validateStatus()
    {
        return [
            new LengthValidator(null, 255),
        ];
    }

    /**
     * Returns validators for PRIORITY field.
     *
     * @return array
     */
    public static function validatePriority()
    {
        return [
            new LengthValidator(null, 255),
        ];
    }
}
