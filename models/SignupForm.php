<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SignupForm extends Model
{
    public $name;
    public $email;
    public $password;
    public function rules()
    {
        return [
            [['name', 'password', 'email'], 'required'],
            [['name'], 'string'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => 'app\models\User', 'targetAttribute' => 'email'],
        ];
    }
    public function signup()
    {
        if ($this->validate()) {
            $user = new User;
            $user->attributes = $this->attributes;
            $user->save(false);

            $auth = Yii::$app->authManager;
            $authorRole = $auth->getRole('author');
            $auth->assign($authorRole, $user->getId());

            return $user;
        }
        return false;
    }
}