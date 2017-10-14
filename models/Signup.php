<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 24.05.2017
 * Time: 15:55
 */
namespace app\models;

use yii\base\Model;

class Signup extends Model
{
    public $email;
    public $login;
    public $password;
    public function rules()
    {
        return [
            [['email', 'login', 'password'],'required'],
            ['email','email'],
            ['email','unique','targetClass'=>'app\models\User'],
            ['login','unique','targetClass'=>'app\models\User'],
            ['password','string','min'=>2,'max'=>10]
        ];
    }
    public function signup()
    {
        $user = new User();
        $user->email = $this->email;
        $user->login = $this->login;
        $user->setPassword($this->password);
        return $user->save(); //вернет true или false
    }
}