<?php
/* @var $this AuthorController */
/* @var $model Author */






$this->breadcrumbs=array(
	'Authors'=>array('authorpanel','email'=>  Yii::app()->user->name),
        'Update Form'=>array("updatebyauthor","id"=>"100001")
);

//$this->menu=array(
//	array('label'=>'List Author', 'url'=>array('index')),
//	array('label'=>'Create Author', 'url'=>array('create')),
//	array('label'=>'View Author', 'url'=>array('view', 'id'=>$model->author_id)),
//	array('label'=>'Manage Author', 'url'=>array('admin')),
//);
?>

<h3>Updating <?php echo $model->author_last_name; ?>'s profile</h3>

<?php $this->renderPartial('update_author_form', array('model'=>$model)); ?>