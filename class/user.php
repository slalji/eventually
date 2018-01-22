<?php


 /*
  * Every registration form needs basic inputs, username password and all inputs need to be validated
  * and inserted finally into a database, therefore class allows oops functionality
  */
 class Users {
        public $id = null;
        public $email = null;
        public $password = null;
        public $fullname = null;
        public $salt = "Zo4rU5Z1YyKJAASY0PT6EUg7BBYdlEhPaNLuxAwU8lqu1ElzHv0Ri7EM6irpx5w";
        public $secret= 'M6irpx5w';
        public $errmsg_arr = array();
        private $table = U_TABLE;
         
	 
		 
	 public function __construct( $data = array() ) {
            if( isset( $data['email'] ) ) $this->email = stripslashes( strip_tags( $data['email'] ) );
            if( isset( $data['password'] ) ) $this->password = stripslashes( strip_tags( $data['password'] ) );
            if( isset( $data['fullname'] ) ) $this->fullname = stripslashes( strip_tags( $data['fullname'] ) );


	 }
	 
	 public function storeFormValues( $params ) {
		//store the parameters 
             
		$this->__construct( $params ); 
	 }
	 
	 public function userLogin() {
              
		 try{
                     
			$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
			$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = "SELECT fullname FROM $this->table WHERE email = :email  AND password = :password  LIMIT 1";
                      
			 
			$stmt = $con->prepare( $sql );
			$stmt->bindValue( "email", $this->email, PDO::PARAM_STR );
			$stmt->bindValue( "password", hash("sha1", $this->password . $this->salt), PDO::PARAM_STR );
			$stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

			$con = null; 
            return $data['fullname'];
			
		 }catch (PDOException $e) {
			  echo $e->getMessage()." userLogin";
			                 
            return false;
		 }
	 }
         
          public function validate(){
           
             try{
			$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
			$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = "SELECT email FROM $this->table WHERE email = :email LIMIT 1";
                       
			 
			$stmt = $con->prepare( $sql );
			$stmt->bindValue( "email", $this->email, PDO::PARAM_STR );
			$stmt->execute();
                        
                        $num_rows = $stmt->rowCount();
                        if ($num_rows >0 )
                             $this->errmsg_arr[] = "Username, <i>".$_POST['email']."</i>, already exists";
                        
                         //check password validity
                        $pwd = $this->password; 
                      /*   if(!preg_match((?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$), $_POST['password']):
                       * Could have used above regex to check password valid, but I wanted to send precise message to let 
                       * them know where they are wrong with their password
                       */
                      if (strlen($pwd) < 8) {
                           $this->errmsg_arr[] = "Password too short! Minimum of 8 characters";
                      }


                      if (!preg_match("#[0-9]+#", $pwd)) {
                           $this->errmsg_arr[] = "Password must include at least one number!";
                      }

                      if (!preg_match("#[a-zA-Z]+#", $pwd)) {
                           $this->errmsg_arr[] = "Password must include at least one letter!";
                      }     
                       //check password match
                       if( $pwd != $_POST['conpassword'] ) {
                      //echo "Password and Confirm password not match";
                               $this->errmsg_arr[] = "Password and Confirm password not match";
                       }  
                       if( $_POST['secret'] != $this->secret ) {
                      //echo "Password and Confirm password not match";
                               $this->errmsg_arr[] = "Invitation Code not match ";
                       } 
              
              return   $this->errmsg_arr;
             
                    
             }catch (PDOException $e) {
			  echo $e->getMessage()." validate username";                 
                    return false;
		 }
                    
            
              
             
         }
	 /*
          * randomize array of Mag  numbers and save them to user's database to ensure no survey is done twice
          */
	  public function register() {
           


        try{
			$con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD ); 
			$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			$sql = "INSERT INTO $this->table(email, password, fullname, date) VALUES(:email, :password, :fullname, now());";

                      

			$stmt = $con->prepare( $sql );
			$stmt->bindValue( "email", $this->email, PDO::PARAM_STR );
			$stmt->bindValue( "password", hash("sha1", $this->password . $this->salt), PDO::PARAM_STR );
            $stmt->bindValue( "fullname", $this->fullname, PDO::PARAM_STR );


              $stmt->execute();
              // login the register user if all good
              //$this->userLogin();

              return true;
                        
		 }catch (PDOException $e) {
			//echo $e->getMessage();
            //echo $e->getCode();
                  return $e->getMessage().' Err: :User::register() '.$e->getCode();
                       
		 }
          return false;
	 }
         


 }
 
?>