
<?php
//checks if the form has been submitted
if (isset($_POST['submit'])){
//variable definitions
//headers for csv
$headers = array("Phone Number", "Carrier", "Status");
$phoneNo = $_POST['phoneNo'];
$carrier = $_POST['carrier'];
$NoOfPN=count($phoneNo);
for($x=0;$x<$NoOfPN;$x++)
    
    {
   //pattern for valid Uk number
    $pattern = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";
//checks if phone number matches the uk phone number pattern
$match = preg_match($pattern, $phoneNo[$x]);
//if it does then it will be valid and will display carrier
if ($match != false) {
    $status[$x] = "Valid";
    print "<h2>Phone Number:".$phoneNo[$x]."</h2><br>";
    print "Carrier:".$carrier[$x]."<br>";
   echo "Status:".$status[$x]."<br/><br/>";

} 
//if not then it will be a non uk number and carrier will not be displayed
else {
   $status[$x] = "Non Uk";
   print "<h2>Phone Number:".$phoneNo[$x]."</h2><br>";
   $carrier[$x] = null;
   print "Carrier:".$carrier[$x]."</h2><br>";
   echo "Status:".$status[$x]."<br/><br/>";
   
}

//stores the data of phone number, carrier and status into array
$data[$x]= array (
   array(
        "Phone Number" => $phoneNo[$x],
        "Carrier" => $carrier[$x],
        "Status" => $status[$x]
        
    ),
   
);
}
if($_POST['csv'] == 'Csv'){
//opens/creates a csv file
$fh = fopen("file.csv", "w");
//puts headers into csv file
fputcsv($fh, $headers);
//repeats until all data has been added
for($r=0;$r<$NoOfPN;$r++){
//puts all of the values from the array called data into fiels to go under each appropriate header
foreach($data[$r] as $fields) {
    fputcsv($fh, $fields);
}
}

fclose($fh);
}

}