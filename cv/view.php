<?php
session_start();
if (isset($_SESSION['login_id'])) {
include('../admin/db_connect.php');
$id = $_GET['id'];
//$id = $_SESSION['cv_id'];  WHERE cv.id = '$id'
$sql = $conn->query("SELECT cv.*, alumnus_bio.* FROM cv INNER JOIN alumnus_bio ON alumnus_bio.id = cv.user_id WHERE cv.id = '$id'");

$row=$sql->fetch_assoc();

$fullname = $row['firstname']." ".$row['middlename']." ".$row['lastname'];
require_once('vendor/TCPDF/tcpdf.php'); 

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// IMPORTANT: disable font subsetting to allow users editing the document
$pdf->setFontSubsetting(false);

// set font
$pdf->SetFont('helvetica', '', 10, '', false);

// add a page
$pdf->AddPage();

/*
It is possible to create text fields, combo boxes, check boxes and buttons.
Fields are created at the current position and are given a name.
This name allows to manipulate them via JavaScript in order to perform some validation for instance.
*/

// set default form properties
$pdf->setFormDefaultProp(array('lineWidth'=>1, 'borderStyle'=>'solid', 'fillColor'=>array(255, 255, 200), 'strokeColor'=>array(255, 128, 128)));

$pdf->SetFont('helvetica', 'B', 20);
$pdf->Cell(0, 5, $fullname, 0, 1, 'C');
$pdf->Ln(2);

$pdf->SetFont('helvetica', '', 12);


$pdf->Cell(0, 5, $row['contact']. " - ". $row['email'],0,1,'C');
$pdf->Ln(2);
$pdf->Cell(0, 5, $row['address'],0,1,'C');
$pdf->Ln(8);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(35, 5, 'Objective:',0,.5,'');
$html = "<br><hr>";
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Ln(1);

$html = "<label>".$row['objectives']."</label>";
$pdf->SetFont('helvetica', '', 12);
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Ln(6);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(35, 5, 'Work Experience:',0,.5,'');
$html = "<br><hr>";
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Ln(1);

$html = "<label><strong>".$row['job_title']."</strong></label><br>
         <label>".$row['emp']."</label><br>
         <label><em>".$row['sdate']." to ".$row['edate']."</em></label>
";
$pdf->SetFont('helvetica', '', 11);
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Ln(6);


//---- Education
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(35, 5, 'Education',0,.5,'');
$html = "<br><hr>";
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Ln(1);

$html = "<label><strong>".$row['course']."</strong></label><br>
         <label>Graduated ".$row['batch']."</label><br>
        
";
$pdf->SetFont('helvetica', '', 11);
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Ln(6);

//---Skills

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(35, 5, 'Skills',0,.5,'');
$html = "<br><hr>";
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Ln(1);

$html = "<label>".$row['skills']."</label><br>
       
        
";
$pdf->SetFont('helvetica', '', 11);
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Ln(6);

//--Character references

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(35, 5, 'Character References',0,.5,'');
$html = "<br><hr>";
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Ln(1);

$html = "<label>".$row['ref_1']."</label><br>
       
        
";
$pdf->SetFont('helvetica', '', 11);
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Ln(2);

$html = "<label>".$row['ref_2']."</label><br>
       
        
";
$pdf->SetFont('helvetica', '', 11);
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Ln(2);

$html = "<label>".$row['ref_3']."</label><br>
       
        
";
$pdf->SetFont('helvetica', '', 11);
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Ln(2);


$js = <<<EOD
function CheckField(name,message) {
    var f = getField(name);
    if(f.value == '') {
        app.alert(message);
        f.setFocus();
        return false;
    }
    return true;
}
function Print() {
    if(!CheckField('firstname','First name is mandatory')) {return;}
    if(!CheckField('lastname','Last name is mandatory')) {return;}
    if(!CheckField('gender','Gender is mandatory')) {return;}
    if(!CheckField('address','Address is mandatory')) {return;}
    print();
}
EOD;

// Add Javascript code
$pdf->IncludeJS($js);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_014.pdf', 'I');

}else{
    header('location: index.php');
}
//============================================================+
// END OF FILE
//============================================================+