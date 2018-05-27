<?php
//============================================================+
// File name   : example_048.php
// Begin       : 2009-03-20
// Last Update : 2013-05-14
//
// Description : Example 048 for TCPDF class
//               HTML tables and table headers
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: HTML tables and table headers
 * @author Nicola Asuni
 * @since 2009-03-20
 */

// Include the main TCPDF library (search for installation path).
require_once('./assets/temaalus/plugins/tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Invoice');
$pdf->SetTitle('Kwitansi Payment Receive');
$pdf->SetSubject('Invoice');
$pdf->SetKeywords('Invoice');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('courier', 'B', 20);

// add a page
$pdf->AddPage('P','A4');
$pdf->SetFont('courier', '', 8);

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)


// create some HTML content
$html = '
<div>
<table border="" >
<tr>
  <td width="10%"><img src="'.base_url().'assets/logo/faviconfhk.png" height="70" height="70"></td>
  <td width="90%"><div style="font-weight: bold;">PT. FAJAR HIDUP KREASI</div><br>Jl. TebetTimurDalam Raya no.99D <br>Jakarta Selatan <br>12810-Indonesia <br>Tel. +62-21 22839779</td>
</tr>
</table>
<div style="border-bottom: 1px solid black;"></div>
<table width="100%" style="font-size:12px; font-weight: bold;">
  <tr>
    <td width="70%"><div style="solid black;"></div></td>
    <td width="30%" style="text-align:left;"><div style="text-align: center;">No. '.$vo->tsre_code.'</div></td>
  </tr>
</table>
<p></p>
<p></p>
<div style="text-align: center;">
<table width="100%" cellpadding="1" style="color: #4F4F4F;">
  <tr>
    <td width="100%" align="center" colspan="2"><h1><strong></strong></h1></td>
  </tr>
  <tr>
      <td></td>
      <td></td>
  </tr>
    <tr>
      <td></td>
      <td></td>
  </tr>
  <tr>
    <td height="30" width="20%" align="left" style="font-size: 11px;">Dibayar kepada</td>
    <td width="80%" align="left" style="font-weight: bold;"><h3>: '.$vo->tsr_mcu_name.'</h3></td>
  </tr>
  <tr>
    <td height="30" align="left" style="font-size: 11px;">Uang Sejumlah</td>
    <td align="left" style="font-weight: bold; color: blue;"><h3>: '.$terbilang.' <i>Rupiah</i></h3></td>
  </tr>
  <tr>
    <td height="30" align="left" style="font-size: 11px;">Untuk </td>
    <td align="left" style="font-weight: bold;"><h3>: Sales Return No - <strong>'.$vo->tsr_code.'</strong></h3></td>
  </tr>
  <tr>
    <td height="30" align="left" style="font-size: 11px;">Metode Pembayaran</td>
    <td align="left" style="font-weight: bold;"><h3>: <strong>'.$vo->tsre_payment.'</strong></h3></td>
  </tr>
</table>
</div>
';
/*number_format($id->tpr_amount,2,',','.')*/
$bulan = array(
                '01' => 'Januari',
                '02' => 'Februari',
                '03' => 'Maret',
                '04' => 'April',
                '05' => 'Mei',
                '06' => 'Juni',
                '07' => 'Juli',
                '08' => 'Agustus',
                '09' => 'September',
                '10' => 'Oktober',
                '11' => 'November',
                '12' => 'Desember',
        );

$html .='
<div>
<table width="100%"  cellpadding="2">
  <tr>
    <td width="30%" style=""><h3><div style="border: 1px solid gray; text-align: center;"><i>Rp  '.number_format($vo->tsre_total_price,2,",",".").'-</i></div></h3></td>
    <td width="20%"></td>
    <td width="20%"></td>
    <td width="30%"><div style="text-align: center;"> Jakarta, '.date('d').' '.($bulan[date('m')]).' '.date('Y') .'</div></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td style="text-align: center;">(____________________________)</td>
  </tr>
</table>
</div>
<p></p>
<div style="border-bottom: 1px dashed black;"></div>
';

$html .= '
<p></p>
<table border="" >
<tr>
  <td width="10%"><img src="'.base_url().'assets/logo/faviconfhk.png" height="70" height="70"></td>
  <td width="90%"><div style="font-weight: bold;">PT. FAJAR HIDUP KREASI</div><br>Jl. TebetTimurDalam Raya no.99D <br>Jakarta Selatan <br>12810-Indonesia <br>Tel. +62-21 22839779</td>
</tr>
</table>
<div style="border-bottom: 1px solid black;"></div>
<table width="100%" style="font-size:12px; font-weight: bold;">
  <tr>
    <td width="70%"><div style="solid black;"></div></td>
    <td width="30%" style="text-align:left;"><div style="text-align: center;">No. '.$vo->tsre_code.'</div></td>
  </tr>
</table>
<p></p>
<p></p>
<div style="text-align: center;">
<table width="100%" cellpadding="1" style="color: #4F4F4F;">
  <tr>
    <td width="100%" align="center" colspan="2"><h1><strong></strong></h1></td>
  </tr>
  <tr>
      <td></td>
      <td></td>
  </tr>
    <tr>
      <td></td>
      <td></td>
  </tr>
  <tr>
    <td height="30" width="20%" align="left" style="font-size: 11px;">Dibayar kepada</td>
    <td width="80%" align="left" style="font-weight: bold;"><h3>: '.$vo->tsr_mcu_name.'</h3></td>
  </tr>
  <tr>
    <td height="30" align="left" style="font-size: 11px;">Uang Sejumlah</td>
    <td align="left" style="font-weight: bold; color: blue;"><h3>: '.$terbilang.' <i>Rupiah</i></h3></td>
  </tr>
  <tr>
    <td height="30" align="left" style="font-size: 11px;">Untuk </td>
    <td align="left" style="font-weight: bold;"><h3>: Sales Return No - <strong>'.$vo->tsr_code.'</strong></h3></td>
  </tr>
  <tr>
    <td height="30" align="left" style="font-size: 11px;">Metode Pembayaran</td>
    <td align="left" style="font-weight: bold;"><h3>: <strong>'.$vo->tsre_payment.'</strong></h3></td>
  </tr>
</table>
</div>';

$html .='
<div>
<table width="100%"  cellpadding="2">
  <tr>
    <td width="30%" style=""><h3><div style="border: 1px solid gray; text-align: center;"><i>Rp  '.number_format($vo->tsre_total_price,2,",",".").'-</i></div></h3></td>
    <td width="20%"></td>
    <td width="20%"></td>
    <td width="30%"><div style="text-align: center;"> Jakarta, '.date('d').' '.($bulan[date('m')]).' '.date('Y') .'</div></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td style="text-align: center;">(____________________________)</td>
  </tr>
</table>
</div>
';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Invoice.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+