<?php
use yii\helpers\Html;

/* @var $this yiiwebView */
$this->title = strtoupper(Html::encode($ticker)).' Stock Chart';

// Home/AA Stock Chart
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <img src="http://finviz.com/chart.ashx?t=<?= Html::encode($ticker) ?>&ty=c&ta=<?= Html::encode($timeframe)?>&s=l" />
    </p>
    "http://finviz.com/chart.ashx?t=<?= Html::encode($ticker) ?>&ty=c&ta=<?= Html::encode($timeframe)?>&s=l"
    <!-- /Users/billcheng/Sites/basic/views/site/chart.php -->
    <?= __FILE__ ?>
</div>