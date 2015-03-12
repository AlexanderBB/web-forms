<?php
session_start();
if ($_SESSION[include_engine] != 'on'){header('Location: http://www.you-dont-have-right-to-view-this-file.com/');}

/**
 * TODO: ADD DOCUMENTATION
 */

class register {
	private $_error;
	private $_msgTxt;
	private $_mysqli; 
	private $_phpMailer;
	
	function __construct(){
		$this->_phpMailer = new PHPMailer();
		$this->_mysqli = new db();
		$this->_msgTxt = '';
		$this->_error = 0;
	}
        public function init(){
            $this->_writeToDB();
        }

        private function _displayMessage( $fieldName = '' ){
		exit ( json_encode(array(0=>"{$this->_error}",1=>"{$this->_msgTxt}",2=>$fieldName)) );
	}
	
	private function _getDataSanitized(){
		if ( $_POST[name]!='' 
                        && $_POST[lastname]!=''         //AND
                        && $_POST[tel]!=''              //AND
                        && $_POST[email]!=''            //AND
                        && $_POST[university]!=''       //AND
                        && $_POST[specialty]!=''        //AND
                        && $_POST[current_year]!=''     //AND
                        && $_POST[question_field]!=''   
                    ){
                        $this->_mysqli->query("SET NAMES 'utf8'");
			$dataBox['time']            = time();
			$dataBox['ip']              = $_SERVER['REMOTE_ADDR'];
			$dataBox['name']            = $this->_mysqli->real_escape_string(trim($_POST[name]));
			$dataBox['lastname']        = $this->_mysqli->real_escape_string(trim($_POST[lastname]));
			$dataBox['tel']             = $this->_mysqli->real_escape_string(trim($_POST[tel]));
			$dataBox['email']           = $this->_mysqli->real_escape_string(trim($_POST[email]));
			$dataBox['university']      = $this->_mysqli->real_escape_string(trim($_POST[university]));
			$dataBox['specialty']       = $this->_mysqli->real_escape_string(trim($_POST[specialty]));
			$dataBox['current_year']    = $this->_mysqli->real_escape_string(trim($_POST[current_year]));
			$dataBox['question_field']  = $this->_mysqli->real_escape_string(trim($_POST[question_field]));
			return $dataBox;
		 }else{
			$this->_error = 1;
		}
	}
		
	private function _getDataValidated(){
		$dataBox = $this->_getDataSanitized();
 		if($this->_error == 0){
			$this->_error 	= 2;
			$nameOptions 	= array('options' => array('min_range' => 3,'max_range' => 20));
			$nameLength 	= mb_strlen($dataBox['name'],'utf8');
			$namePattern 	= '/^\p{L}+$/u';
			$lastnameLength = mb_strlen($dataBox['lastname'],'utf8');
			$telOptions 	= array('options' => array('min_range' => 8,'max_range' => 12));
			$telLength 	= strlen($dataBox['tel']);
			$telPattern 	= '/^[0-9]+$/';
			$emailOptions 	= array('options' => array('min_range' => 5,'max_range' => 64));
			$emailLength 	= strlen($dataBox['email']);
			// Name Validation (min=3 && max=20) && (preg_match letters only)
			if(!filter_var($nameLength, FILTER_VALIDATE_INT, $nameOptions)){
				$this->_msgTxt 	= '<strong>Error:</strong><br />Field "Name" is with wrong length!';
				$this->_displayMessage('name');
			}else if(!preg_match($namePattern,$dataBox['name'],$matches)){
				$this->_msgTxt 	= '<strong>Error:</strong><br />Field "Name" contains numbers and/or special characters';
				$this->_displayMessage('name');
			}
			// Lastname Validation (min=3 && max=20) && (preg_match letters only)
			if(!filter_var($lastnameLength, FILTER_VALIDATE_INT, $nameOptions)){
				$this->_msgTxt 	= '<strong>Error:</strong><br />Field "Lastname" is with wrong length!';
				$this->_displayMessage('lastname');
			}else if(!preg_match($namePattern,$dataBox['lastname'],$matches)){
				$this->_msgTxt 	= '<strong>Error:</strong><br />Field "Lastname" contains numbers and/or special characters';
				$this->_displayMessage('lastname');
			}
			// Telephone Validation (preg_match numbers only) && (min=8 && max=12)
			if(!preg_match($telPattern,$dataBox['tel'],$matches)){
				$this->_msgTxt 	= '<strong>Error:</strong><br />Field "Телефон" contains letters and/or special characters!';
				$this->_displayMessage('tel');
			}else if(!filter_var($telLength, FILTER_VALIDATE_INT, $telOptions)){
				$this->_msgTxt 	= '<strong>Error:</strong><br />Field "Телефон" is with wrong length!';
				$this->_displayMessage('tel');
			}
			// Email Validation (FILTER_VALIDATE_EMAIL) && (min=5 && max=64)
			if(!filter_var($dataBox['email'], FILTER_VALIDATE_EMAIL)){
				$this->_msgTxt 	= '<strong>Error:</strong><br />The email is not valid one.';
				$this->_displayMessage('email');
			}else if(!filter_var($emailLength, FILTER_VALIDATE_INT, $emailOptions)){
				$this->_msgTxt 	= '<strong>Error:</strong><br />The email is one too long or to short!';
				$this->_displayMessage('email');
			}
			
			$this->_error 	= 0;
			return $dataBox;
		}else{
			$this->_msgTxt= '<strong>Error:</strong><br />There is an empty field in the register form!';
			$this->_displayMessage();
		}
		
	}
	
