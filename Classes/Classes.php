<?php
require_once "../Classes/DBConnect.php";

class Classmanager {

    public function geturldetails() {
        $con = DBConnect::getConnection();
        $sql = "Select * from `urls` ";
        $result = mysql_query($sql, $con) or die(mysql_error());
        $i=0;
        $url = array();
        while ($row = mysql_fetch_assoc($result)) {
             $url[$i]['id'] = $row["id"];
             $url[$i]['url'] = $row["url"]; 
             $url[$i]['clicks'] = $row["clicks"];
             $i++;
        } 
        mysql_close($con);
        return $url;
    } 
    public function getshorturl($id) {
        $con = DBConnect::getConnection();
        $date = date("Y-m-d");
        $sql = "Select clicks,url from `urls` where id ='$id'";
        $results = mysql_query($sql, $con) or die(mysql_error());
        $row = mysql_fetch_array($results, MYSQL_BOTH);
        $clickcount = $row['clicks'];
        $URL = $row['url'];
        $clicks = $clickcount + 1 ;

        $query = "update urls set clicks='$clicks' where id ='$id'";
        $results = mysql_query($query, $con) or die(mysql_error());

        if ($results) {
            return $URL;
        }
    } 

    public function addurl($url) {
        
        $con = DBConnect::getConnection();
        $date = date("Y-m-d");
        $newurl = mysql_real_escape_string($url);
        $sql = "INSERT INTO urls (url, added_date) VALUES ('$newurl', '$date')";
        $results = mysql_query($sql, $con) or die("couldn't execute the sql");

        if ($results) {
            return 'added';
        } else {
            return 'failed';
            //test
        }
    }  

}


?>