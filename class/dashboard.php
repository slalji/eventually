<?php


 /*
  * Every registration form needs basic inputs, username password and all inputs need to be validated
  * and inserted finally into a database, therefore class allows oops functionality
  */
 class Dashboard {

	 private $con='';
     private $groupid='';
 //$funds_available = ($savings[0] + $revenue_collection[0]) - $loan[0];
		 
	 public function __construct( $data = array() ) {
         $this->con = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
         $this->con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
         if( isset( $data['groupid'] ) ) $this->groupid = stripslashes( strip_tags( $data['group'] ) );
	 }
	 
	 public function storeFormValues( $params ) {
		//store the parameters 

		$this->__construct( $params ); 
	 }
     public function funds_available(){
         //$savings[0] + $revenue_collection[0]) - $loan[0];
         $savings = $this->savings();
         $loan = $this->loan();
         $revenue_collection = $this->revenue_collection();
         $funds_available = ($savings + $revenue_collection) - $loan;
         return $funds_available;
    }
     private function savings()
     {

         $querys = "SELECT SUM(totalsavings) s FROM cbsg_account WHERE statuscode!=:statuscode";
         //$savings = mysql_fetch_row(mysql_query($querys));
         try {
             $stmt = $this->con->prepare($querys);
             $stmt->bindValue("statuscode", 'D', PDO::PARAM_STR);
             $stmt->execute();
             $savings = $stmt->fetch(PDO::FETCH_ASSOC);
             return $savings['s'];
         }
        catch (PDOException $e) {
             echo $e->getMessage()." userLogin";

             return false;

        }
     }
     private function loan()
     {


         $queryl = "SELECT SUM(principal_due) p, SUM(charge_due) c FROM cbsg_loan WHERE status=:status ";
         //$loan = mysql_fetch_row(mysql_query($queryl));
         try {
             $stmt = $this->con->prepare($queryl);
             $stmt->bindValue("status", 'DUE');
             $stmt->execute();
             $loan = $stmt->fetch(PDO::FETCH_ASSOC);
             return $loan['p']-$loan['c'];
         }
         catch (PDOException $e) {
             echo $e->getMessage()." loan";

             return false;

         }
     }
     private function revenue_collection()
     {


         $queryg = "SELECT interest_collected i FROM savings_group ";
        // $revenue_collection = mysql_fetch_row(mysql_query($queryg));
         try {
             $stmt = $this->con->prepare($queryg);
             $stmt->execute();
             $rev = $stmt->fetch(PDO::FETCH_ASSOC);
             return $rev['i'];
         }
         catch (PDOException $e) {
             echo $e->getMessage()." revenue collection";

             return false;

         }
     }




 }
 
?>