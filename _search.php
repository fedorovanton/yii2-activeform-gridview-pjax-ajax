<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\models\User\User;
use \common\models\Object;
use \common\models\City;
use \yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\Object\ObjectSearch */
/* @var $form yii\widgets\ActiveForm */

?>

<?php
$this->registerJs('
    // Прикрепляет обновление контента после завершения работы виджета Pjax 
    $("#new-search-objects").on("pjax:end", function(ev) {
         $.pjax.reload({container:"#gridview-objects"});
    });
    
    // Отправки submit
    function submitSearch() {
        $("#form-object-search").submit();
    }
    
    // Изменили любой список в форме
    $(".object-search").on("change", "#form-object-search select", function() {
        submitSearch();
    });
    
    // Изменили любое текстовое поле в форме
    $(".object-search").on("change", "#form-object-search input", function() {
        submitSearch();
    });
    
');
?>

<div class="object-search">
    <?php Pjax::begin(['id' => 'new-search-objects']); ?>
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'id' => 'form-object-search',
        'options' => ['data-pjax' => true],
    ]); ?>

        <?php if (Yii::$app->controller->route != 'object/index-archive'): ?>
            <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
                <div class="form-group">
                    <?= $form->field($model, 'status')->dropDownList(Object::getStatusArray(), [
                        'prompt' => 'Выберите статус',
                        'options' => ['class' => 'form-control'],
                    ])->label(false); ?>
                </div>
            </div>
        <?php endif; ?>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>

</div>
