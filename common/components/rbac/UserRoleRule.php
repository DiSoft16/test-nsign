<?php
/**
 * Created by PhpStorm.
 * User: vaio_b970
 * Date: 07.04.2017
 * Time: 4:20
 */

// RBAC
namespace common\components\rbac;

use Yii;
use yii\rbac\Rule;
use yii\helpers\ArrayHelper;
use common\models\User;
use common\models\UserRole;

class UserRoleRule extends Rule
{
    public $name = 'userRole';
    public function execute($user, $item, $params)
    {
        //Получаем массив пользователя из базы
        $user = ArrayHelper::getValue($params, 'user', User::findOne($user));
        if ($user) {
            // Ищем в бд значение роли для пользователя и сравниваем с контантами
            $role = UserRole::find()->andWhere(['=', 'id_role', $user->role])->one()->id_role; //Значение const поля role USER
            if ($item->name === 'admin') {
                return  $role == User::ROLE_ADMIN;
            }
            elseif ($item->name === 'user') {
                return $role == User::ROLE_USER;
            }
        }
        return false;
    }
}