<?php

class ZCDbHttpSession extends CDbHttpSession
{
	/**
	 * Creates the session DB table.
	 * @param CDbConnection $db the database connection
	 * @param string $tableName the name of the table to be created
	 */
	protected function createSessionTable($db,$tableName)
	{
		$driver=$db->getDriverName();
		if($driver==='mysql')
			$blob='LONGBLOB';
		elseif($driver==='pgsql')
			$blob='BYTEA';
		else
			$blob='BLOB';
		$db->createCommand()->createTable($tableName,array(
			'id'     => 'CHAR(32) PRIMARY KEY',
			'expire' => 'integer',
			'data'   => $blob,
			'user_id'=> 'integer NULL',
			'ip'     => 'integer',
			'uagent' => 'VARCHAR(250)',
		));
	}

	/**
	 * Session write handler.
	 * Do not call this method directly.
	 * @param string $id session ID
	 * @param string $data session data
	 * @return boolean whether session write is successful
	 */
	public function writeSession($id,$data)
	{
		// exception must be caught in session write handler
		// http://us.php.net/manual/en/function.session-set-save-handler.php
		try
		{
			$user=Yii::app()->getComponent('user',false);        
			$userId=empty($user)?null:$user->getId();
			$expire=time()+$this->getTimeout();
			$db=$this->getDbConnection();
			if($db->createCommand()->select('id')->from($this->sessionTableName)->where('id=:id',array(':id'=>$id))->queryScalar()===false)
				$db->createCommand()->insert($this->sessionTableName,array(
					'id'     => $id,
					'data'   => $data,
					'expire' => $expire,
					//'user_id'=> (Yii::app()->user->isGuest ? null : //Yii::app()->user->id),
					'user_id'=> ($user->isGuest ? null : $userId),
					'ip'     => ip2long(Yii::app()->request->userHostAddress),
					'uagent' => Yii::app()->request->getUserAgent(),
				));
			else
				$db->createCommand()->update($this->sessionTableName,array(
					'data'   => $data,
					'expire' => $expire,
					//'user_id'=> (Yii::app()->user->isGuest ? null : Yii::app()->user->id),
					'user_id'=> ($user->isGuest ? null : $userId),
					'ip'     => ip2long(Yii::app()->request->userHostAddress),
					'uagent' => Yii::app()->request->getUserAgent(),
				),'id=:id',array(':id'=>$id));
		}
		catch(Exception $e)
		{
			if(YII_DEBUG)
				echo $e->getMessage();
			// it is too late to log an error message here
			return false;
		}
		return true;
	}

}