# yii2-activeform-gridview-pjax-ajax

При изменение выпадающего списка в ActiveForm (файл _search.php) без перезагрузки страницы будут меняться данные в GridView (файл index.php). Контроллер и ModelSearch - кастомные CRUD.

1. Сгенирровать стандартный CRUD для необходимой Модели
2. Раскомментировать _search.php.
3. Обернуть ActiveForm (в _search.php) Pjax'ом и прописать параметры ['id' => 'new-search-objects'], где ID используется тут же в JS для перехвата событий.
4. Зарегестрировать (в _search.php) JS скрипт. Здесь #gridview-objects - это ID обернутого Pjax для GridView в файле index.php :
```
$this->registerJs('
    /**
     * Прикрепляет обновление контента после завершения работы виджета Pjax
     */
    $("#new-search-objects").on("pjax:end", function(ev) {
        $.pjax.reload({container:"#gridview-objects"});
    });

    /**
     * Отправки submit
     */
    function submitSearch() {
        $("#form-object-search").submit();
    }

    /**
     * Изменили любой список в форме
     */
    $(".object-search").on("change", "#form-object-search select", function() {
        submitSearch();
    });

    /**
     * Изменили любое текстовое поле в форме
     */ 
    $(".object-search").on("change", "#form-object-search input", function() {
        submitSearch();
    }); 
');
```
5. В index.php обернуть Pjax'ом GridView. Для Pjax параметры ['id' => 'gridview-objects'].
