<?php

namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\Event;
use yii\di\Instance;
use yii\web\Session;
use common\models;
use yii\helpers\Url;

/**
 * Class ShoppingCart
 * @property CartPositionInterface[] $positions
 * @property int $count Total count of positions in the cart
 * @property int $cost Total cost of positions in the cart
 * @property bool $isEmpty Returns true if cart is empty
 * @property string $hash Returns hash (md5) of the current cart, that is uniq to the current combination
 * of positions, quantities and costs
 * @property string $serialized Get/set serialized content of the cart
 * @package \yz\shoppingcart
 */
class Currency extends Component
{

    public $session = 'session';
    protected $_currency;
    public $cartId = __CLASS__;

    public function init()
    {
        $this->loadFromSession();
    }

    /**
     * Loads cart from session
     */
    public function loadFromSession()
    {
        $this->session = Instance::ensure($this->session, Session::className());
        if (isset($this->session[$this->cartId]))
            $this->setSerialized($this->session[$this->cartId]);
    }

    /**
     * Saves cart to the session
     */
    public function saveToSession()
    {
        $this->session = Instance::ensure($this->session, Session::className());
        $this->session[$this->cartId] = $this->getSerialized();
    }

    /**
     * Sets cart from serialized string
     * @param string $serialized
     */
    public function setSerialized($serialized)
    {
        $this->_currency = unserialize($serialized);

    }

    /**
     * @param CartPositionInterface $position
     * @param int $quantity
     */
    public function put($position)
    {
        $this->_currency = $position;
        $this->saveToSession();
    }

    /**
     * Returns cart positions as serialized items
     * @return string
     */
    public function getSerialized()
    {
        return serialize($this->_currency);
    }

    public function getCurrency()
    {
        if( $this->_currency === null ){
            $currencies = 'UAH';
            $code = \common\models\Currencies::find()->where('code_currency = :code_currency', [':code_currency' => $currencies])->one();
            Yii::$app->currency->put($code);
        }
        return $this->_currency;
    }

}
