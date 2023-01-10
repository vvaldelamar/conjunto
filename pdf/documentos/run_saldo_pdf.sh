#!/bin/bash
cd /config/santaanita/pdf/documentos
declare -a StringArray=("1A"  "1B"  "2A" "2B"  "3A"  "3B"  "4A"  "4B"  "5A"  "5B"  "6A"  "6B"  "7A"  "7B"  "8U"  "9U"  "10A"  "10B"  "11A"  "11B"  "12A"  "12B"  "13A"  "13B"  "14A"  "14B"  "15A"  "15B"  "16A"  "16B"  "17U"  "18U"  "19U"  "20A"  "20B"  "21A"  "21B"  "22A"  "22B"  "23A"  "23B"  "24A"  "24B"  "25A"  "25B"  "26A"  "26B"  "27A"  "27B"  "28A"  "28B"  "29A"  "29B"  "30A"  "30B"  "31A"  "31B"  "32A"  "32B"  "33A"  "33B"  "34A"  "34B"  "35A"  "35B"  "36A"  "36B")
# Iterate the string array using for loop
for val in "${StringArray[@]}"; do
   echo "Welcome $val times"
   php saldos_pdf_back.php --casa=$val >/config/santaanita/pdf/documentos/$val.pdf
done
chown pagos:pagos *.pdf
chmod 777 *.pdf
