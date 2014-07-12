<?php

class CatalogItems extends CWidget
{
    public $view = "catalog";
    public $provider = array();
    public $limit = 5;
    public $recursive = true;
    public $order = '';
    public $scopes = array();
    public $with = '';
    public $data = array();

    public function run()
    {
        if (!count( $this->provider )) {
            return null;
            //throw new ErrorException("provider param is empty!");
        }

        $catalogName = $this->provider[ 0 ];
        unset($this->provider[ 0 ]);
        $parentCategory = CatalogCategory::model()->roots()->find( 'name = :name', array( ':name' => $catalogName ) );
        if (!$parentCategory) {
            return null;
            //throw new ErrorException("Каталог с именем '{$catalogName}' не найден");
        }

        foreach ($this->provider as $categoryName) {
            $parentCategory = $parentCategory->descendants()->find( 'name = :name', array( ':name' => $categoryName ) );
            if ($parentCategory) {
                continue;
            }
            return null;
            //throw new ErrorException("Категория с именем '{$categoryName}' не найдена");
        }

        if ($this->recursive) {
            $criteria = new CDbCriteria();
            $criteria->limit = $this->limit;
            $criteria->order = $this->order;
            $criteria->scopes = $this->scopes;
            $criteria->with = $this->with;
            $elements = $parentCategory->getAllElements( $criteria )->findAll();
        } else {
            $elements = $parentCategory->elements(
                array(
                    'limit' => $this->limit,
                    'order' => $this->order,
                    'scopes' => $this->scopes,
                    'with' => $this->with,
                )
            );
        }

        return $this->render(
            $this->view,
            array(
                'category' => $parentCategory,
                'elements' => $elements,
                'data' => $this->data,
            )
        );
    }
}