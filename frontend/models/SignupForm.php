<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $name;
    public $phone;
    public $address;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
//            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => \Yii::t('app', 'Это имя пользователя уже занято')],
            ['username', 'string', 'min' => 2, 'max' => 255],

            //
            ['name', 'required'],
            ['phone', 'required'],
            ['address', 'required'],


            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => \Yii::t('app', 'Этот Email уже существует в системе')],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->email;
        $user->email = $this->email;

        $user->name = $this->name;
        $user->phone = $this->phone;
        $user->address = $this->address;



        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
