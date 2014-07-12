<?php

/**
 * Configure admin panel
 */
class From1cController extends CController
{
    /**
     * Update module settings
     */
    public function actionIndex()
    {
        Yii::import( 'application.modules.accounting1c.models.AccountingConfigForm' );
        $model = new Catalog1cConfigForm();

        if (isset($_POST[ 'Catalog1cConfigForm' ])) {
            $model->attributes = $_POST[ 'Catalog1cConfigForm' ];
            if ($model->validate()) {
                $model->save();
                $this->setFlashMessage( Yii::t( 'Catalog.Import.admin', 'Изменения успешно сохранены' ) );
                Yii::app()->request->redirect( Yii::app()->createUrl( '/core/admin/systemModules' ) );
            }
        }

        $this->render(
            'index',
            array(
                'model' => $model,
            )
        );
    }
}
