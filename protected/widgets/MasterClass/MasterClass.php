<?php

/**
 * MasterClass class file.
 * @author egoss <dev@egoss.ru>
 */
class MasterClass extends CWidget
{
    public function init()
    {
    }

    public function run()
    {
        $model = new MasterClassForm();

        if (!empty($_POST[ 'MasterClassForm' ])) {
            $model->attributes = $_POST[ 'MasterClassForm' ];
            if ($model->validate()) {
                $mail = new YiiMailMessage(Yii::t( 'masterclass', 'Заявка на мастер-класс' ));
                $mail->setBody( $this->render( Yii::app()->language . '/mail', array( 'model' => $model ), true ), 'text/html' );
                $mail->addTo( Yii::app()->config->get('MASTERCLASS_EMAIL') );
                $mail->from = array( Yii::app()->config->get( 'EMAIL_NOREPLY' ) => Yii::app()->name );
                Yii::app()->mail->send( $mail );
                Yii::app()->user->setFlash(
                    'masterclassSuccess',
                    Yii::t( 'masterclass', 'Спасибо, ваша заявка принята.' )
                );
                $model->unsetAttributes();
                $model->type = 'seminar';
            }
        }
        if (!Yii::app()->user->isGuest && !$model->hasErrors()) {
            $user = User::model()->findByPk( Yii::app()->user->id );
            $model->name = $user->firstname . ' ' . $user->lastname;
            $model->email = $user->email;
        }
        return $this->render( 'view', array( 'model' => $model ) );
    }
}