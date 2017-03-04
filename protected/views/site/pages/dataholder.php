<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div id="recent_post_container">   
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
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                                No Topics yet
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
                                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-01-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    January
                                                </a>                               
                                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-02-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    February
                                                </a>
                                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-03-'));;?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    March
                                                </a>                               
                                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-04-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    April
                                                </a>
                                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-05-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    May
                                                </a>                               
                                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-06-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    June
                                                </a>
                                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-07-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    July
                                                </a>                               
                                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-08-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                   August
                                                </a>
                                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-09-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                   September
                                                </a>                               
                                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-10-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    October
                                                </a>
                                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-11-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    November
                                                </a>                               
                                                <a href="<?php echo $url=  CHtml::normalizeUrl(array('postblog/postsearch','id'=>'2015-12-'));?>" style="text-decoration: none;margin-left: 30px;display: block;">
                                                    December
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
                    <div class="panel-body">
                         Software Development began on November 22
                    </div>
                    </div>
                </div>
                </div>
    <?php $this->endWidget(); ?>
    </div>
    
    </div>