#!/bin/bash
# Gebruik dit als volgt: ./pdf.sh
# scode=$1
weeknumber=`date +"%V" -d next-week`
echo "Week number:$weeknumber"
for scode in JBR MA MXI YO JE
do
echo "sCode:$scode"
/usr/bin/wkhtmltopdf --orientation 'Landscape' "https://keesboeke.guifiontwikkelt.nl/weekroosterleerling_new.php?output=clean&docent=Administrator&klas=1&sCode=$scode" "/data/sites/web/klasseroosternl/www/pdf/$scode-$weeknumber-rooster.pdf"
done
