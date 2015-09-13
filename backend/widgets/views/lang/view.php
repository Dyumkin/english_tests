<?php
use yii\helpers\Html;
?>

<ul class="header-dropdown-list hidden-xs">
    <li>
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="/img/blank.gif" class="flag flag-<?= $current->getFlag(); ?>" alt="<?= $current->name ?>"> <span> <?= $current->name;?> </span> <i class="fa fa-angle-down"></i> </a>
        <ul class="dropdown-menu pull-right">
            <?php foreach ($langs as $lang):?>
            <li class="active">
                <?= Html::a(
                        Html::img('/img/blank.gif', [
                            'class' => 'flag flag-' . $lang->getFlag(),
                            'alt'   => $lang->name
                        ]) . $lang->name,
                    '/'.$lang->url.Yii::$app->getRequest()->getLangUrl()
                ); ?>
            </li>
            <?php endforeach;?>
        </ul>
    </li>
</ul>
