<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'APLIKASI KONTRAK KARYAWAN LDP', //Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'innerContainerOptions' => ['class' => 'container-fluid'],
        'options' => [
            //'class' => 'navbar-inverse navbar-fixed-top',
            'class' => 'navbar-inverse',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Karyawan', 'url' => ['#'], 'items'=>[
                ['label' => 'Person', 'url' => ['/person']],
                ['label' => 'Employee', 'url' => ['/employee']],
                ['label' => 'Group', 'url' => ['/group']],
                ['label' => 'Email Group', 'url' => ['/emailgroup']],
                ['label' => 'Leader Group', 'url' => ['/leader']],
                ['label' => 'Group Employee', 'url' => ['/groupemployee']],
                ['label' => 'Employee Blacklist', 'url' => ['/employeeblacklist']],
                
            ]],
            ['label'=>'Contract', 'url'=>'#', 'items'=>[
               ['label' => 'Contract Type', 'url' => ['/contracttype']],
               ['label' => 'Jabatan', 'url' => ['/jabatan']],
               ['label' => 'Project', 'url' => ['/project']],
               ['label' => 'Contract Employee', 'url' => ['/contract']],
               //['label' => 'Contract Cek', 'url' => ['/contract/contractcek']],
               ['label' => 'SP', 'url' => ['/sp']],
               ['label'=>'Urutkan Contract', 'url' => ['/contract/urutkan']],
               
            ]],
            //['label' => 'About', 'url' => ['/site/about']],
            //['label' => 'Contact', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; PT. LINTECH LSF Oktober 2019 until <?=date('M Y') ?> created By Hakam</p>

        <p class="pull-right"><?= Yii::powered()?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
