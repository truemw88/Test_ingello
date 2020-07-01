<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $name
 * @property int $state_id
 * @property int|null $priority
 * @property string|null $description
 * @property string|null $icon
 *
 * @property State $state
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $imageFile;

    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'state_id'], 'required'],
            [['state_id', 'priority'], 'integer'],
            [['name'], 'string', 'max' => 55],
            [['description'], 'string', 'max' => 255],
//            [['icon'], 'file', 'extensions' => 'png, jpg', 'skipOnEmpty' => true],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['state_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'state_id' => 'Состояние',
            'priority' => 'Приоретет',
            'description' => 'Описание',
            'icon' => 'Картинка',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {

            $this->imageFile->saveAs('image');

            return true;
        } else {
            return false;
        }
    }
    /**
     * Gets query for [[State]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(State::className(), ['id' => 'state_id']);
    }

    public static function getTask()
    {
        return self::find()->orderBy(['priority' => SORT_ASC])->all();
    }
}
