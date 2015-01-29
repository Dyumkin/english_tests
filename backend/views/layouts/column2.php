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

<?php $this->beginContent('@backend/views/layouts/main.php'); ?>
    <div class="row">
        <div class="col-sm-3">
            <?php

            echo GhostMenu::widget([
                'encodeLabels'=>false,
                'activateParents'=>true,
                'items' => [
                    [
                        'label' => 'Backend routes',
                        'items'=>UserManagementModule::menuItems()
                    ],
                ],
            ]);
            ?>
        </div>

        <div id="content" class="col-sm-9">
            <?php echo $content; ?>
        </div>
        <!-- content -->
    </div>
<?php $this->endContent();