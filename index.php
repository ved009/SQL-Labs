<?php
include('head.php');


   class DB extends SQLite3
   {
      function __construct()
      {
         $this->open('ica-lab.db');
      }
   }
   $db = new DB();
   if(!$db){
      echo $db->lastErrorMsg();
   } 

function is_array_empty($arr){
  if(is_array($arr)){     
      foreach($arr as $key => $value){
          if(!empty($value) || $value != NULL || $value != ""){
              return true;
              break;
          }
      }
      return false;
  }
}
  
echo '';
		echo '<div id="left"><div class="main"><table align=center  cellspacing="0" cellpadding="0" style="border-collapse: collapse;border:0px;">
		<tr>
		<form method=post action="indexfinal.html">
		<td align=right style="padding:0px; border:0px; margin:0px;">
				<input type=submit name=home value="Home" class="side-pan">
		</td>
		<td  align=right style="padding:0px; border:0px; margin:0px;" >
				<input type=submit name=plans value="Hosting Plans" class="side-pan">
		</td>
		<td  align=left style="padding:0px; border-width:0px; margin:0px;">
				<input type=submit name=box value="Search Plans" class="side-pan">
		</td>
		<td  align=left style="padding:0px; border-width:0px; margin:0px;">
				<input type=submit name=us value="Who we are" class="side-pan">
		</td>
				</form></tr></table></div></div>
				<div id="right"></div><div align=center>';	
	

if(isset($_POST['us']))
	{
		echo '
<table width="100%" cellspacing="0" cellpadding="0" class="tb1" style=" border:0px;background-color: #191919; opacity: 0.6;" >
			
       <tr><td 
        align="center"><img src="images/who.jpg"></td><td 
         align="center" valign="top" rowspan="1"><font 
        color="red" face="comic sans ms"size="1"><br><font color=white >
        </font><br> <font color=#ff9933>
<font color=white></font><br>PWC SQL Labs<br><br>

       
						
           </table>
       </table> 
'; 

	}	
				
if(isset($_POST['box'])) 
{
	echo '<table width="50%" cellspacing="0" cellpadding="0" class="tb1" style="border: 0px; background-color: transparent; ">
		   <tr><td width="40%" align=center style="padding: 10px; background-color: #191919; opacity: 0.6;">
		   Hi, you can search your hosting plan according to following Tags <br>
		  <font color=#ff9933 > ubuntu,redhat,kali and windows</h4></td></tr><tr>
		  <td width="40%" align=center style="padding: 10px;">
		   <form method=post action="indexfinal.html" style="margin:10px;">
		   <input type=text name=tag style="padding: 5px;" value="ubuntu,windows etc..">
		   <br><br>
		   <input type=submit name=search value="Check Plan"></form>
			</td></tr></table>
		';
}		

if(isset($_POST['search']))
	{
		$sql = "SELECT * from info where Tag = '".trim($_POST['tag'])."';";
			$output = $db->query($sql);
			$row = $output->fetchArray(SQLITE3_ASSOC);
			
				if(is_array_empty($row))
				{
					echo '<table width="50%" cellspacing="0" cellpadding="0" class="tb1" style="opacity: 0.8;">
						   <tr><td width="30%" align=left style="padding: 10px;" >Your plan is available. <br> Write an email to  <font color=#ff9933 size=4>test@test.com</font> with your requirements.</td></tr></table>';
				}
				else 
				{
				echo '<table width="50%" cellspacing="0" cellpadding="0" class="tb1" style="opacity: 0.8;">
						   <tr><td width="30%" align=left style="padding: 10px;" >Your plan is not available. Write an email to<font color=#ff9933 size=4>support@test.com</font></td></tr></table>';	
				}
	}
		
