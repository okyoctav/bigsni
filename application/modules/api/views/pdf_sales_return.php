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
$this->load->helper('tersebut');
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('FHK');
$pdf->SetTitle('Sales Return').$item->tsr_code;
$pdf->SetSubject('Sales Return');
$pdf->SetKeywords('Sales Return');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

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

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 8);

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
$no = 1;
$totaltax = floatval($item->tso_total_price) - floatval($item->tso_total);
$balance = floatval($item->tso_total_price) - floatval($item->tso_dp);
// create some HTML content
$html = '
<h3 align="center">SALES RETURN</h3>
<h4 align="center">No Sales Return : '.$item->tsr_code.'</h4>
<p>
<p/>
<table width="100%" border="0" cellpadding="1">
  <tr>
    <td width="46%" align="center" bgcolor="#ecf0f1"><h3><strong>Informasi Pelanggan</strong></h3></td>
    <td width="4%">&nbsp;</td>
    <td width="5%">&nbsp;</td>
    <td colspan="3" align="center" bgcolor="#ecf0f1"><h3><strong>Informasi Invoice</strong></h3></td>
    <td width="1%" align="center" bgcolor="#ecf0f1">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#ecf0f1">Nama : '.$item->tso_mcu_name.'</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3" bgcolor="#ecf0f1">Invoice No : '.$item->tso_invoice.'</td>
    <td bgcolor="#ecf0f1">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#ecf0f1">Alamat : '.$item->mcu_address.'</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3" bgcolor="#ecf0f1">Invoice Date : '.Date('d-F-Y',strtotime($item->tso_invoice_date)).'</td>
    <td bgcolor="#ecf0f1">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#ecf0f1">Phone : '.$item->mcu_mobile.'</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td width="15%">&nbsp;</td>
    <td width="10%">&nbsp;</td>
    <td width="10%">&nbsp;</td>
    <td width="10%">&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" style="border:0.5 solid #bdc3c7;" align="center" cellpadding="5">
  <tr>
    <th width="5%" bgcolor="#CCCCCC" scope="col">No</th>
    <th width="14%" bgcolor="#CCCCCC" scope="col">Item Name</th>
    <th width="5%" bgcolor="#CCCCCC" scope="col">Qty</th>
    <th width="14%" bgcolor="#CCCCCC" scope="col">Price</th>
    <th width="14%" bgcolor="#CCCCCC" scope="col">Discount</th>
    <th width="14%" bgcolor="#CCCCCC" scope="col">Total Price</th>
    <th width="12%" bgcolor="#CCCCCC" scope="col">Tax</th>
    <th width="7%" bgcolor="#CCCCCC" scope="col">Return Qty</th>
    <th width="14%" bgcolor="#CCCCCC" scope="col">Returned Price</th>
  </tr>';
foreach ($detail as $det) {
    $tot = floatval($det->tsri_qty) * (floatval($det->tsri_price)-floatval($det->tsri_disc_val));
  $html .='<tr>
    <td>'.$no.'</td>
    <td>'.$det->tsri_mi_name.'</td>
    <td>'.$det->tsri_qty.'</td>
    <td align="right">Rp.'.number_format($det->tsri_price,2,',','.').'</td>
    <td align="right">Rp.'.number_format($det->tsri_disc_val,2,',','.').'</td>
    <td align="right">Rp.'.number_format($tot,2,',','.').'</td>
    <td align="right">Rp.'.number_format($det->tsri_tax_val,2,',','.').'</td>
    <td>'.$det->tsri_qty_ret.'</td>
    <td align="right">Rp.'.number_format($det->tsri_price_ret,2,',','.').'</td>
  </tr>';  
$no++;
};

$html .='</table>
<p>&nbsp;</p>
<table width="100%" border="0" cellpadding="2">
  <tr>
    <td width="27%" bgcolor="#EFEFEF">Notes :</td>
    <td width="6%"></td>
    <td width="9%">&nbsp;</td>
    <td width="7%">&nbsp;</td>
    <td width="26%">Total Qty Returned : </td>
    <td width="6%"></td>
    <td width="14%" align="center"><b>'.$item->tsr_qty.'</b></td>
    <td width="5%">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#EFEFEF" style="word-wrap: break-word;">'.$item->tsr_note.'</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Total Price Returned : </td>    
    <td width="6%">Rp. </td>
    <td width="14%" align="right"><b>'.number_format($item->tsr_total_price,2,',','.').'</b></td>
    <td width="5%">&nbsp;</td>
  </tr>
<hr/>
  <tr>
    <td width="100%" bgcolor="#EFEFEF" colspan="8" style="font-size:14px;">Terbilang :</td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#EFEFEF" colspan="8" style="font-size:14px;word-wrap: break-word;" align="center">'.ucwords(terbilangs($item->tsr_total_price)).' Rupiah </td>
  </tr>
  <tr>
    <td width="100%" bgcolor="#EFEFEF" colspan="8" style="font-size:14px;"></td>
  </tr>
</table>
<div style="border-bottom:0.1px dashed black;"></div>
<p>&nbsp;
';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Invoice'.$item->tso_invoice.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+