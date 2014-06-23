<?php
/**
 * Class MailCommand
 *
*/

// PHP Error[8]: Undefined index: SERVER_NAME in CHttpRequest.php at line 305
$_SERVER['SERVER_NAME'] = 'betonfootball.eu';
$_SERVER['HTTP_HOST']   = 'betonfootball.eu';

Yii::setPathOfAlias('cwebroot','/var/www');

class MailCommand extends ConsoleCommand
{

	public function init(){
	
		set_error_handler(array('MyErrorHandler', 'errorToException'));
	}

    public function actionIndex() {
		
		echo "\n===================".date("Y-m-d h:i:s")."=====================\n";
		
		// получить активное задание
		$task = MailTask::model()->with('recipient')->active()->find();
		
		if($task==null)
			Yii::app()->end("\nActive task not found\n");
		
		// Проверить, если все письма отправлены, закрыть рассылку
		if(count($task->recipient)==0){
			$task->status = MailTask::STATUS_CLOSE;
			$task->save();
			Yii::app()->end("\nMailing complite\n");
		}
		
		// выставить статус "В процессе"
		$task->status = MailTask::STATUS_PROCESS;
		
		$task->save();
		
		foreach($task->recipient(array('limit'=>1)) AS $item){
			
			$status = false;
			
			if($item->user_id>0){
				echo $item->user->email."\n";
				$user = $item->user;
			}else{
				echo $item->email."\n";
				$user = $item->email;
			}
			
			try{
				$status = $this->sendMail($task, $user);
			} catch (Exception $e) {
				
				@file_put_contents('/var/www/mailerrors/mail_error_'.$item->id.'.txt', print_r($e,1));
			}
			
			if($status==true)
				$task->success++;
			else
				$task->errors++;
				
			$item->delete();
			
		}
		
		$task->status = MailTask::STATUS_PAUSE;
		
		$task->save();
		
		Yii::app()->end("\nStop\n");
    }
	
	public function actionFast(){
		
		echo "\n===================".date("Y-m-d h:i:s")."=====================\n";
		
		// Проверить наличие активных типсов
		$tips = Tips::model()->published()->allActive()->findAll();
		
		if(count($tips)==0)
			Yii::app()->end("\nActive tips not found\n");
		
		// Получить быстрых подписчиков
		$users = User::model()->active()->spamer()->fast()->findAll(); //array('email'=>'egosaw@gmail.com')
		
		if(count($users)==0)
			Yii::app()->end("\nFast subscribers not found\n");
		
		foreach($users AS $user){
			
			// Составить список типсов, которые пользователь еще не получал
			$userTips   = array();
			$sendedTips = array();
			
			// Список типсов, которые уже были отправлены пользователю
			foreach(FastMail::model()->findAllByAttributes(array('user_id'=>$user->id)) AS $st)
				$sendedTips[] = $st->tips_id;
			
			foreach($tips AS $item){
				
				if(!in_array($item->id, $sendedTips))
					$userTips[] = $item;
			}
			
			// Если есть что отправлять, отправляем
			if(count($userTips)>0){
				
				echo "\t".$user->email."\n";
				
				// Отправить
				$this->sendmailFast($userTips, $user);
				
				// Занести в ЛОГ что отправляли
				foreach($userTips AS $tip){
				
					$log = new FastMail;
					$log->user_id = $user->id;
					$log->tips_id = $tip->id;
					$log->save();
				}
				
			}else{
				echo "\tUser ".$user->email." has already received a letter all tips at the moment\n";
			}
		}

		Yii::app()->end("\nMission accomplished\n");
	}
	
	public function actionDidgest(){
		
		echo "\n===================".date("Y-m-d h:i:s")."=====================\n";
		
		// Проверить наличие активных типсов
		$check = Tips::model()->published()->allActive()->count();
		$free  = Tips::model()->published()->allActive()->free()->count();
		
		if($check AND $check>0){
			
			// получить всех пользователей
			// которые подписаны на рассылку
			// и которые не получали рассылку более 24 часов
			
			$c = new CDbCriteria();
			$c->compare('last_mail', '<'.( date('U')-(3600*12) ));
			
			
			//$c->compare('email', 'egosaw@gmail.com');
			$users = User::model()->active()->spamer()->findAll($c);
			//$users = User::model()->findAllByAttributes(array('email'=>'egosaw@gmail.com'));
			
			if(count($users)>0)
				echo "\nStart didgest. Finded ".count($users)." users.\n";
			else
				echo "\nSubscribers not found\n";
			
			foreach($users AS $model){
				
				// Отмечаем дату последней рассылки
				echo $model->email."\n";
				$model->scenario = 'mail';
				$model->last_mail = date('U');
				$model->save();
				
				if($model->hasErrors())
					print_r($model->getErrors());
				
				// Проверяем, если пользователь не подписан и нету бесплатных типсов, не отправляем письмо
				
				if(!$model->accessViewTips AND $free==0){
					echo "\nUser {$model->email} is not subscriber and count free tips is zero\n";
					continue;
				}
				
				$this->sendmailWidget($model);
			}
			
		}else{
			echo "Active tips not found\n";
			Yii::app()->end();
		}
	}
	
	protected function sendMail($task, $user){
		
		// проверить емейл
		$email = trim(($user instanceof User) ? $user->email    :  $user);
		$uname = trim(($user instanceof User) ? $user->FullName :  $user);
		
		// сформировать письмо
		$body = Yii::t('mail', $task->content, array('{USERNAME}'=>$uname));
		$body = $this->renderFile('/var/www/themes/classic/views/user/mail/newsletter.php', array('content'=>$body), true);
		
		// отправить
		$ymessage           = new YiiMailMessage;
		$ymessage->setBody($body, 'text/html');
		$ymessage->subject = $task->subject;
		$ymessage->addTo($email);
		$ymessage->setFrom( array( Yii::app()->config->get('EMAIL_NOREPLY') => Yii::app()->name ) );
		
		return Yii::app()->mail->send($ymessage);
	}
	
	private function render($template, array $data = array()){
		$path = Yii::getPathOfAlias('webroot.themes.classic.views.user.mail').'/'.$template.'.php';
		if(!file_exists($path)) throw new Exception('Template '.$path.' does not exist.');
		return $this->renderFile($path, $data, true);
	}
	
	protected function sendmailWidget($model){

		// сформировать письмо
		// @todo: Исправить путь 
		$body = $this->renderFile('/var/www/themes/classic/views/user/mail/widget.php', array('model'=>$model), true);
		
		// отправить
		$ymessage           = new YiiMailMessage;
		$ymessage->setBody($body, 'text/html');
		$ymessage->subject = Yii::t('user','Новые новости').' '.Yii::app()->name;
		$ymessage->addTo($model->email);
		$ymessage->setFrom( array( Yii::app()->config->get('EMAIL_NOREPLY') => Yii::app()->name ) );
		
		return Yii::app()->mail->send($ymessage);
	}
	
	protected function sendmailFast($tips, $user){
		
		// $this->sendmailFast($userTips, $user);
		
		// сформировать письмо
		$body = $this->renderFile('/var/www/themes/classic/views/user/mail/fast.php', array('model'=>$user, 'tips'=>$tips), true);
		
		// отправить
		$ymessage           = new YiiMailMessage;
		$ymessage->setBody($body, 'text/html');
		$ymessage->subject = Yii::t('user','Новые советы').' '.Yii::app()->name;
		$ymessage->addTo($user->email);
		$ymessage->setFrom( array( Yii::app()->config->get('EMAIL_NOREPLY') => Yii::app()->name ) );
		
		return Yii::app()->mail->send($ymessage);
	}
	
}