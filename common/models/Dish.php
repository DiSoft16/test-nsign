<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use \cornernote\linkall\LinkAllBehavior;

/**
 * This is the model class for table "dish".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $fname
 * @property integer $visible
 * @property integer $created_at
 * @property integer $updated_at
 */
class Dish extends \yii\db\ActiveRecord
{
    public $load_picture;
    public $id_ingredient;
    public $dish;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dish';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['visible', 'created_at', 'updated_at'], 'integer'],
            [['name', 'fname'], 'string', 'max' => 255],
            [['load_picture'], 'file'],
            [['id_ingredient'], 'safe'],
        ];
    }

    // Auto save timestamp
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            LinkAllBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'id_ingredient' => 'Ингредиенты',
            'description' => 'Описание',
            'fname' => 'Файл',
            'load_picture' => 'Файл',
            'visible' => 'Видимый элемент',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }


    public function afterSave($insert, $changedAttributes)
    {
        if ($this->id_ingredient) { // don't save if update visible ingredient
            $ingredients = [];
            foreach ($this->id_ingredient as $ingredient_name) {
                $ingredient = Ingredient::getIngredientByName($ingredient_name);
                if ($ingredient) {
                    $ingredients[] = $ingredient;
                }
            }
            $this->linkAll('ingredients', $ingredients);
            parent::afterSave($insert, $changedAttributes);
        }
    }

    public function getIngredients()
    {
        return $this->hasMany(Ingredient::className(), ['id' => 'id_ingredient'])
            ->viaTable('ingredient_dish', ['id_dish' => 'id']);
    }

    public static function GetVisibleDish($id_ingredient)
    {
        return self::find()->joinWith('ingredients')// eager loading
        ->where(['ingredient_dish.id_ingredient' => $id_ingredient])->all();
    }

    public static function SetVisibleDish($id_ingredient)
    {
        $model = self::GetVisibleDish($id_ingredient);
        foreach ($model as $post) {
            $post->visible = ($post->visible > 0) ? 0 : 1;
            $post->save();
        }

    }
}
