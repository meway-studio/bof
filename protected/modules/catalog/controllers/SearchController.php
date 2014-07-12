<?php

class SearchController extends FrontController
{
    /**
     * @throws HttpException
     * @internal param $id
     */
    public function actionIndex()
    {
        $category = new CatalogCategory('search');
        if (!empty($_GET[ 'CatalogCategory' ])) {
            $category->attributes = $_GET[ 'CatalogCategory' ];
        }
        $categoryDataProvider = $category->search();

        $element = new CatalogElement('search');
        if (!empty($_GET[ 'CatalogElement' ])) {
            $element->attributes = $_GET[ 'CatalogElement' ];
        }
        $elementDataProvider = $element->search();

        $categoryCriteria = new CDbCriteria(array( 'with' => array( 'category' ) ));
        $categoryCriteria->mergeWith( $categoryDataProvider->getCriteria() );
        $categoryCriteria->alias = null;

        $elementCriteria = new CDbCriteria(array(
            'with' => array( 'elements' => array( 'alias' => 'element', 'together' => true ) )
        ));
        $elementCriteria->mergeWith( $elementDataProvider->getCriteria() );
        $elementCriteria->alias = null;

        $categoryDataProvider->getCriteria()->mergeWith( $elementCriteria );
        $categoryDataProvider->pagination->pageSize = 10;

        $elementDataProvider->getCriteria()->mergeWith( $categoryCriteria );
        $elementDataProvider->pagination->pageSize = 10;

        $this->render(
            'index',
            array(
                'element'              => $element,
                'elementDataProvider'  => $elementDataProvider,
                'category'             => $category,
                'categoryDataProvider' => $categoryDataProvider,
            )
        );
    }
}