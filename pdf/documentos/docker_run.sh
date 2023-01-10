#!/bin/bash
docker exec pagos bash /config/santaanita/pdf/documentos/run_saldo_pdf.sh
mv /config/app/santaanita/pdf/documentos/*.pdf /config/airflow/plugins/spoon/adjuntos
