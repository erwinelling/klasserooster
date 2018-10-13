<?
require __DIR__ . '/vendor/autoload.php';
use mikehaertl\wkhtmlto\Pdf;
/*
Ik heb een php wrapper voor wkhtmltopdf gebruikt. Zie hier meer info:
https://github.com/mikehaertl/phpwkhtmltopdf

Voor uitgebreide info over opties voor het genereren van de pdf door wkhtmltopdf:
https://wkhtmltopdf.org/usage/wkhtmltopdf.txt
*/

// $url = "https://keesboeke.guifiontwikkelt.nl/weekroosterleerling_ee.php?output=clean&ll[]=261&ll[]=287&ll[]=282&ll[]=264&ll[]=263&ll[]=278&ll[]=288&ll[]=284&ll[]=270&ll[]=286&ll[]=276&ll[]=262&ll[]=285&ll[]=280&ll[]=268&ll[]=259&ll[]=266&ll[]=272&ll[]=269&ll[]=271&ll[]=265&ll[]=275&ll[]=274&ll[]=273&ll[]=260&ll[]=283&ll[]=281&ll[]=277&ll[]=279&ll[]=267"

$options = array(
    'orientation' => 'landscape',
    'page-size' => 'A4',
);

$pdf = new Pdf("https://keesboeke.guifiontwikkelt.nl/weekroosterleerling_ee.php?output=clean&docent=Administrator&klas=1&sCode=JBR&ll[]=261");//&ll[]=287&ll[]=282&ll[]=264&ll[]=263&ll[]=278&ll[]=288&ll[]=284&ll[]=270&ll[]=286&ll[]=276&ll[]=262&ll[]=285&ll[]=280&ll[]=268&ll[]=259&ll[]=266&ll[]=272&ll[]=269&ll[]=271&ll[]=265&ll[]=275&ll[]=274&ll[]=273&ll[]=260&ll[]=283&ll[]=281&ll[]=277&ll[]=279&ll[]=267");
$pdf->setOptions($options);

if (!$pdf->saveAs('/data/sites/web/klasseroosternl/subsites/klasserooster.nl/pdf/rooster.pdf')) {
    throw new Exception('Could not create PDF: '.$pdf->getError());
}
echo "pdf gegenereerd: <a href=\"rooster.pdf\">rooster.pdf</a>";

?>