	private function _sendEmail($dataBox){
            /**
             * PHPMailer - check documentations for full options description
             */	
            $this->_phpMailer->From = "registerform@example.com";
            $this->_phpMailer->FromName = "Web Form Mail";
            $this->_phpMailer->CharSet = "utf-8";
            $this->_phpMailer->AddAddress("alex@example.com", "Alex");
            $this->_phpMailer->Subject = "Registration in your CCD form";
            $this->_phpMailer->Body = "The following information was recorded in the DB:"
                ."<p><ol>
                    <li>Name: {$dataBox[name]}</li>
                    <li>Lastname: {$dataBox[lastname]}</li>
                    <li>Tel: {$dataBox[tel]}</li>
                    <li>Email: {$dataBox[email]}</li>
                    <li>University: {$dataBox[university]}</li>
                    <li>Specialty: {$dataBox[specialty]}</li>
                    <li>Current course year: {$dataBox[current_year]}</li>
                    <li>Question Field: {$dataBox[question_field]}</li>
                  </ol>
                  </p>";
            $this->_phpMailer->IsHTML(true);
            if(!$this->_phpMailer->Send()){
                    $this->_error 	= 3;
                    $this->_msgTxt= '<strong>Error(phpMailer 501):</strong>
                            <br />Oops there was an error processing the data!';
                    $this->_displayMessage();
            }
	}
	
	private function _writeToDB(){
		$dataBox = $this->_getDataValidated();
		$recordQuery= 
			"INSERT INTO `registered` 
					(id,name,sirname,tel,email,university,specialty,current_year,question_field,created,ip) 
			VALUES  ('','{$dataBox[name]}','{$dataBox[lastname]}','{$dataBox[tel]}','{$dataBox[email]}','{$dataBox[university]}','{$dataBox[specialty]}','{$dataBox[current_year]}','{$dataBox[question_field]}',
							FROM_UNIXTIME({$dataBox[time]}),'{$dataBox[ip]}')"; //
		//die( json_encode(array(0=>0,1=>"{$recordQuery}")) );
		$recordResult = $this->_mysqli->query($recordQuery);
		if(!$recordResult){
			$this->_error 	= 3;
			$this->_msgTxt= '<strong>Error:</strong>
				<br />Something went wrong, please excuse us and come back litle later.'
                                . '<br>msg: ' . $this->_mysqli->error;
			$this->_displayMessage();
		}
		$this->_msgTxt= "
			<div class=\"alert alert-success\">
				<h2>You have successfully registered!</h2><br />"
                ."The following data was recored to our database:"
                ."<p><ol>
                    <li>Name: {$dataBox[name]}</li>
                    <li>Lastname: {$dataBox[lastname]}</li>
                    <li>Telephone: {$dataBox[tel]}</li>
                    <li>Email: {$dataBox[email]}</li>
                    <li>University: {$dataBox[university]}</li>
                    <li>Speciality: {$dataBox[specialty]}</li>
                    <li>Current year: {$dataBox[current_year]}</li>
                    <li>Answer: {$dataBox[question_field]}</li>
                  </ol>
                  <br /> Thank you for register, we will contact you in short notice.
                  <br /> Have a nice day! :)
                  </p>
			</div>";
		$this->_sendEmail($dataBox);
		$this->_displayMessage();
		
	}
	
}
?>
