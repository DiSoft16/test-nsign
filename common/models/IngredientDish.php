<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ingredient_dish".
 *
 * @property integer $id
 * @property integer $id_ingredient
 * @property integer $id_dish
 */
class IngredientDish extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ingredient_dish';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ingredient', 'id_dish', 'quantity'], 'required'],
            [['id_ingredient', 'id_dish'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ingredient' => 'Id Ingredient',
            'id_dish' => 'Id Dish',
        ];
    }
}
