<?php

namespace app\modules\admin\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "category".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $keywords
 * @property string $description
 */
class Category extends ActiveRecord {

    public static function tableName() {
        return 'category';
    }

    public function getCategory() {
        return $this->hasOne(Category::class, ['id' => 'parent_id']);
    }

    public function rules() {
        return [
            [['parent_id'], 'integer'],
            [['name'], 'required'],
            [['name', 'keywords', 'description'], 'string', 'max' => 255],
            [['keywords', 'description'], 'default', 'value'=> NULL]
        ];
    }

    public function attributeLabels() {
        return [
            'id' => '№ категории',
            'parent_id' => 'Родительская категория',
            'name' => 'Название',
            'keywords' => 'Ключевые слова',
            'description' => 'Мета-описание',
        ];
    }

}