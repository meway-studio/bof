<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class MasterClassForm extends CFormModel
{
    public $name;
    public $email;
    public $type = 'seminar';
    public $time;
    public $details;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            // name, email, subject and body are required
            array( 'name, email, type, time', 'required' ),
            // email has to be a valid email address
            array( 'email', 'email' ),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(
            'name'    => Yii::t( 'masterclass', 'Ф.И.О' ),
            'email'   => Yii::t( 'masterclass', 'Email' ),
            'type'    => Yii::t( 'masterclass', 'Тип встречи' ),
            'time'    => Yii::t( 'masterclass', 'Время встречи' ),
            'details' => Yii::t( 'masterclass', 'Детали' ),
        );
    }
}