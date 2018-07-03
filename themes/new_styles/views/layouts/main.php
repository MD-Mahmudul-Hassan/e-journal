<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        <meta name="viewport" content="width=device-width, initial-scale=1"></meta>
        
        
        <!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" /> -->
        <!-- <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.11.0.min.js"></script> -->
        
        
        <!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        
        <!-- --------------------------------tooltip loading------------------------------ -->
        
        
        
        
        
        
        
        <?php 
                $email;
                $user_type;
                $user_panel_name="Guest";
                $user_panel_link="admin/adminpanel";
                if(!Yii::app()->user->isGuest)
                {
                    $model=Model_Email::model()->findAllByAttributes(array("email"=>Yii::app()->user->name));                
                    $data=  CHtml::listData($model, 'email','user_type');                
                    foreach ($data as $key => $value) 
                    {
                        $email=$key;
                        $user_type=$value;
                    }
                    if($user_type==='Admin')
                    {
                        $user_panel_name="Admin Panel";
                        $user_panel_link=array('admin/adminpanel','email'=>$email);
                    }
                    else if($user_type==='Author')
                    {
                        $user_panel_name="Author Panel";
                        $user_panel_link=array('author/authorpanel','email'=>$email);
                    }
                    else if($user_type==='Editor')
                    {
                        $user_panel_name="Editor's Panel";
                        $user_panel_link=array('editor/editorspanel','email'=>$email);
                    }
                }
            $this->widget('ext.tooltipster.tooltipster');
        ?>
        
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body style="padding: 0px;">
    
    <div id="header">
		<?php                 
		$this->widget(
    'ext.yiibooster.widgets.TbNavbar',
    array(
        'type' => null, // null or 'inverse'
        'brand' => 'Bangladesh Journal of Socio Legal Studies',
        'brandUrl' => array('/site/index'),
        'collapse' => true, // requires bootstrap-responsive.css
        'fixed' => false,
        'fluid' => true,
        'items' => array(
            array(
                'class' => 'ext.yiibooster.widgets.TbMenu',
            	'type' => 'navbar',
                'htmlOptions' => array('class' => 'pull-right'),
                'items' => array(
                    array('label'=>'Home', 'url'=>array('/site/index'),'icon'=>'icon-home icon-white'),
                    array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about'),'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Publications','url'=>array('paper/downloadindex'),),
                    array('label'=>'Editorial Board', 'url'=>array('site/page','view'=>'editorial_board')),
                    array('label'=>'Advisory Board', 'url'=>array('site/page','view'=>'advisory_board')),
                    array('label'=>'Submission Guideline', 'url'=>array('/site/page','view'=>'submission_guideline')),                    
                    array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest,'icon'=>'icon-user icon-white'),
                    array('label'=>$user_panel_name, 'url'=>$user_panel_link, 'visible'=>!Yii::app()->user->isGuest),                                 
                    array('label'=>'Options', 'url'=>array('#'), 'visible'=>Yii::app()->user->getId()==='admin'),
                    array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                ),
            ),
            
        ),
    )
);
                ?>
                 
                
               <!-- mainmenu -->
              
    </div><!-- header -->
<div class="container-fluid ">
              
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>
</div><br><br>




<div id="footer">   
    <?php	
    $this->widget(
    'ext.yiibooster.widgets.TbNavbar',
    array(
        'type' => null, // null or 'inverse'
        'brand' => 'Designed &amp; Developed By Hassan. &reg; Reserved',
        //'brandUrl' => array('/site/index'),
        'collapse' => false,        // requires bootstrap-responsive.css
        'fixed' => 'bottom',
        'fluid' => true,
        'htmlOptions'=>array('style'=>'background-color: #5E0001;'),
        'items' => array(
            array(
                'class' => 'ext.yiibooster.widgets.TbMenu',
            	'type' => 'navbar',
                'htmlOptions' => array('class' => 'pull-right'),
                'items' => array(
                                array('label'=>'News', 'url'=>array('news/public_view')),
                                array('label'=>'Blog', 'url'=>array('/postblog/index')),				
                                array('label'=>'Policy', 'url'=>array('/site/page','view'=>'policy')), 
                                array('label'=>'Terms', 'url'=>array('/site/page','view'=>'terms')),
                                array('label'=>'Contact', 'url'=>array('/site/contact')),
                ),
            ),
            
        ),
    )
);
    
    
    

    
    
    
    
    
    
    
    
    
    
    
    
    
                ?>
        
    
</div><!-- footer -->





            
</body>
</html>