if(isset($_POST['plans'])) 
{
	$sql ="SELECT * from info;";


   $output = $db->query($sql);
   echo '
   <table width="50%" cellspacing="0" cellpadding="0" class="tb1" style="opacity: 0.8;">
   <tr><td width="30%" align=center style="padding: 10px;" >Serial Number</td><td width="40%" align=center style="padding: 10px;">Operating system</td><td width="30%" align=center style="padding: 10px;">Price</td></tr></table>
   <table width="50%" cellspacing="0" cellpadding="0" class="tb1" style="margin:10px 2px 10px;opacity: 0.8;" ><tr>
   '; 
   while($row = $output->fetchArray(SQLITE3_ASSOC) )
		{
				echo '<td width="30%" align=center  style="padding: 5px;"><a href="?snumber='. $row['number'] . '">'. $row['number'] . '</a></td><td width="40%" align=center  style="padding: 5px;"><a href="?tag='. $row['Tag'] .'">'. $row['OS'] .'</a></td><td width="30%" align=center  style="padding: 5px;">'. $row['Price'] .'</td></tr>';
      	}
    $db->close();
} 

if(isset($_GET['snumber'])) 
		{
			$sql = "SELECT * from info where number = ".trim($_GET['snumber']).";";
			$output = $db->query($sql);
			$row = $output->fetchArray(SQLITE3_ASSOC);
				if(is_array_empty($row))
					{
						//print_r($all);
						echo '<div align=center>
						   <table width="50%" cellspacing="0" cellpadding="0" class="tb1" style="opacity: 0.8;">
						   <tr><td width="30%" align=left style="padding: 10px;" >Deatils for the selected hosting plan is following, Hopefully you will find it suitable for your requirement <br><div align=right>Hosting Service</div></td></tr></table>
						   <table width="30%" cellspacing="0" cellpadding="0" class="tb1" style="margin:10px 2px 10px;opacity: 0.8;" ><tr>'; 
								
									echo '<td width="60%" align=center  style="padding: 5px;">Default Operating system</td><td width="40%" align=left style="padding: 5px;color:#ff9933;">'. $row['OS'] .'</td></tr><tr><td width="60%" align=center  style="padding: 5px;">Monthly payment (in $)</td><td width="30%" align=left  style="padding: 5px; color:#ff9933;">'. $row['Price'] .'</td></tr><tr><td width="60%" align=center  style="padding: 5px;"> Assigned IP </td><td width="40%" align=left  style="padding: 5px; color:#ff9933;">'.$row['Server_IP'].' </td>';
								
					}
					else {
						echo "Serial number doesnot exist, Please enter the correct one";
					}
    $db->close();
		}

	
if(isset($_GET['tag'])) 
		{
			$sql = "SELECT * from info where Tag = '".trim($_GET['tag'])."';";
			$output = $db->query($sql);
			$row = $output->fetchArray(SQLITE3_ASSOC);
				if(is_array_empty($row))
					{
						echo '<div align=center>
						   <table width="50%" cellspacing="0" cellpadding="0" class="tb1" style="opacity: 0.8;">
						   <tr><td width="30%" align=left style="padding: 10px;" >The deatils for the selected hosting plan tag are following, hopefully you will find it suitable for your requirements <br><div align=right>-Hosting Service</div></td></tr></table>
						   <table width="30%" cellspacing="0" cellpadding="0" class="tb1" style="margin:10px 2px 10px;opacity: 0.8;" ><tr>'; 
								
									echo '<td width="60%" align=center  style="padding: 5px;">Default Operating system</td><td width="40%" align=left style="padding: 5px;color:#ff9933;">'. $row['OS'] .'</td></tr><tr><td width="60%" align=center  style="padding: 5px;">Monthly payment (in $)</td><td width="30%" align=left  style="padding: 5px; color:#ff9933;">'. $row['Price'] .'</td></tr><tr><td width="60%" align=center  style="padding: 5px;"> Assigned IP </td><td width="40%" align=left  style="padding: 5px; color:#ff9933;">'.$row['Server_IP'].' </td>';
					}
					else {
						echo "The tag name is inconnect. Please try again with available Tag :) ";
					}
    $db->close();
		}	
 echo "<font size=5 face=\"comic sans ms\" style=\"left: 0;bottom: 0; position: absolute;margin: 0px 0px 5px;\">Welcome to <font color=#ff9933>Hosting Service</font>. we provide affordable hosting servers ";
?>
