<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;


$registration_page=  CHtml::normalizeUrl(array('author/register'));




?>



<div class="row-fluid">    
    <div id="slogan_container" class="row-fluid">
        <div id='slogan_text_area' class="row-fluid">
             <?php //echo CHtml::link("Share your knowledge with the best of the researchers<br>around the world", $url=  Yii::app()->homeUrl);?>
            <p>Share your knowledge with the best of the researchers<br>around the world</p>
        </div>
        <div class="row-fluid">
            <div class="span4"></div>
            <div class="span4">            
                    <?php echo CHtml::link("<div id='join_button_div'>Join Us</div>", $url= CHtml::normalizeUrl(array('email/register')),array('style'=>'text-decoration:none;'));?>            
            </div>
            <div class="span4"></div>
        </div>        
    </div>   
</div>


<div class="row-fluid" style="margin-top: 20px;">
    <div id="service_container" class="span12">          
        <div class="span1"></div>    
        <div class="service_1_main span3">
                <div class="service_image">                     
                   <?php echo CHtml::link("<div id='round1'><img id='round_in' src='images/statistics.png' width='90%' height='90%'/></div>",$url=  Yii::app()->createUrl("author/authorpanel"));?> 
                     <div class="newH1">Statistics</div>
                </div>                
                <div class="service_text">                    
                    See all the citations,<br>download of papers<br>including yours                    
                </div>                
            </div>            
             <div class="service_1_main span4">
                <div class="service_image">                     
                   <?php echo CHtml::link("<div id='round1'><img id='round_in' src='images/justise.png' width='90%' height='90%'/></div>",$url=array('/site/page', 'view'=>'about'));?>                
                    <div class="newH1">Socio-Legal Research</div>
                </div>
                
                 <div class="service_text">                    
                    Explore and make<br>the best<br>choice for your research                   
                </div>                             
             </div>        
           <div class="service_1_main span3">
                <div class="service_image">                     
                   <?php echo CHtml::link("<div id='round1'><img id='round_in' src='images/consultance.png' width='90%' height='90%'/></div>",Yii::app()->createUrl('request/create'));?>                
                    <div class="newH1">Consultancy</div>
                </div>               
               <div class="service_text">                    
                    Connect with the<br>greatest of<br>researchers                  
                </div>                
            </div>    
    </div>
    
   </div>