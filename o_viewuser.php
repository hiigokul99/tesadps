<?php
include('officerheader.php');
?>

<div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Users List</h1>
                    </div>
              



<?php

$query = mysql_query('select * from userreg');
if (!$query)
{
    $message = 'ERROR:' . mysql_error();
    return $message;
}
else
{
    echo '<table border=1 align=center style="width:80%"><tr>';
    echo "<th align=center>User ID</th><th align=center>Photo</th><th align='center'>Name</th><th align=center>Verification Status</th>";

	$maxq =mysql_query("select max(user_id) as max from userreg");
	$w = mysql_fetch_array( $maxq );
	if($w['max']>=0)
		{
		$maxvalue = $w['max'];
		}
	else 
	    $maxvalue = 1;

	$rr = mysql_fetch_array($query);
	$unique_id = 1;
	$val='APuser';
	while ($unique_id<=$maxvalue)
	{
		echo '<tr>';
		$count = count($rr);
		$q = mysql_query("select * from userreg where user_id = '".$unique_id."'");
		$r = mysql_fetch_array($q);
		$y = 0;
		if($r['user_id']!="")
		{
    		while ($y <= $count)
        	{
        		if($y==0)
        		{
          echo '<td align=center>' . $r['user_id'] . '</td>';
          
        }
      
      if($y==3)
        {
          
          if ($r['image'] != "")
            {
              
              echo "<td><img src=userdocs/".$unique_id."_profilepic.jpg height='150' width='150'></td>";
            }
          else
            {
                echo "<td><img src=userdocs/default.jpg height='150' width='150'></td>";
            }
          
        }
      if($y==4)
        {
          echo '<td align=center>' . $r['name'] . '</td>';
        }
      if($y==5)
        {
          
        	$q2 = mysql_query("select * from userreg where user_id = '".$unique_id."'");
			$r2 = mysql_fetch_array($q2);
        	if($r2['user_status'] == '0')
        	{
        		echo '<td align=center>Not Verified</td>';
        	}
        	else
        	{
        		echo '<td align=center>Verified</td>';
        	}
         
          
        }
      
      $y = $y + 1;

        }
      }
        $unique_id = $unique_id + 1;
      }

	echo '</tr>';
 }
echo '</table>';
mysql_free_result($query);





?>








  </div>

<?php
include('footer.php');
?>