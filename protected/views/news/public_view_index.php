<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */


?>





<div class="row-fluid">
    <div class="row-fluid">
        <p style="font-size: 25px;">Latest News</p><hr>
    </div>
    <div class="row-fluid">
            <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'public_news_page',
        )); ?>
        </div>
    
</div>