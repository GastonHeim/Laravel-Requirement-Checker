Laravel-Requirement-Checker
===========================

Standalone script to check if a server meets the requirements for running the Laravel framework.

Use
---

Place the check.php file into the web server and open it with your browser.

Notes
-----

Part of the code was taken from Laravel default view and Yii Framework Requirement Checker script.


For Laravel 9.x, the following extensions will be checked:
-----
```
PHP >= 8.0
BCMath PHP Extension
Ctype PHP Extension
cURL PHP Extension
DOM PHP Extension
Fileinfo PHP Extension
JSON PHP Extension
Mbstring PHP Extension
OpenSSL PHP Extension
PCRE PHP Extension
PDO PHP Extension
Tokenizer PHP Extension
XML PHP Extension
```



From Laravel 5 to Laravel 8.x below extensions will be checked
-----

```
PHP
OpenSSL PHP Extension
PDO PHP Extension 
Mbstring PHP Extension 
Tokenizer PHP Extension 
XML PHP Extension 
CTYPE PHP Extension 
JSON PHP Extension 
BCmath PHP Extension 
PHP Bolt Extension 
```