<?php

namespace common\models;

use yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\UploadedFile;

/**
* Class Person
* @package common\models
* @property int $id unique person identifier
* @property string $name person / user name
* @property array $avatar generated filename on server
* @property string $filename source filename from client
*/
class Person extends ActiveRecord
{
    /**
    * @var mixed image the attribute for rendering the file input
    * widget for upload on the form
    */
    
    public $image;

    public function rules()
    {
        return [
            [['name', 'avatar', 'filename', 'image'], 'safe'],
            //[['image'], 'file', 'extensions'=>'jpg, gif, png'],
            [['image'], 'file', 'extensions' => 'jpeg, jpg, png, gif', 'maxSize'=>20*1024*1024, 'maxFiles'=>1000]
        ];
    }

    /**
     * fetch stored image file name with complete path 
     * @return string
     */
    public function getImageFile() 
    {
        return isset($this->avatar) ? Yii::getAlias('@frontend').'/web/upload/products/' . $this->avatar : null;
    }

    /**
     * fetch stored image url
     * @return string
     */
    public function getImageUrl() 
    {
        // return a default image placeholder if your source avatar is not found
        $avatar = isset($this->avatar) ? $this->avatar : 'default_user.jpg';
        return Yii::getAlias('@site').'/upload/products/' . $avatar;
    }


    /**
    * Process upload of image
    *
    * @return mixed the uploaded image instance
    */
    public function uploadImage() {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $images = UploadedFile::getInstancesByName('Person');


        // PHP Server Code to process submitted form
        $numUploadedfiles = count($images);
        foreach ($images as $image) {
            var_dump($image);
            echo '--------------------------------------------';
        }

 die;
        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }



        // store the source file name
        $this->filename = $image->name;
        $ext = end((explode(".", $image->name)));

        // generate a unique file name
        $this->avatar = Yii::$app->security->generateRandomString().".{$ext}";

        // the uploaded image instance
        return $image;
    }


    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->imageFiles as $file) {
                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
    
    /**
    * Process deletion of image
    *
    * @return boolean the status of deletion
    */
    public function deleteImage() {
        $file = $this->getImageFile();

        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }

        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        // if deletion successful, reset your file attributes
        $this->avatar = null;
        $this->filename = null;

        return true;
    }
    
    
}
