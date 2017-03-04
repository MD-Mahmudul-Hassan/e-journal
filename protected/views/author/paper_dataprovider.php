<?php
/* @var $this AuthorController */
/* @var $dataProvider CSqlDataProvider*/






$this->breadcrumbs=array(
	'Author Panel'=>array('authorpanel'),
        'Paper Status'=>array('paperstatus'),
       
);


$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'check_paper_status',
));






?>
