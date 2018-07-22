<?php
/*
Plugin Name: yourls-tcpdf-qrcode
Plugin URI: https://github.com/MarcusOettinger/yourls-tcpdf-qrcode
Description: Add .qr to shorturls to display a QR Code created via TCPDF
(png image)
Version: 1.0
Author: M.Oettinger
Author URI: https://github.com/MarcusOettinger

This plugin creates a QRcode of a shortlink using a self-hosted
TCPDF installation (for prerequisites see config.inc.php).

If your yourls installation happily lives in http://frobnicate.foo,
the http://frobnicate.foo/bar.qr will give a png QRCode (with
an error correction level H by default) of the shortlink
http://frobnicate.foo/bar.
*/

// Kick in if the loader does not recognize a valid pattern
yourls_add_action( 'loader_failed', 'oe_yourls_qrcode' );

function oe_yourls_qrcode( $request ) {
        require_once("user/plugins/yourls-tcpdf-qrcode/config.inc");
        
        // Get authorized charset in keywords and make a regexp pattern
        $pattern = yourls_make_regexp_pattern( yourls_get_shorturl_charset() );

        // is the shorturl of the form bar.frobnicate.qr?
        if( preg_match( "@^([$pattern]+)\.qr?/?$@", $request[0], $matches ) ) {
                // does shorturl exist?
                $keyword = yourls_sanitize_keyword( $matches[1] );
                if( yourls_is_shorturl( $keyword ) ) {
			//
			// set barcode content and type and output a PNG image.
			// needs a working TCPDF installation in 
			//
                        $barcodeobj = new TCPDF2DBarcode( $keyword , 'QRCODE,H');
                        $oe_qrstring = $barcodeobj->getBarcodePngData(2, 2, array(0,0,0));
			header('Content-Type: image/png');
			echo $oe_qrstring;
			exit;
                }
        }
}
