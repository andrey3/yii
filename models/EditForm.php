<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class EditForm extends Model
{
    public $name;
    public $imageFile;

    protected $_user;

    /**
     * @return array the validation rules.
     * @var UploadedFile
     */

    public function rules()
    {
        return [
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'string', 'min' => 2, 'max' => 255],
            ['name', 'required'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['name', 'imageFile'], 'safe']
        ];
    }
    public function getUser($id)
    {
        if(!$this->_user instanceof User){
            $this->_user = User::findById($id);
        }
        return $this->_user;
    }

    public function edit($id, $updateImage=false)
    {
        if ($this->validate()) {
            $user = $this->getUser($id);
            $user->name = $this->name;

            if ($updateImage) {
                $image = $this->imageFile->baseName . '.' . $this->imageFile->extension;
                $path = Yii::getAlias("@app/web/images/$image");
                $this->imageFile->saveAs($path);
                $user->image = $image;
            }

            return $user->save(false) && empty($this->getErrors()) ? $user : null;
        } else {
            return false;
        }

    }
}