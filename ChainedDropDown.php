<?php

namespace niluzok\yii2chained;

use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/**
 * Yii2 widget-wrapper for Chained jQuery plugin
 * 
 * @link http://www.appelsiini.net/projects/chained Chained Selects Plugin for jQuery and Zepto
 *
 * It can be used as separate widget:
 * ```php
 *    <?= ChainedDropDown::widget([
 *        'name' => 'some-name',
 *        'parent' => '#parent-dropdown',
 *        'items' => $someArray
 *    ]) ?> 
 * ```
 * or
 * ```php
 *    <?= ChainedDropDown::widget([
 *        'model' => $model,
 *        'attribute' => 'some-attribute',
 *        'parent' => '#parent-dropdown',
 *        'items' => $someArray
 *    ]) ?> 
 * ```
 *
 * It also, as any InputWidget, can be used in ActiveForm's
 * ```php
 *     <?= $form->field($model, 'some-attribute')->widget(ChainedDropDown::className(), [
 *         'parent' => '#parent-dropdown',
 *         'items' => $someArray
 *     ]) ?>
 * ```
 */
class ChainedDropDown extends InputWidget
{
    /** @var array Array of items for Html::dropDownList */
    public $items;
    /** @var string Value of selected option for Html::dropDownList */
    public $selection;
    /** @var string Selector of parent element - goes as is to Chained plugin */
    public $parent;
    /** @var array Array of parent selectors */
    public $parents;
    /** @var string Css class that is always appended to class attribute of input tag */
    public $widgetClass = 'chained-dropdown';

    /** @var string Prepared selector for all parents - goes to Chained plugin */
    private $_parentSelector;

    public function init()
    {
        parent::init();

        if((!$this->parent and !$this->parents) or ($this->parent and $this->parents) )
            throw new \yii\base\InvalidConfigException('Either [[parent]] or [[parents]] must be set, but only one of them');

        if($this->parent and !is_string($this->parent))
            throw new \yii\base\InvalidConfigException('[[parent]] must be a string');

        if($this->parents and !is_array($this->parents))
            throw new \yii\base\InvalidConfigException('[[parents]] must be an array');

        $this->_parentSelector = $this->parents ? implode(', ', $this->parents) : $this->parent;

        $this->options['class'] = isset($this->options['class']) ? $this->options['class'].' '.$this->widgetClass : $this->widgetClass;

        if(!$this->getId(false)) {
            $this->id = Html::getInputId($this->model, $this->attribute);
        }
    }

    public function run()
    {
        ChainedAsset::register($this->view);

        if($this->hasModel())
            echo Html::activeDropDownList($this->model, $this->attribute, $this->items, $this->options);
        else
            echo Html::dropDownList($this->name, $this->selection, $this->items, $this->options);

        $this->view->registerJs("
            $('#{$this->id}').chained('{$this->_parentSelector}');
        ");
    }
}