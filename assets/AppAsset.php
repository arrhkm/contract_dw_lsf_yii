<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        //'template/BizPage/css/style.css',
    ];
    public $js = [
        //'template/BizPage/js/main.js',
        'js/dattables/dataTables.buttons.min.js',
        'js/dattables/jquery.dataTables.min.js',
        'js/dattables/',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'fedemotta\datatables\DataTablesAsset',
        'fedemotta\datatables\DataTablesBootstrapAsset',
        'fedemotta\datatables\DataTablesTableToolsAsset',
    ];

   
}
