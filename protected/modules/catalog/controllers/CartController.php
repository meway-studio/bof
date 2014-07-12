<?php

class CartController extends FrontController
{
    public $layout = '//layouts/column1';
    public $defaultAction = 'view';
    public $elementId = false;
    public $element = null;

    public function actionView()
    {
        $order = null;
        $cart = is_array( Yii::app()->session[ 'cart' ] ) ? Yii::app()->session[ 'cart' ] : array();
        $elements = array();

        foreach ($cart as $elementId => $quantity) {
            if ($element = CatalogElement::model()->findByPk( $elementId )) {
                $elements[ ] = array(
                    'element'  => $element,
                    'quantity' => $quantity,
                );
            }
        }

        if (isset($_POST[ 'CatalogOrder' ])) {
            $order = new CatalogOrder();
            $order->attributes = $_POST[ 'CatalogOrder' ];
            if ($order->validate()) {
                if ($order->save()) {
                    foreach ($elements as $element) {
                        $e = new CatalogOrderElement();
                        $e->order_id = $order->id;
                        $e->element_id = $element['element']->id;
                        $e->quantity = $element['quantity'];
                        $e->save();
                    }
                    Yii::app()->session[ 'cart' ] = null;
                    $elements = array();
                } else {
                    $order = null;
                }
            }
        }

        $this->render(
            'view',
            array(
                'elements' => $elements,
                'order'    => $order,
            )
        );
    }

    public function actionOrder()
    {
        $model = null;


        $this->render(
            'order',
            array(
                'order' => $model,
            )
        );
    }

    public function loadModel( $id )
    {
        $model = CatalogElement::model()->findByPk( $id );
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    public function actionElement()
    {
        foreach (Yii::app()->log->routes as $route) {
            $route->enabled = false;
        }

        if (!($this->elementId = (int)Yii::app()->request->getParam( 'id' ))) {
            throw new CHttpException(400, 'Invalid id param');
        }

        if (!($this->element = CatalogElement::model()->findByPk( $this->elementId ))) {
            throw new CHttpException(400, 'Element not found');
        }

        if (!($cart = Yii::app()->session[ 'cart' ])) {
            $cart = array();
        }

        if ($quantity = (int)Yii::app()->request->getParam( 'quantity', 1 )) {
            if (!empty($cart[ $this->elementId ])) {
                $quantity += $cart[ $this->elementId ];
            }
            $cart[ $this->elementId ] = $quantity;
        }

        if (Yii::app()->request->getParam( 'delete' )) {
            unset($cart[ $this->elementId ]);
        }

        Yii::app()->session[ 'cart' ] = $cart;

        if (!Yii::app()->request->isAjaxRequest) {
            Yii::app()->request->redirect( Yii::app()->request->urlReferrer );
        }
        Yii::app()->end();
    }
}
