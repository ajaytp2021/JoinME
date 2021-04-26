<?php
require '../php/con.php';
require '../global/global.php';
require '../php/username.php';
require '../php/server/server.php';
require '../php/TCPDF/tcpdf.php';
session_start();
error_reporting(E_ALL);
isset($_SESSION['cid']) ? $id = $_SESSION['cid'] : $id = "";
date_default_timezone_set('Asia/Kolkata');
$getposts = "select posts.pTitle, posts.tExp, posts.duration, posts.pDate, (select sum(NoUsers) from prjSkills where prjSkills.PId=posts.PId and prjSkills.CId=posts.CId) as totalemp, (select companyProjects.status from companyProjects where companyProjects.CId=posts.CId and companyProjects.PId=posts.PId ) as onwork from posts where CId=".base64_decode($id);
$getcname = "select cname from company where CId=".base64_decode($id);
$res = mysqli_query($con, $getcname);
$cname = mysqli_fetch_array($res)['cname'];
$totalexpongoing = 0;
$totalexpcompleted = 0;
$overallexpense = 0;
$html = '
<p style="text-align: center;"><span style="text-decoration: underline;">Computer Generated Report about your complete Projects</span></p>
<p style="text-align: right;">Company : '.$cname.'</p>
<p style="text-align: right;">Generated on : '.date('d M Y').'</p>
<p style="text-align: right;">Time : '.date('h:m:s A').'</p>
<p style="text-align: center; width: 100%; font-weight: bold"><u>Ongoing Projects</u></p>
<table border="1" style="margin-left: auto; margin-right: auto;">
<thead style="font-weight: bold">
<tr style="font-weight: bold">
<th style="width: 50px">Slno.</th>
<th style="width: 160px">Project</th>
<th>Posted Date</th>
<th>Duration</th>
<th>Total Exp.</th>
<th style="width: 50px">Users</th>
<th>Status</th>
</tr>
</thead>
<tbody>';

if($res = mysqli_query($con, $getposts)){
    $c = 1;
    $totalcount1 = 0;
    while($row = mysqli_fetch_array($res)){
        $overallexpense = $overallexpense + $row['tExp'];
        if(count($row) != 0){
        if($row['onwork'] == null || $row['onwork'] == 1){
        $totalexpongoing = $totalexpongoing + $row['tExp'];
        $html .= '<tr>
        <td style="width: 50px">'.$c.'</td>
        <td style="width: 160px">'.$row['pTitle'].'</td>
        <td>'.$row['pDate'].'</td>
        <td>'.$row['duration'].'</td>
        <td>'.$row['tExp'].'</td>
        <td style="width: 50px">'.$row['totalemp'].'</td>
        <td>';
        if($row['onwork'] == null){
            $html .= 'Not started';
        }else{
            $html .= 'Started';
        }
        $html .='</td>
        </tr>';
        $c = $c + 1;
    }
}else{
    if($totalcount1 == 0){
        $html .= '<tr>
        <td colspan="7" style="text-align: center; padding: 10px;">No completed projects are available</td>
        </tr>';
        }
}
$totalcount1 = $totalcount1 + 1;
    }
}
$html .= '</tbody>
</table>
<p style="text-align: right; font-weight: bold; font-size: 12; color: gray">Total expecting expense ongoing : Rs.'.$totalexpongoing.'</p><br><br><br>';




$html .= '<p style="text-align: center; width: 100%; font-weight: bold"><u>Completed Projects</u></p>
<table border="1" style="margin-left: auto; margin-right: auto;">
<thead style="font-weight: bold">
<tr style="font-weight: bold">
<th style="width: 50px;">Slno.</th>
<th style="width: 160px">Project</th>
<th>Posted Date</th>
<th>Duration</th>
<th>Total Exp.</th>
<th style="width: 50px">Users</th>
<th>Status</th>
</tr>
</thead>
<tbody>
';

if($res1 = mysqli_query($con, $getposts)){
    $c1 = 1;
    $tc = 0;
    while($row1 = mysqli_fetch_array($res1)){
        if(count($row1) != 0){
        if($row1['onwork'] == 2){
        $totalexpcompleted = $totalexpcompleted + $row1['tExp'];
        $html .= '<tr>
        <td style="width: 50px">'.$c1.'</td>
        <td style="width: 160px">'.$row1['pTitle'].'</td>
        <td>'.$row1['pDate'].'</td>
        <td>'.$row1['duration'].'</td>
        <td>'.$row1['tExp'].'</td>
        <td style="width: 50px">'.$row1['totalemp'].'</td>
        <td>';
        if($row1['onwork'] == 2){
            $html .= 'Not started';
        }
        $html .='</td>
        </tr>';
        $c1 = $c1 + 1;
    }
}else{
    if($tc == 0){
        $html .= '<tr>
        <td colspan="7" style="text-align: center; padding: 10px;">No completed projects are available</td>
        </tr>';
        }
}
    $tc = $tc + 1;
    }
}
$html .= '</tbody>
</table>
<p style="text-align: right; font-weight: bold; font-size: 12; color: gray">Total expense of completed projects : Rs.'.$totalexpcompleted.'</p>
<p style="text-align: right; width: 100%; font-weight: bold; font-size: 15px">Overall expense expected : '.$overallexpense.'</p>
';



class MyCustomPDFWithWatermark extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        // $image_file = K_PATH_IMAGES.'logo_example.jpg';
        // $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 25);
        // Title
        $this->Cell(0, 15, 'JoinME', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MyCustomPDFWithWatermark('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('JoinME');
$pdf->SetTitle('Generated Report');
// $pdf->SetSubject('TCPDF Tutorial');
// $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont('helvetica');

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(20);
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

// set font
$pdf->SetFont('times', 12);

// add a page
$pdf->AddPage();

// set some text to print
$html;

// print a block of text using Write()
$pdf->WriteHTML($html);

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output("GeneratedReport.pdf");


?>