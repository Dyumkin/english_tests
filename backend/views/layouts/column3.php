<?php
/**
 * Created by PhpStorm.
 * User: yury
 * Date: 29.01.15
 * Time: 21:43
 */
/* @var $this \yii\web\View */
/* @var $content string */
?>

<?php $this->beginContent('@backend/views/layouts/main.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <p>
                    SideLeft
                </p>
            </div>

            <div id="content" class="col-sm-4">
                <?php echo $content; ?>
            </div><!-- content -->

            <div class="col-sm-4">
                <p>
                    SideRight
                </p>
            </div>
        </div>
    </div>
<?php $this->endContent();