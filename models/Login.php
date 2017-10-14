<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 24.05.2017
 * Time: 15:54
 */

namespace app\models;
use yii\base\Model;
class Login extends Model
{
    public $email;
    public $login;
    public $password;
    public function rules()
    {
        return [
            [['login', 'password'],'required'],
            ['email','email'],
            ['password','validatePassword'] //собственная функция для валидации пароля
        ];
    }
    public function validatePassword($attribute,$params)
    {
        if(!$this->hasErrors()) // если нет ошибок в валидации
        {
            $user = $this->getUser(); // получаем пользователя для дальнейшего сравнения пароля
            if(!$user || !$user->validatePassword($this->password))
            {
                //если мы НЕ нашли в базе такого пользователя
                //или введенный пароль и пароль пользователя в базе НЕ равны ТО,
                $this->addError($attribute,'Пароль или логин введены неверно');
                //добавляем новую ошибку для атрибута password о том что пароль или логин введены не верно
            }else{
                $staff =  ExecutorStaff::findOne(['user_id' => $user->id]);
                //vd($user->id);
                $authority_id = $staff->exec_id;
                $staff_id = $staff->id;
                //vd($authority_id);
                \Yii::$app->session->set('user.authority_id', $authority_id);
                \Yii::$app->session->set('user.staff_id', $staff_id);
            }
        }
    }
    public function getUser()
    {
        return User::findOne(['login'=>$this->login]); // а получаем мы его по введенному имейлу
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Почта',
            'login' => 'Логин',
            'password' => 'Пароль',
        ];
    }
}