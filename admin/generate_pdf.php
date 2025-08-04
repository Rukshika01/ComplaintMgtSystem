<?php
require '../core/session.php';
require '../core/config.php';
require '../core/admin-key.php';
require_once('../tcpdf/tcpdf.php');

// Get the message ID from the URL
$message_id = $_GET['id'];

// Fetch case details from updatecase table based on message_id
$case_query = "SELECT * FROM updatecase WHERE message_id='$message_id'";
$case_result = mysql_query($case_query);
if (!$case_result) {
    die("Error: " . mysql_error());
}

// Create new PDF instance
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Case Details');
$pdf->SetSubject('Case Details PDF');
$pdf->SetKeywords('CMS, PDF, case, details');


// Set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// Set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Add a page
$pdf->AddPage();

// Set some content to display
$html = '<h1>Case Details</h1>';
$html .= '<table border="1">';
$html .= '<tr><th>Status</th><th>Notes</th></tr>';
while ($case_data = mysql_fetch_array($case_result)) {
    $html .= '<tr>';
    $html .= '<td>' . $case_data['status'] . '</td>';
    $html .= '<td>' . $case_data['notes'] . '</td>';
    $html .= '</tr>';
}
$html .= '</table>';

// Output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// Generate the file name
$filename = "case_details.pdf";

// Save the PDF file
$pdf->Output($filename, 'D');
