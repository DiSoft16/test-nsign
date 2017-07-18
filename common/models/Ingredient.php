<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ingredient".
 *
 * @property integer $id
 * @property string $name
 * @property string $fname
 * @property integer $visible
 * @property integer $created_at
 * @property integer $updated_at
 */
class Ingredient extends \yii\db\ActiveRecord
{
    public $load_picture;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ingredient';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['visible', 'created_at', 'updated_at'], 'integer'],
            [['name', 'fname'], 'string', 'max' => 255],
            [['load_picture'], 'file'],
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
            'fname' => 'Файл',
            'load_picture' => 'Файл',
            'visible' => 'Видимый элемент',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    public function getIngredients()
    {
        return $this->hasMany(Dish::className(), ['id' => 'id_dish'])
            ->viaTable('ingredient_dish', ['id_ingredient' => 'id']);
    }

    // Dependent drop for ignore selected ingredient
    public static function GetIngredientList($id_ingredient) {
        $out = [];
        $models = self::find()
            ->andWhere(['<>', 'id', $id_ingredient])
            ->asArray()->all();
        foreach ($models as $i => $ingredient) {
            $out[] = ['id' => $ingredient['id'],
                'name' => $ingredient['name']];
        }
        return $out;
    }

    // for frontend filter
    public static function GetFilter()
    {
        return ArrayHelper::map(self::find()->all(),'id', 'name');
    }

    public static function getIngredientByName($name)
    {
        $ingredient = self::find()->where(['name' => $name])->one();
        if (!$ingredient) {
            $ingredient = new Ingredient();
            $ingredient->name = $name;
            $ingredient->save(false);
        }
        return $ingredient;
    }
}
