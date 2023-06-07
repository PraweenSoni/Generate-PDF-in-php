<!-- Download mpdf library and fpdf(www.fpdf.org) form github.
Also create data base so fetch and convert pdf. -->
<?php
require('file path of your mpdf library/autoad.php');
$conn = mysqli_connect('localhost','root','root','database');
$res = mysqli_query($conn,"select * from user");
 if (mysql_num_rows($res)>0) {
  $html = '<style>body{background-color:red;}</style><table>';
    $html.= '<tr><td>ID</td><td>NAME</td><td>EMAIL</td></tr>';
    while($row = mysqli_fetch_assoc($res)){
    $html.='<tr><td>'.$row['id'].'</td><td>'.$row['name'].'</td><td>'.$row['email'].'</td></tr>';
    }
  $html = '</table>';
  
 }
 else {
  $html = "Data not Found.";
 }
 $mpdf = new \Mpdf\Mpdf();
 $mpdf ->WriteHTML($html);
 $file=time().'.pdf';
 $mpdf ->output($file,'D'); //D is parameter of this library we also have more parameter.
 /* D parameter for download PDF.
    I parameter for pdf preview on browser.
    F parameter for download pdf on folder silent (no show).
    $file = 'your_choice_folder_name/'.time().'.pdf';
    S parameter for you can store pdf data into variable(try for better understanding).
    echo ($mpdf ->output($file,'S'));
 */
 if (!empty($_POST['submit'])) {
 $name = $_POST('name');
 $rollno = $_POST('rollno');
 $subject = $_POST('subject');
 $fees = $_POST('fees');
 
 require("fpdf/fpdf.php");
 $fpdf = new FPDF();
 $fpdf ->Addpage();
 $fpdf ->SetFont("Arial","",12);
 $fpdf->Cell(0,10,"registration Details",1,1,'C');
 $fpdf ->Cell(20,10,"Roll no.",1,0);
 $fpdf ->Cell(45,10,"Name",1,0);
 $fpdf ->Cell(45,10,"Subject",1,0);
 $fpdf ->Cell(20,10,"Fees",1,1);
 
 $fpdf ->Cell(20,10,$rollno,1,0);
 $fpdf ->Cell(45,10,$name,1,0);
 $fpdf ->Cell(45,10,"$subject",1,0);
 $fpdf ->Cell(20,10,$fees,1,0);
 $file = time().'pdf';
 $fpdf ->outout($file,'D');
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Generate PDF.</title>
  
  <link rel="stylesheet" href="style.css">
</head>

<body>
 
  <script src="main.js"></script>
</body>
</html>