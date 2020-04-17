<?php
$error=false;
if(!include_once('class/page.class.php'))
{

	$error=true;
	$msg="File not found";
}
if(!include_once('inc/connect.php'))
{

	$error=true;
	$msg.="File not found";
}
if(!include_once('class/Form.php'))
{

	$error=true;
	$msg.="Fil not found";
}
if($error)
{
	die("Error loading files");
}
if(isset($_POST['ipno']))
{
	die($_POST['ipno']);

}

$page=new Page("Insurance Medical Services");

$page->doctype ('html','strict');
$page->access("sunil");

$page->title ( "ESI clearance" );
$page->description ( "DIMs");

$form=new Form('ips');
$form->required(array('ipno','ipname','dob'));
$html.=$form->header("form1","POST","mrc.php");
$html.=$form->field('text','ipno','Ins No  ');
$html.="<br />";
$html.=$form->field('text','ipname','Name  ');
$html.="<br />";
$html.=$form->field('calendar','dob','Date of Birth  ');
$html.="<br />";
$html.=$form->field('radio','gender','Gender',array('M'=>'Male','F'=>'Female'));

$html.="<br />";

$html.=$form->field('textarea','address','Address<br />',array('width'=>250,'height'=>50));
$html.="<br />";
$html.=$form->field('text','lo','Local Office');
$html.="<br />";
if (!include_once("class/connection.class.php"))
{
	die('file not found');

}
$ab=new connect();
$msg='';
if(!$ab->connection($msg))
{
	die($msg);

}
$qry="select distinct orgid, organization from organizations"; 
$result=mysqli_query($qry) or die("error");

while($row=mysqli_fetch_assoc($result))
{
	
	$arr[$row['orgid']]=$row['organization'];

}


//print_r($arr);
$html.=$form->field('select','dispensary','Dispensary',$arr);
$html.=$form->close();

echo $page->display($html);
//list($vars, $errors, $eject)=$form->validate('form1');
//print_r($vars);
?>