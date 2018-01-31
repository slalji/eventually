<?php
require_once './includes/db.php'; // The mysql database connection script


 /*
  * Every registration form needs basic inputs, username password and all inputs need to be validated
  * and inserted finally into a database, therefore class allows oops functionality
  */
 class Summary {


	 private $con='';
     private $groupid='';

	 public function __construct( $data = array() ) {
         $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.'';
         $this->con = new PDO( $dsn, DB_USER, DB_PASS );
         $this->con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
         if( isset( $data['groupid'] ) ) $this->groupid = stripslashes( strip_tags( $data['group'] ) );
	 }
	 
	 public function storeFormValues( $params ) {
		//store the parameters 

		$this->__construct( $params ); 
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
     public function funds_available(){
         //$savings[0] + $revenue_collection[0]) - $loan[0];
         $savings = $this->savings();
         $loan = $this->loan();
         $revenue_collection = $this->revenue_collection();
         $funds_available = ($savings + $revenue_collection) - $loan;
         return $funds_available;
     }
     public  function totalGroups(){
         try{
             $query="SELECT groupid FROM `transactions` group by groupid  ";
             $stmt = $this->con->prepare($query);
             $stmt->execute();
             $row_num = $stmt->rowCount();
             if ($stmt->rowCount()>0)
                 return $row_num;
         }
         catch (PDOException $ex){
             return $ex->getMessage();
         }

     }
     public function numLoanspastdue()
     {


         $queryl = "SELECT SUM(principal_due) p, SUM(charge_due) c FROM cbsg_loan WHERE status=:status ";
         //$loan = mysql_fetch_row(mysql_query($queryl));
         try {
             $stmt = $this->con->prepare($queryl);
             $stmt->bindValue("status", 'DUE');
             $stmt->execute();
             $num = $stmt->rowCount();
             return $num;
         }
         catch (PDOException $e) {
             echo $e->getMessage()." numLoanspastdue";

             return false;

         }
     }
     public function totalMembers()
     {

         $querys = "SELECT msisdn  FROM `cbsg_account` WHERE statuscode!=:statuscode";
         //$savings = mysql_fetch_row(mysql_query($querys));
         try {
             $stmt = $this->con->prepare($querys);
             $stmt->bindValue("statuscode", 'D', PDO::PARAM_STR);
             $stmt->execute();
             $num = $stmt->rowCount();
             return $num;
         }
         catch (PDOException $e) {
             echo $e->getMessage()." userLogin";

             return false;

         }
     }




 }
 
?>