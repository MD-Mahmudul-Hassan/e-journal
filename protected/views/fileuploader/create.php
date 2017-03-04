<?php
/* @var $this FileuploaderController */

$this->breadcrumbs=array(
	'Fileuploader'=>array('/fileuploader'),
	'Create',
);


$model=new File_uploader_model;
?>



<?php
        $form = $this->beginWidget(
            'CActiveForm',
            array(
                'id' => 'upload-form',
                'enableAjaxValidation' => false,
                'htmlOptions' => array('enctype' => 'multipart/form-data'),
            )
        );
        echo $form->labelEx($model, 'file_name');
        echo $form->textField($model, 'file_name');
        echo $form->error($model, 'file_name');
        
        echo $form->labelEx($model, 'image');
        echo $form->fileField($model, 'image');
        echo $form->error($model, 'image');
        // ...
        echo CHtml::submitButton('Submit');
        $this->endWidget();


?>