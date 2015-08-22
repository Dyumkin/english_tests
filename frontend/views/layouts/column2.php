<?php
/**
 * Created by PhpStorm.
 * User: yury
 * Date: 29.01.15
 * Time: 21:43
 */
/* @var $this \yii\web\View */
/* @var $content string */

use webvimark\modules\UserManagement\components\GhostMenu;
use webvimark\modules\UserManagement\UserManagementModule;
?>

<?php $this->beginContent('@frontend/views/layouts/main.php'); ?>
    <div class="row">
        <div class="col-sm-3">
            <?php

            /*echo GhostMenu::widget([
                'encodeLabels'=>false,
                'activateParents'=>true,
                'items' => [
                    [
                        'label' => 'Frontend routes',
                        'items'=>[
                            ['label'=>'Login', 'url'=>['/user-management/auth/login']],
                            ['label'=>'Logout', 'url'=>['/user-management/auth/logout']],
                            ['label'=>'Registration', 'url'=>['/user-management/auth/registration']],
                            ['label'=>'Change own password', 'url'=>['/user-management/auth/change-own-password']],
                            ['label'=>'Password recovery', 'url'=>['/user-management/auth/password-recovery']],
                            ['label'=>'E-mail confirmation', 'url'=>['/user-management/auth/confirm-email']],
                        ],
                    ],
                ],
            ]);*/
            ?>
        </div>

        <div id="content" class="col-sm-9">
            <?php echo $content; ?>
        </div>
        <!-- content -->
    </div>
<?php $this->endContent();