<?php
/* @var $this PostblogController */
/* @var $model Model_blog */
/* @var $form CActiveForm */

$model=new Model_blog;

//$data2= new CActiveDataProvider('Model_blog');

$this->breadcrumbs=array(
	'Blogindex'=>array('index','id'=>'main'),
);

?>
<div class="row-fluid">
    <div class="span9">
    <div id="blog_container">
            <?php $this->widget('zii.widgets.CListView', array(
                    'dataProvider'=>$dataProvider,
                    'itemView'=>'blogging',
            )); ?>
        <div class="row-fluid">
            <div class="comment_box_form">
                <div class="form">
                     <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'model-blog-form',
                            'enableAjaxValidation'=>false,
                            'enableClientValidation'=>true,
                            'action'=>array('postblog/create'),
                     )); ?>

                  <?php echo $form->errorSummary($model); ?>

                    <div class="row span10">
                            <?php echo $form->labelEx($model,'comment_message',array('')); ?>
                            <?php echo $form->textArea($model,'comment_message',array('style'=>'width:100%;height:100px;font-size:14px;')); ?>
                            <?php echo $form->error($model,'comment_message'); ?>
                    </div>

                    <div class="row buttons" style='text-align:left;'>
                            <?php echo CHtml::submitButton('Post',array('class'=>'btn btn-info span3')); ?>
                    </div>

                    <?php $this->endWidget(); ?>

                </div><!-- form -->     

            </div>
          </div>

        </div>
    </div>
    
    
    <div class="span3" style="margin-top: 75px;display: none;">
    
     <div id="recent_post_container">
        <div id="recent_header">
            Archive
        </div>
        <div id="recent_header_data_container"> 
            <?php 
            $url=  CHtml::normalizeUrl(array('site/page','view'=>'about'))    ;
            $collapse = $this->beginWidget('ext.yiibooster.widgets.TbCollapse'); ?>
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" style="text-decoration: none;">
                                    Year-2016
                                </a>
                                </h4>
                            </div>
                        <div id="collapseOne" class="panel-collapse collapse out">
                            <div class="panel-body" style="margin-left: 20px;">
                                    No Topics yetout
                            </div>
                        </div>
                        </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_2015" style="text-decoration: none;">
                                Year-2015
                            </a>
                            </h4>
                        </div>
                    <div id="collapse_2015" class="panel-collapse collapse">
                        <div class="panel-body">                                                   
                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-12-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                        December
                                                    </a>
                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-11-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                        November
                                                    </a>   
                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-10-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                        October
                                                    </a>
                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-09-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                       September
                                                    </a>  

                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-08-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                       August
                                                    </a>
                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-07-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                        July
                                                    </a> 
                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-06-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                        June
                                                    </a>
                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-05-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                        May
                                                    </a>   
                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-04-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                        April
                                                    </a>
                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-03-'));;?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                        March
                                                    </a> 
                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-02-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                        February
                                </a>
                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-01-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                        January
                                </a>                                                                                                   
                        </div>
                    </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"style="text-decoration: none;">
                                Year-2014
                            </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body" style="margin-left: 20px;">
                           Development began
                        </div>
                        </div>
                    </div>
                    </div>
        <?php $this->endWidget(); ?>
        </div>

        </div>
      </div>
</div>