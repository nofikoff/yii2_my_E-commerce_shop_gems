<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm; // or yii\widgets\ActiveForm
use kartik\widgets\FileInput;

$form = ActiveForm::begin(['enableAjaxValidation' => false,
    'options'=>['enctype'=>'multipart/form-data'] // important
]);


echo $form->field($model, 'filename');

// display the image uploaded or show a placeholder
// you can also use this code below in your `view.php` file
$title = isset($model->filename) && !empty($model->filename) ? $model->filename : 'Avatar';
echo Html::img($model->getImageUrl(), [
    'class'=>'img-thumbnail', 
    'alt'=>$title, 
    'title'=>$title
]);
/**
// your fileinput widget for single file upload
echo $form->field($model, 'image')->widget(FileInput::classname(), [
    'options'=>['accept'=>'image/*'],
    'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']]
]);
*/


//* uncomment for multiple file upload
echo $form->field($model, 'image[]')->widget(FileInput::classname(), [
    'options'=>['accept'=>'image/*', 'multiple'=>true],
    'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']]
]);


// render the submit button
echo Html::submitButton($model->isNewRecord ? 'Upload' : 'Update', [
    'class'=>$model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
);

// render a delete image button 
if (!$model->isNewRecord) { 
    echo Html::a('Delete', ['/person/delete', 'id'=>$model->id], ['class'=>'btn btn-danger']);
}
?>


<?php ActiveForm::end(); ?>
