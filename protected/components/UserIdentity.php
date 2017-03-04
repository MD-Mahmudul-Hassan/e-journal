<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
//		$users=array(
//			// username => password
//			//'demo'=>'demo',
//			'admin'=>'saikot',
//                        'author'=>'author',
//                        'editor'=>'editor',
//		);
                
      
         $current_username=null;
         $current_usertype=null;
         $current_password=null;        
            
         $this->password=md5($this->password);
     
         $model=  Model_Email::model()->findAllByAttributes(array('email'=>$this->username,'password'=>  $this->password));               
         $data1= CHtml::listData($model, 'email','password');
         
         foreach ($data1 as $key => $value) {
             $current_username=$key;
             $current_password=$value;
         }              
         if($current_username!=$this->username)
         {
             $this->errorCode=self::ERROR_USERNAME_INVALID;
         }
         else if($current_password!=$this->password)
         {             
             $this->errorCode=self::ERROR_PASSWORD_INVALID; 
         }
         else
         {	
             $this->errorCode=self::ERROR_NONE;                
         }
        
         return !$this->errorCode;
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
         
               
//		if(!isset($users[$this->username]))
//                {
//                    $this->errorCode=self::ERROR_USERNAME_INVALID;
//                
//                }
//		elseif($users[$this->username]!==$this->password)
//                {
//                    $this->errorCode=self::ERROR_PASSWORD_INVALID;                
//                }
//		else
//                {	
//                    $this->errorCode=self::ERROR_NONE;
//                
//                }
//		return !$this->errorCode;
	
                
                
                
                
                
                
                
       }
}