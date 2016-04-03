<?php

namespace app\models;

use yii\db\ActiveRecord;

class Country extends ActiveRecord
{

	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'code', 'population'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 10],
            [['population'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'code' => 'Code',
            'name' => 'Name',
            'Population' => 'Population'
        ];
    }
	
}