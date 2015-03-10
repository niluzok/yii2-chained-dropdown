# yii2-chained-dropdown

Yii2 widget-wrapper for Chained jQuery plugin

Look for jQuery plugin description [Chained Selects Plugin for jQuery and Zepto](http://www.appelsiini.net/projects/chained)


## Usage

It can be used as separate widget:
```php
   <?= ChainedDropDown::widget([
       'name' => 'some-name',
       'parent' => '#parent-dropdown',
       'items' => $someArray
   ]) ?> 
```
or
```php
   <?= ChainedDropDown::widget([
       'model' => $model,
       'attribute' => 'some-attribute',
       'parent' => '#parent-dropdown',
       'items' => $someArray
   ]) ?> 
```
It also, as any InputWidget, can be used in ActiveForm's
```php
    <?= $form->field($model, 'some-attribute')->widget(ChainedDropDown::className(), [
        'parent' => '#parent-dropdown',
        'items' => $someArray
    ]) ?>
```
