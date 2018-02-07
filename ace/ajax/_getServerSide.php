<?php
/*
 * Script:    DataTables server-side script for PHP and MySQL
 * Copyright: 2010 - Allan Jardine
 * License:   GPL v2 or BSD (3-point)
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

/* Array of database columns which should be read and sent back to DataTables. Use a space where
 * you want to insert a non-database field (for example a counter or static image)
 */
$aColumns = array( 'first_name', 'last_name', 'email', 'gender', 'ip_address' );

/* Indexed column (used for fast and accurate table cardinality) */
$sIndexColumn = "autoid";

/* DB table to use */
$sTable = "serverside";

/* Database connection information */
$gaSql['user']       = "root";
$gaSql['password']   = "roots";
$gaSql['db']         = "selcom_bridge";
$gaSql['server']     = "localhost";
require_once '../includes/db.php'; // The mysql database connection script


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
 * no need to edit below this line
 */

/*
 * MySQL connection

$gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
die( 'Could not open connection to server' );

mysql_select_db( $gaSql['db'], $gaSql['link'] ) or
die( 'Could not select database '. $gaSql['db'] );
*/

/*
 * Paging
 */
$sLimit = "";
if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
{
    $sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
        mysql_real_escape_string( $_GET['iDisplayLength'] );
}

$sOrder='';
/*
 * Ordering
 */
if ( isset( $_GET['iSortCol_0'] ) )
{
    $sOrder = "ORDER BY  ";
    for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
    {
        if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
        {
            $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
        }
    }

    $sOrder = substr_replace( $sOrder, "", -2 );
    if ( $sOrder == "ORDER BY" )
    {
        $sOrder = "";
    }
}


/*
 * Filtering
 * NOTE this does not match the built-in DataTables filtering which does it
 * word by word on any field. It's possible to do here, but concerned about efficiency
 * on very large tables, and MySQL's regex functionality is very limited
 */
$sWhere = "";
if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
{
    $sWhere = "WHERE (";
    for ( $i=0 ; $i<count($aColumns) ; $i++ )
    {
        $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
    }
    $sWhere = substr_replace( $sWhere, "", -3 );
    $sWhere .= ')';
}

/* Individual column filtering */
for ( $i=0 ; $i<count($aColumns) ; $i++ )
{
    if ( isset($_GET['aSearch']) &&  isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
    {
        if ( $sWhere == "" )
        {
            $sWhere = "WHERE ";
        }
        else
        {
            $sWhere .= " AND ";
        }
        $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
    }
}


/*
 * SQL queries
 * Get data to display
 */
$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";
//$rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
$rResult = $mysqli->query($sQuery) or die($mysqli->error.__LINE__);

/* Data set length after filtering */
$fQuery = "
		SELECT FOUND_ROWS()
	";
//$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
//$rResultFilterTotal = $mysqli->query($sQuery) or die($mysqli->error.__LINE__);
//$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
//$aResultFilterTotal = $rResultFilterTotal->fetch_assoc();
//$iFilteredTotal = sizeof($aResultFilterTotal);

$rResultFilterTotal = $mysqli->query($fQuery) ;

    /* determine number of rows result set */
$aResultFilterTotal = $rResultFilterTotal->fetch_array();
$iFilteredTotal = $aResultFilterTotal[0];

/* Total data set length */
$cQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
$rResultTotal = $mysqli->query($cQuery) or die($mysqli->error.__LINE__);
//$aResultTotal = mysql_fetch_array($rResultTotal);
//$iTotal = $aResultTotal[0];
$aResultTotal = $rResultTotal->fetch_array();
$iTotal = $aResultTotal[0];


/*
 * Output
 */
$echo ='1';
if (isset($_GET['sEcho']))
    $echo = $_GET['sEcho'];
$output = array(
    'query' => $sQuery,
    "draw" => intval($echo),
    "recordsTotal" => $iTotal,
    "recordsFiltered" => $iFilteredTotal,
    "data" => array()
);

//while ( $aRow = mysql_fetch_array( $rResult ) )
while($aRow = $rResult->fetch_assoc())
{
    $row = array();
    for ( $i=0 ; $i<count($aColumns) ; $i++ )
    {
        if ( $aColumns[$i] == "version" )
        {
            /* Special output formatting for 'version' column */
            $row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
        }
        else if ( $aColumns[$i] != ' ' )
        {
            /* General output */
            $row[] = $aRow[ $aColumns[$i] ];
        }
    }
    $output['data'][] = $row;
}

echo json_encode( $output );
?>