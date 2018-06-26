<?php
/**
 * Created by PhpStorm.
 * User: alexei.aleshkov
 * Date: 26.06.2018
 * Time: 14:02
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionAssign()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "createPost"
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // добавляем разрешение "updatePost"
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        // добавляем роль "author" и даём роли разрешение "createPost"
        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createPost);

        // добавляем роль "admin" и даём роли разрешение "updatePost"
        // а также все разрешения роли "author"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($author, 2);
        $auth->assign($admin, 1);
    }

    public function actionCreateFirstRole()
    {
        $auth = Yii::$app->authManager;


        // добавляем роль "admin" и даём роли разрешение "updatePost"
        // а также все разрешения роли "author"
        $admin = $auth->createRole('admin');
        $auth->add($admin);


        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.

        $auth->assign($admin, 1);
    }
}