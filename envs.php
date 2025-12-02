<?php
// Don't mind it, i will put out of public html folder in production.
putenv('DB_HOST=mysql:host=localhost;dbname=projeto_estoque');
putenv('DB_USER=code');
putenv('DB_PASS=vscode123');
putenv('ERROR_LOG_PATH=../logs/php_errors.log');
putenv('QUANTITY_MIN_ALERT=5');
putenv('PASSWORD_LENGTH_MIN=8');
putenv('SESSION_TIMEOUT=1800'); // 30 minutos
putenv('ROLE_ADMIN=60');
putenv('ROLE_USER=32');
putenv('RECORDS_PER_PAGE=8');
?>