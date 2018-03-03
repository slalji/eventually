<?php
require_once './includes/db.php'; // The mysql database connection script


 /*
  * Every registration form needs basic inputs, username password and all inputs need to be validated
  * and inserted finally into a database, therefore class allows oops functionality
  */
 class Summary {


	 private $con='';
     private $groupid='';

     private $total_groups;
     private $avg_group_age_per_days;
     private $total_members;
     private $total_payins;
     private $total_repayments;
     private $funds_available;
     private $loan_bal_outstanding;
     private $avg_loan_amount;
     private $total_loans_disbursed;
     private $loans_outstanding;
     private $loans_past_due;
     private $avg_group_interest_rate_per_2wks;
     public $conn =null;

	 public function __construct( $data = array() ) {
        /* $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.'';
         $this->con = new PDO( $dsn, DB_USER, DB_PASS );
         $this->con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
         */
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if( isset( $data['groupid'] ) ) $this->groupid = stripslashes( strip_tags( $data['group'] ) );
	 }
	 
	 public function storeFormValues( $params ) {
		//store the parameters 

		$this->__construct( $params ); 
	 }
    /* private function savings()
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
   */
  function fundsAvailable($groupid){
	$querys = "SELECT SUM(totalsavings) FROM cbsg_account WHERE statuscode!='D' AND groupid='$groupid'";
    $results =  $this->conn->query($querys) or die( $this->conn->error.__LINE__);      
        
    $savings = $results->fetch_array();

	$queryl = "SELECT SUM(principal_due), SUM(charge_due) FROM cbsg_loan WHERE status='DUE' AND groupid='$groupid'";
	$resultl =  $this->conn->query($queryl) or die( $this->conn->error.__LINE__);      
    $loan = $resultl->fetch_array();

	$queryg = "SELECT interest_collected FROM savings_group WHERE id='$groupid'";
    $resultg =  $this->conn->query($queryg) or die( $this->conn->error.__LINE__);      
        
    $revenue_collection = $resultg->fetch_array();

	$funds_available = ($savings[0] + $revenue_collection[0]) - $loan[0];
	return $funds_available;
}
     function weekly_report(){
        //mysql_query("UPDATE cbsc_account SET status='D' WHERE msisdn like '%_DEL'");
        //mysql_query("UPDATE cbsc_customer SET status='D' WHERE msisdn like '%_DEL'");
    
        $query = "SELECT groupid,DATEDIFF(NOW(),fulltimestamp), loan_service_charge FROM savings_group WHERE initiated=1";
        $result =  $this->conn->query($query) or die( $this->conn->error.__LINE__);      
        $group_arr = array();
        $total_days = 0;
        $total_interest = 0;
        $funds_available = 0;
        while($row = $result->fetch_array()){
            array_push($group_arr, $row[0]);
            $total_days += $row[1];
            $total_interest +=$row[2];
            $funds_available += $this->fundsAvailable($row[0]);
    
        }
        $funds_available = number_format($funds_available);
    
        $groups = implode(',', $group_arr);
        $total_groups = count($group_arr);
        $average_group_avg = number_format($total_days/$total_groups,0);
        $average_interest =  number_format($total_interest/$total_groups,2);
    
        $query = "SELECT count(id), SUM(totalsavings) FROM cbsg_account WHERE statuscode!='D' AND groupid in ($groups) ";
        //echo $query;
        $result =  $this->conn->query($query) or die( $this->conn->error.__LINE__);
        $row = $result->fetch_array();
        $total_members = intval($row[0]);
        $total_savings = number_format($row[1],2);
    
        $query = "SELECT count(id), SUM(principal), SUM(charge) FROM cbsg_loan  WHERE groupid in ($groups)"; //AND groupid in ($groups)
        $result =  $this->conn->query($query) or die( $this->conn->error.__LINE__);
        $row = $result->fetch_array();
        $total_loan = doubleval($row[1] + $row[2]);
        $loans_outstanding  = intval($row[0]);
        $avg_loan_amount = number_format(($total_loan/$loans_outstanding), 0);
        $total_loan_balance = number_format($total_loan, 0);
    
    
        $query = "SELECT count(id), SUM(principal_due), SUM(charge_due) FROM cbsg_loan WHERE status='DUE' AND duedate<NOW() AND groupid in ($groups)"; //AND groupid in ($groups) 
        $result =  $this->conn->query($query) or die( $this->conn->error.__LINE__);
        $row = $result->fetch_array();
        $loans_past_due = $row[0];
    
        $query = "SELECT count(id), SUM(amount) FROM transactions WHERE service='MEMCASHIN' and tstatuscode='200'"; //AND groupid in ($groups) 
        $result =  $this->conn->query($query) or die( $this->conn->error.__LINE__);
        $row = $result->fetch_array();
        $total_payins = number_format($row[1]);
        $total_no_payins = $row[0];
    
        $query = "SELECT count(id), SUM(amount) FROM transactions WHERE service='MEM_LOANREPAY' and tstatuscode='200'"; //AND groupid in ($groups) 
        $result =  $this->conn->query($query) or die( $this->conn->error.__LINE__);
        $row = $result->fetch_array();
        $total_loanrepay = number_format($row[1]);
        $total_no_loanrepay = $row[0];
    
        $query = "SELECT count(id) FROM cbsg_loan";
        $result =  $this->conn->query($query) or die( $this->conn->error.__LINE__);
        $row = $result->fetch_array();
        $total_loans_disbursed = $row[0];
    
    
    
        $this->total_groups = $total_groups;
        $this->avg_group_age_per_days = $average_group_avg;
        $this->total_members = $total_members;
        $this->total_payins = $total_payins;
        $this->total_repayments =  $total_loanrepay;
        $this->funds_available = $funds_available;
        $this->loan_bal_outstanding = $total_loan_balance;
        $this->avg_loan_amount = $avg_loan_amount;
        $this->total_loans_disbursed = $total_loans_disbursed;
        $this->loans_outstanding = $loans_outstanding;
        $this->loans_past_due = $loans_past_due;
        $this->avg_group_interest_rate_per_2wks = $average_interest;   
    
    }
    function getTotalGroups(){
        return $this->total_groups;
    }
    function getAvgGroupAgeInDays(){
        return $this->avg_group_age_per_days;
    }
    function getTotalMembers(){
        return $this->total_members;
    }
    function getTotalPayIns(){
        return $this->total_payins;
    }
    function getTotalRepayments(){
        return  $this->total_repayments;
    }
    function getFundsAvailable(){
        return $this->funds_available;
    }
    function getLoanBalanceOutstanding(){
        return $this->loan_bal_outstanding;
    }
    function getAvgLoanAmount(){
        return $this->avg_loan_amount;
    }
    function getTotalLoansDistributed(){
        return $this->total_loans_disbursed;
    }
    function getTotalLoansOutstanding(){
        return $this->loans_outstanding;
    }
    function getLoansPastDue(){
        return $this->loans_past_due;
    }
    function getAvgGroupInterestRate2wks(){
        return $this->avg_group_interest_rate_per_2wks;
    }
    




 }
 
?>