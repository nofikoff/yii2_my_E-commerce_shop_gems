<?php

namespace common\models;

use Yii;
use yz\shoppingcart\CartPositionInterface;
use yii\base\Object;

class ProductCartPosition extends Object implements CartPositionInterface
{
    use \yz\shoppingcart\CartPositionTrait;

    /**
     * @var Product
     */
    protected $_product;

    public $id;
    public $type;
    public $name;

    public function getId()
    {
        //return $this->id;
        return md5(serialize([$this->id, $this->type]));
    }

    public function getPrice()
    {
        if ($this->getProduct())
            return $this->getProduct()->cost;
        return null;
    }

    /**
     * @return Product
     */
    public function getProduct()
    {
        if ($this->_product === null) {
            if ($this->type == 'simple')
                $this->_product = Simpleproducts::findOne($this->id);
            else
                $this->_product = ProductGemsPrices::findOne($this->id);
        }
        return $this->_product;
    }
}
