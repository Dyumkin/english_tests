<?php
/**
 * Created by JetBrains PhpStorm.
 * User: y.dyumkin
 * Date: 24.10.14
 * Time: 14:00
 * To change this template use File | Settings | File Templates.
 */

namespace common\components\lang;

use yii\web\UrlManager;
use common\models\Lang;

class LangUrlManager extends UrlManager
{
    public function createUrl($params)
    {
        if( isset($params['lang_id']) ){
            $lang = Lang::findOne($params['lang_id']);
            if( $lang === null ){
                $lang = Lang::getDefaultLang();
            }
            unset($params['lang_id']);
        } else {
            $lang = Lang::getCurrent();
        }

        $url = parent::createUrl($params);

        if( $url == '/' ){
            return '/'.$lang->url;
        }else{
            return '/'.$lang->url.$url;
        }
    }
}