<?php

/**
 * Class ActiveRecord
 * @method mixed eav(string $name) EavBehavior
 * @property CDbCommand $findCommand
 */
class ActiveRecord extends CActiveRecord
{
    /**
     * Added auto-caching for models
     * @param string $className
     * @return CActiveRecord
     */
    public static function model($className = __CLASS__)
    {
        $model = parent::model($className);
        $dependency = new CDbCacheDependency("SELECT MAX(update_date) FROM {$model->tableName()}");
        return $model->cache(Yii::app()->config->get('SYS_CACHE_TIME'), $dependency);
    }

    /**
     * Позволяет выполнять:
     * query(), queryAll(), queryRow(), ...
     * И получать голые данные из БД без обвертки AR
     * @return CDbCommand
     */
    public function getFindCommand()
    {
        $cb = Yii::app()->db->getCommandBuilder();
        return $cb->createFindCommand($this->tableName(), $this->getDbCriteria());
    }

    /**
     * Поведения по умолчанию
     * @return array
     */
    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'create_date',
                'updateAttribute' => 'update_date',
                'enabled' => (isset($this->create_date) AND isset($this->update_date))
            ),
            'EavARBehavior' => array(
                'class' => 'application.modules.eav.behaviors.EavARBehavior',
            ),
        );
    }

}