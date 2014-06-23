<?php

class DefaultController extends BackController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column_a1';

    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    public function actionIndex()
    {
        $models = array();

        /*$models['Rules']           = new Rules();
        $models['RulesParams']     = new RulesParams();*/

        $models[ 'EavAttribute' ] = new EavAttribute();

        $this->render(
            'index',
            array(
                'models' => $models,
            )
        );
    }

    public function actionConfigure()
    {
        $eav = Yii::app()->params->eav;

        if (!empty($eav[ 'attributes' ]) && is_array( $eav[ 'attributes' ] )) {
            foreach ($eav[ 'attributes' ] as $name => $params) {

                $a = EavAttribute::model()->find( 'name = :name', array( ':name' => $name ) );

                if (!$a) {
                    $a = new EavAttribute();
                }

                if ($params === false && !$a->isNewRecord) {
                    $a->delete();
                    continue;
                }

                $a->name = $name;
                $a->label = isset($params[ 'label' ]) ? $params[ 'label' ] : $a->hint;
                $a->hint = isset($params[ 'hint' ]) ? $params[ 'hint' ] : $a->hint;
                $a->type = isset($params[ 'type' ]) ? $params[ 'type' ] : $a->type;
                $a->many = isset($params[ 'many' ]) ? $params[ 'many' ] : $a->many;
                $a->options = isset($params[ 'options' ]) ? $params[ 'options' ] : $a->options;
                $a->sort = isset($params[ 'sort' ]) ? $params[ 'sort' ] : 0;
                $a->save();
            }
        }

        if (!empty($eav[ 'entities' ]) && is_array( $eav[ 'entities' ] )) {
            foreach ($eav[ 'entities' ] as $type => $entities) {
                foreach ($entities as $entity => $params) {
                    $e = EavEntity::model()->find(
                        'type = :type AND name = :name',
                        array(
                            ':type' => $type,
                            ':name' => $entity
                        )
                    );

                    if (!$e) {
                        $e = new EavEntity();
                    }

                    if ($params === false && !$e->isNewRecord) {
                        $e->delete();
                        continue;
                    }

                    $e->type = $type;
                    $e->name = $entity;
                    $e->optimize = isset($params[ 'sort' ]) ? $params[ 'sort' ] : $e->optimize;
                    $e->save();

                    if (!empty($params[ 'attributes' ])) {
                        foreach ($params[ 'attributes' ] as $sort => $attribute) {
                            $a = EavAttribute::model()->find( 'name = :name', array( ':name' => $attribute ) );
                            if (!$a) {
                                continue;
                            }

                            $ea = EavEntityAttribute::model()->find(
                                'entity_id = :entity_id AND attribute_id = :attribute_id',
                                array(
                                    ':entity_id' => $e->id,
                                    ':attribute_id' => $a->id,
                                )
                            );

                            if (!$ea) {
                                $ea = new EavEntityAttribute();
                            }

                            $ea->entity_id = $e->id;
                            $ea->attribute_id = $a->id;
                            $ea->sort = $sort;
                            $ea->save();
                        }
                    }

                    if (!empty($params[ 'rules' ]) && is_array( $params[ 'rules' ] )) {
                        foreach ($params[ 'rules' ] as $rule) {

                            list($ruleAttributes, $name, $params) = $rule;

                            foreach ($ruleAttributes as $attribute) {
                                $a = EavAttribute::model()->find( 'name = :name', array( ':name' => $attribute ) );
                                if (!$a) {
                                    continue;
                                }

                                foreach ($params as $param => $value) {
                                    $r = EavRules::model()->find(
                                        'entity_id = :entity_id AND attribute_id = :attribute_id AND name = :name AND param = :param',
                                        array(
                                            ':entity_id' => $e->id,
                                            ':attribute_id' => $a->id,
                                            ':name' => $name,
                                            ':param' => $param,
                                        )
                                    );

                                    if (!$r) {
                                        $r = new EavRules();
                                    }

                                    if ($value === false && !$r->isNewRecord) {
                                        $r->delete();
                                        continue;
                                    }

                                    $r->entity_id = $e->id;
                                    $r->attribute_id = $a->id;
                                    $r->name = $name;
                                    $r->param = $param;
                                    $r->value = $value;
                                    $r->save();
                                }
                            }
                        }
                    }
                }
            }
        }

        echo 'Configured!';
        Yii::app()->end();
    }

    public function actionUpdate( $id )
    {
        // Получаем форму
        $model = Forms::model()->with( 'elements' )->findByPk( $id );

        if (isset($_POST[ 'Forms' ])) {

            $model->attributes = $_POST[ 'Forms' ];
            $model->validate();

            if (!$model->hasErrors()) {
                $model->save();
            }
        }

        $this->render(
            'update',
            array(
                'model' => $model,
            )
        );
    }

    public function actionCreateElement( $id )
    {
        $model = new Elements();
        $model->form_id = $id;
        $model->sort = 0;
        $model->name = 'Element';
        $model->label = 'Element';
        $model->hint = 'Element';
        $model->type = 'text';
        $model->save();

        $model = Forms::model()->with( 'elements' )->findByPk( $id );

        $this->renderPartial(
            '_form',
            array(
                'model' => $model,
            )
        );
    }

    public function actionFormElements( $id )
    {
        $model = Forms::model()->with( 'elements' )->findByPk( $id );

        $this->renderPartial(
            '_form',
            array(
                'model' => $model,
            )
        );
    }

    public function actionUpdateElement( $id )
    {
        $model = Elements::model()->findByPk( $id );

        if ($model == null) {
            Yii::app()->end( 'Element not found' );
        }

        if (isset($_POST[ 'Elements' ])) {

            $model->attributes = $_POST[ 'Elements' ];
            $model->validate();

            if (!$model->hasErrors()) {
                $model->save();
            }
        }

        if (isset($_POST[ 'ElementsOptions' ])) {

            foreach ($_POST[ 'ElementsOptions' ] AS $id => $eo) {

                $param = ElementsOptions::model()->findByPk( $id );
                if ($param != null) {
                    $param->attributes = $eo;
                    $param->validate();
                    if (!$param->hasErrors()) {
                        $param->save();
                    }
                }
            }
        }

        if (isset($_POST[ 'RulesParams' ])) {

            foreach ($_POST[ 'RulesParams' ] AS $id => $rp) {

                $param = RulesParams::model()->findByPk( $id );
                if ($param != null) {
                    $param->attributes = $rp;
                    $param->validate();
                    if (!$param->hasErrors()) {
                        $param->save();
                    }
                }
            }
        }

        $this->renderPartial(
            'update_element',
            array(
                'element' => $model,
                'rules' => new Rules()
            )
        );
    }

    public function actionCreateValidator( $id, $validator )
    {

        $model = new Rules();

        $model->isNewRecord = true;

        if (isset($_POST[ 'Rules' ])) {

            $model->attributes = $_POST[ 'Rules' ];
            $model->validate();

            if (!$model->hasErrors() AND $model->save()) {
            }
        } else {

            $model->attribute_id = $id;
            $model->validator = $validator;
            $model->save();
        }

        $this->renderPartial( '_rules_form', array( 'rules' => $model ) );
    }

    public function actionDeleteValidator( $id )
    {
        Rules::model()->deleteByPk( $id );
        RulesParams::model()->deleteAllByAttributes( array( 'rule_id' => $id ) );
    }

    public function actionCreateValidatorParams( $id )
    {
        $model = new RulesParams();
        $model->rule_id = $id;
        $model->key = 'none';
        $model->value = 'none';
        $model->save();

        $this->renderPartial( '_params_form', array( 'params' => $model ) );
    }

    public function actionDeleteValidatorParams( $id )
    {
        RulesParams::model()->deleteByPk( $id );
    }

    public function actionCreateElementOption( $id )
    {
        $model = new ElementsOptions();
        $model->element_id = $id;
        $model->key = 'none';
        $model->value = 'none';
        $model->save();

        $this->renderPartial( '_options_form', array( 'option' => $model ) );
    }

    public function actionDeleteElementOption( $id )
    {
        ElementsOptions::model()->deleteByPk( $id );
    }

    public function actionDeleteElement( $id )
    {
        Elements::model()->deleteByPk( $id );
    }

    public function actionSort( $id )
    {

        if (isset($_POST[ 'items' ]) && is_array( $_POST[ 'items' ] )) {

            for ($i = 0; $i < count( $_POST[ 'items' ] ); $i++) {

                $item = Elements::model()->findByPk( $_POST[ 'items' ][ $i ] );

                if ($item == null) {
                    continue;
                }

                if ($item->sort != $i) {
                    $item->sort = $i;
                    $item->save();
                }
            }
        }
    }

    public function actionRender( $id )
    {

        $this->layout = '//layouts/column1';

        // Получаем форму
        $model = Forms::model()->with( 'elements' )->findByPk( $id );
        $config = array();

        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        // обход элементов формы
        foreach ($model->elements AS $e) {

            $element = array();
            $element[ 'label' ] = $e->label;
            $element[ 'type' ] = $e->type;
            $element[ 'hint' ] = $e->hint;
            $element[ 'layout' ] = "{label}\n{input}\n{hint}\n{error}";

            if ($e->NeedItems) {
                $element[ 'items' ] = $e->ItemsList;
            }

            // опции элемента
            foreach ($e->options AS $o) {
                $element[ $o->key ] = $o->value;
            }

            // правила валидации элемента
            foreach ($e->rules AS $o) {

                $rules = array();
                $rules[ ] = $e->name;
                $rules[ ] = $o->validator;

                // параметры валидации
                foreach ($o->params AS $p) {
                    $rules[ $p->key ] = $p->value;
                }

                $element[ 'rules' ][ ] = $rules;
            }

            $config[ $e->name ] = $element;
        }

        if ($model->captcha) {
            $config[ 'code' ] = array(
                'type' => 'text',
                'label' => false,
                'hint' => 'Введите код с картинки',
                'layout' => "{label}\n{input}\n{hint}\n{error}",
                'visible' => true,
                'value' => '',
                'rules' => array(
                    array( 'code', 'captcha', 'allowEmpty' => !CCaptcha::checkRequirements() ),
                )
            );
        }

        Yii::import( 'application.extensions.YourVirtualModel' );

        $fmodel = new YourVirtualModel($config);
        $formMap = $fmodel->formMap;

        $formMap[ 'action' ] = Yii::app()->createUrl( $this->route, array( 'id' => $model->id ) );
        $formMap[ 'title' ] = $model->title;

        $formMap[ 'activeForm' ] = array(
            'class' => 'CActiveForm',
            'id' => $model->html_form_id,
            'enableClientValidation' => $model->enableClientValidation,
            'enableAjaxValidation' => $model->enableAjaxValidation,
            'clientOptions' => array(
                'validateOnSubmit' => $model->validateOnSubmit,
            ),
            'htmlOptions' => array(
                'enctype' => $model->enctype,
            )
        );

        $formMap[ 'buttons' ] = array(
            'login' => array(
                'type' => 'submit',
                'label' => $model->button,
            )
        );

        if ($model->captcha) {
            $formMap[ 'elements' ][ 'captcha' ] = array(
                'type' => 'string',
                'content' => '<div class="row no-padding">' . Yii::app()->getController()->widget(
                        'CCaptcha',
                        array(
                            'showRefreshButton' => false,
                            'clickableImage' => true,
                        ),
                        true
                    ) . '</div>',
            );
        }

        if (isset($_POST[ 'YourVirtualModel' ])) {

            $fmodel->attributes = $_POST[ 'YourVirtualModel' ];
            $fmodel->validate();

            if (!$fmodel->hasErrors()) {
                Yii::app()->user->setFlash( 'form_success', $model->success_msg );
            } else {
                Yii::app()->user->setFlash( 'form_failure', $model->failure_msg );
            }
        }

        $form = new CForm($formMap, $fmodel);

        $this->render( 'view', array( 'model' => $model, 'form' => $form ) );
    }
}