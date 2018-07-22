<?php
// yourls-tcpdf-qrcode: a yourls plugin to display a QR-code
//  (png image) of a short URL. This one uses TCPDF as I don't
//  want to use google QR-codes (as in the plugin QRCode ShortURL,
//  https://github.com/YOURLS/YOURLS/wiki/Plugin-=-QRCode-ShortURL )
//
// Prerequisites: you will need a working tcpdf installation
// in the directory set below (https://tcpdf.org/).
//
// M. Oettinger 07/2018
// -------------------------------------------------------------------------
//

// set the full path to your TCPDF installation here:
$tcpdf_dir = "/var/www/tcpdf"

// include TCPDF for the QRcode
require_once("$tcpdf_dir/tcpdf_barcodes_2d.php");
?>