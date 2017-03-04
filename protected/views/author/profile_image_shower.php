<?php
    /* @var $this AuthorController */
        


    $user_email=  Yii::app()->user->name;

    
    
    
    
    
//    header('Pragma: public');
//    header('Expires: 0');
//    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
//    header('Content-Transfer-Encoding: binary');
//    header('content-type: text/html');
//    //header('Content-Disposition: attachment; filename='.$model->file_name);
//    
//    
//    $connection=  Yii::app()->db;
//
//    $sql="SELECT * FROM tbl_email WHERE email='$user_email'";
//    
//    $query=$connection->createCommand($sql)->query();
//    $imageData;
//    $password;
//    while($row=mysql_fetch_assoc($query))
//    {
//        $imageData=$row['profile_image'];
//        $password=$row['password'];
//    }
//    
//    echo $password;
//    //echo $imageData;
    
    
    echo $content;
    echo $name;
    
    
   
?>
