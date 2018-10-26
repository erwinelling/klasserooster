<?
// require __DIR__ . '/vendor/autoload.php';
// use mikehaertl\wkhtmlto\Pdf;
/*
Ik heb een php wrapper voor wkhtmltopdf gebruikt. Zie hier meer info:
https://github.com/mikehaertl/phpwkhtmltopdf

Het kan ook zonder via exec. Dat lijkt iets sneller te gaan.
Rechtstreeks via de commandline gaat het nog veel sneller, waarschijnlijk is een cronjob een goed idee.

Voor uitgebreide info over opties voor het genereren van de pdf door wkhtmltopdf:
https://wkhtmltopdf.org/usage/wkhtmltopdf.txt
*/

$query_string = $_SERVER['QUERY_STRING'];
$url = "https://keesboeke.guifiontwikkelt.nl/weekroosterleerling_new.php?output=clean&".$query_string;
// $url = "https://keesboeke.guifiontwikkelt.nl/weekroosterleerling_ee.php?output=clean&ll[]=261&ll[]=287&ll[]=282&ll[]=264&ll[]=263&ll[]=278&ll[]=288&ll[]=284&ll[]=270&ll[]=286&ll[]=276&ll[]=262&ll[]=285&ll[]=280&ll[]=268&ll[]=259&ll[]=266&ll[]=272&ll[]=269&ll[]=271&ll[]=265&ll[]=275&ll[]=274&ll[]=273&ll[]=260&ll[]=283&ll[]=281&ll[]=277&ll[]=279&ll[]=267"

// PHPWKTHMLTOPDF WRAPPER:
// $options = array(
//     'orientation' => 'Landscape',
//     'binary' => '/usr/bin/wkhtmltopdf',
//     'tmpDir' => '/data/sites/web/klasseroosternl/www/pdf/tmp/',
// );

// wkhtmltopdf -O Landscape "https://keesboeke.guifiontwikkelt.nl/weekroosterleerling_new.php?output=clean&docent=Administrator&klas=1&sCode=JBR&week=41&ll[]=261&ll[]=287&ll[]=282&ll[]=264&ll[]=263&ll[]=278&ll[]=288&ll[]=284&ll[]=270&ll[]=286&ll[]=276" roostertest.pdf
//wkhtmltopdf -O Landscape "https://keesboeke.guifiontwikkelt.nl/weekroosterleerling_new.php?output=clean&docent=Administrator&klas=1&sCode=JBR&week=41&ll[]=261&ll[]=287&ll[]=282&ll[]=264&ll[]=263&ll[]=278&ll[]=288&ll[]=284&ll[]=270&ll[]=286&ll[]=276" roostertest.pdf
//wkhtmltopdf --orientation 'Landscape' 'https://keesboeke.guifiontwikkelt.nl/weekroosterleerling_new.php?output=clean&docent=Administrator&klas=1&sCode=JBR&week=41&ll[]=261&ll[]=287&ll[]=282&ll[]=264&ll[]=263&ll[]=278&ll[]=288&ll[]=284&ll[]=270&ll[]=286&ll[]=276' '/data/sites/web/klasseroosternl/tmp/tmp_wkhtmlto_pdf_P75pUW2.pdf'

// $pdf = new Pdf();
// $pdf->setOptions($options);
// // $pdf->addPage('https://keesboeke.guifiontwikkelt.nl/weekroosterleerling_new.php?output=clean&docent=Administrator&klas=1&sCode=JBR&week=41&ll[]=261');
// // $pdf->addPage('https://keesboeke.guifiontwikkelt.nl/weekroosterleerling_new.php?output=clean&docent=Administrator&klas=1&sCode=JBR&ll[]=261&ll[]=287&ll[]=282&ll[]=264&ll[]=263&ll[]=278&ll[]=288&ll[]=284&ll[]=270&ll[]=286&ll[]=276');
// $pdf->addPage($url);
//
// if (!$pdf->saveAs('/data/sites/web/klasseroosternl/www/pdf/rooster.pdf')) {
//     throw new Exception('Could not create PDF: '.$pdf->getError());
// }

// ALTERNATIVELY USE THIS:
exec('wkhtmltopdf --orientation \'Landscape\' \''.$url.'\' /data/sites/web/klasseroosternl/www/pdf/rooster.pdf 2>&1',$output,$var);
// Return will return non-zero upon an error
// if (!$return) {
//     echo "PDF Created Successfully";
// } else {
//     echo "PDF not created";
// }
echo "pdf gegenereerd: <a href=\"rooster.pdf\">rooster.pdf</a> (". $url .")";
// echo $pdf->getCommand();
?>
