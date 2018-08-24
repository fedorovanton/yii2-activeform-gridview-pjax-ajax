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
    
    // Изменили список: Статус
    $(".object-search").on("change", "#objectsearch-status", function() {
        submitSearch();
    });
    
    // Изменили список: Тип объявления
    $(".object-search").on("change", "#objectsearch-operationtype", function() {
        submitSearch();
    });
    
    // Изменили список: Тип недвижимости
    $(".object-search").on("change", "#objectsearch-category", function() {
        submitSearch();
    });
    
    // Изменили поле: Количество комнат
    $(".object-search").on("change", "#objectsearch-rooms", function() {
        submitSearch();
    });
    
    // Изменили список: Город
    $(".object-search").on("change", "#objectsearch-city", function() {
        submitSearch();
    });
    
    // Изменили список: Менеджеры
    $(".object-search").on("change", "#objectsearch-user_id", function() {
        submitSearch();
    });
    
    // Изменили поле: Стоимость/Цена от
    $(".object-search").on("change", "#objectsearch-min_price", function() {
        submitSearch();
    });
    
    // Изменили поле: Стоимость/Цена до
    $(".object-search").on("change", "#objectsearch-max_price", function() {
        submitSearch();
    });
    
  
    // Изменили список: Статус
    $(".object-search").on("change", "#objectsearch-status", function() {
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
