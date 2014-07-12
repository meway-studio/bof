<?php

class ElementController extends Controller
{
    public function actionView( $id )
    {
        /**
         * @var $category CatalogCategory
         * @var $element CatalogElement
         */
        if (!($element = CatalogElement::model()->available()->findByPk( $id ))) {
            throw new CHttpException(404, 'Указанная запись не найдена');
        }

        $category = $element->category;
        $viewPath = ($viewPath = $element->getTplViewPath( 'view' )) ? $viewPath : 'view';

        if ($viewDir = CatalogComponent::catalogViewDir( $category->catalog->name )) {
            $newViewPath = rtrim( $viewDir, '/' ) . '/' . ltrim( $viewPath, '/' );
            $viewPath = $this->getViewFile( $newViewPath ) ? $newViewPath : $viewPath;
        }

        $this->render(
            $viewPath,
            array(
                'element'  => $element,
                'category' => $category,
            )
        );
    }
}