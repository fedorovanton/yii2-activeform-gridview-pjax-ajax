<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use \yii\widgets\ActiveForm;
use \yii\helpers\Url;
use \backend\models\Object\Object;
use \yii\grid\GridView;
use \common\components\FunctionsFedorov;
use \backend\models\ObjectPhoto\ObjectPhoto;
use \yii\helpers\Json;
use \yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Object\ObjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Объекты';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js');

?>

<div class="row">
    <div class="col-md-12">

        <div class="card card-warning card-outline">

            <div class="card-header">
                <?php echo $this->render('_search', [
                        'model' => $searchModel,
                        'count_objects' => $count_objects
                ]); ?>
            </div><!-- /.card-header -->

            <div class="card-body">
                <?php Pjax::begin(['id' => 'gridview-objects']); ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel'  => $searchModel,
                    'layout'       => "{items}\n{pager}",
                    'tableOptions' => ['class' => 'table table-hover'],
                    'showHeader' => false,
                    'emptyText' => 'Данных по вашему запросу нет.',
                    'pager' => [
//                            'firstPageLabel' => 'first',
//                            'lastPageLabel' => 'last',
//                            'prevPageLabel' => 'previous',
//                            'nextPageLabel' => 'next',
                        'maxButtonCount' => 3,

                        // Customzing options for pager container tag
                        'options' => [
//                            'tag' => 'a',
                            'class' => 'pagination pagination-sm m-0 float-right'
//                            'id' => 'pager-container',
                        ],

                        // Customzing CSS class for pager link
                        'linkOptions' => ['class' => 'page-link'],
                        'activePageCssClass' => 'active',
                        'disabledPageCssClass' => 'disabled pager-btn-disabled',

                        // Customzing CSS class for navigating link
                        'prevPageCssClass' => 'page-item',
                        'nextPageCssClass' => 'page-item',
                        'firstPageCssClass' => 'page-item',
                        'lastPageCssClass' => 'page-item',
                    ],
                    'columns'      => [
                        'id',
                        'name',
                        'status'
                    ],
                ]) ?>
                <?php Pjax::end(); ?>

            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col -->
</div>
