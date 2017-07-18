<?php
/**
 * Created by PhpStorm.
 * User: vaio_b970
 * Date: 04.07.2017
 * Time: 0:57
 */

namespace frontend\models;

use Yii;
use yii\base\Model;

class FilterDishForm extends Model
{
    public $ingredient_1st;
    public $ingredient_2nd;
    public $ingredient_3rd;
    public $ingredient_4th;
    public $ingredient_5th;

    public $counter = 0;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['ingredient_1st', 'ingredient_2nd',
                'ingredient_3rd', 'ingredient_4th', 'ingredient_5th'], 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ingredient_1st' => 'Ингредиент 1',
            'ingredient_2nd' => 'Ингредиент 2',
            'ingredient_3rd' => 'Ингредиент 3',
            'ingredient_4th' => 'Ингредиент 4',
            'ingredient_5th' => 'Ингредиент 5',
        ];
    }

    /**
     * @inheritdoc
     */
    public function afterValidate()
    {
        parent::afterValidate();

        $test = $this->getAttributes();
        foreach ($test as $key => $attr) {
            if (!empty($attr)) {
                $this->counter++;
            }
        }
        if ($this->counter < 2) {
            foreach ($this->getAttributes() as $key => $attr) {
                if (empty($this->$key)) {

                    // Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                    $this->addError($key, 'Должно быть заполнено не менее двух полей.');
                }
            }

            return false;
        } else {
            $this->counter = 0;
            return true;
        }

    }

    public function getDish()
    {
        return \common\models\Dish::find()->joinWith('ingredients')
            ->select('ingredient_dish.id_dish AS dish')
            ->distinct()
            ->where(['dish.visible' => 1])
            ->where(['ingredient_dish.id_ingredient' => $this->ingredient_1st])
            ->where(['ingredient_dish.id_ingredient' => $this->ingredient_2nd])
            ->where(['ingredient_dish.id_ingredient' => $this->ingredient_3rd])
            ->where(['ingredient_dish.id_ingredient' => $this->ingredient_4th])
            ->where(['ingredient_dish.id_ingredient' => $this->ingredient_5th])->asArray()
            ->createCommand()->rawSql;
    }

    public function notLessThan($attribute_name, $params)
    {
        $attributes = [
            [
                'error' => 0,
                'name' => 'ingredient_1st',
                'this' => $this->ingredient_1st
            ],
            [
                'error' => 0,
                'name' => 'ingredient_2nd',
                'this' => $this->ingredient_2nd,
            ],
            [
                'error' => 0,
                'name' => 'ingredient_3rd',
                'this' => $this->ingredient_3rd
            ],
            [
                'error' => 0,
                'name' => 'ingredient_4th',
                'this' => $this->ingredient_4th
            ],
            [
                'error' => 0,
                'name' => 'ingredient_5th',
                'this' => $this->ingredient_5th
            ],
        ];
        $this->counter = 0;
        foreach ($attributes as $key => &$attribute) { // change array element
            if (empty($attribute['this']) && $this->counter < 2) {
                $attribute['error'] = 1;
            } else {
                $this->counter++;
            }
        }
        if ($this->counter < 2) {
            foreach ($attributes as $key => $attribute) {
                if ($attribute['error']) {
                    $this->addError($attribute['name'], 'Должно быть заполнено не менее двух полей.');
                }

            }
            return false;
        }
        return true;
    }
}