<?php


namespace frontend\components;


class View extends \yii\web\View {
    private $requireJsFiles = [];
    private $requireJsCode = [];
    const POS_END_REQUIRED = 6;
    /**
     * @inheritdoc
     */
    protected function renderBodyEndHtml($ajaxMode)
    {
        $this->getJsData();
        $lines = parent::renderBodyEndHtml($ajaxMode);
        $paths = $this->getRequireJsPaths();
        $requireJsConfig = $this->getRequireJsConfig($paths);
        $jsCode = $this->getRequireJsCode();
        $lines = "<script type=\"text/javascript\">require.config( {$requireJsConfig} );</script>\n" . $lines;
        $modulesJsArray = json_encode(array_keys($paths));
        $lines .= "<script type=\"text/javascript\">requirejs(['jquery'], function() { requirejs({$modulesJsArray}, function() { {$jsCode} }); });</script>\n";
        return $lines;
    }
    /**
     * Gets js data for requireJs (files, code) and prevents it from Yii insert
     */
    protected function getJsData()
    {
        $this->requireJsFiles[self::POS_END] = isset($this->jsFiles[self::POS_END]) ? $this->jsFiles[self::POS_END] : [];
        $this->jsFiles[self::POS_END] = isset($this->jsFiles[self::POS_END_REQUIRED]) ? $this->jsFiles[self::POS_END_REQUIRED] : [];
        if(isset($this->js[self::POS_READY])) {
            $this->requireJsCode[self::POS_READY] = $this->js[self::POS_READY];
            unset($this->js[self::POS_READY]);
        }
        if(isset($this->js[self::POS_LOAD])) {
            $this->requireJsCode[self::POS_LOAD] = $this->js[self::POS_LOAD];
            unset($this->js[self::POS_LOAD]);
        }
    }
    protected function getRequireJsPaths() {
        $paths = [];
        foreach($this->requireJsFiles as $pos => $files) {
            foreach($files as $file => $htmlCode) {
                $filePath = explode('/', $file);
                $name = preg_replace('#\.js$#', '', end($filePath));
                $paths[$name][] = preg_replace('#\.js$#', '', $file);
            }
        }
        return $paths;
    }
    protected function getRequireJsConfig($paths)
    {
        return json_encode([
            'paths' => $paths,
            'baseUrl' => '/js',
        ]);
    }
    protected function getRequireJsCode()
    {
        $wrapLines = [];
        if (!empty($this->requireJsCode[self::POS_READY]))
            $wrapLines[] = "jQuery(document).ready(function () {\n" . implode("\n", $this->requireJsCode[self::POS_READY]) . "\n});";
        if (!empty($this->requireJsCode[self::POS_LOAD]))
            $wrapLines[] = "jQuery(window).load(function () {\n" . implode("\n", $this->requireJsCode[self::POS_LOAD]) . "\n});";
        return implode("\n", $wrapLines);
    }
}