<?php

/**
 * Laravel Requirement Checker
 *
 * This standalone script will check if your server meets the requirements for running the
 * Laravel web application framework.
 *
 * @author Gastón Heim
 * @author Emerson Carvalho
 * @version 0.0.1
 */
$latestLaravelVersion = '5.6';

$laravelVersion = (isset($_GET['v'])) ? (string)$_GET['v'] : $latestLaravelVersion;

if (!in_array($laravelVersion, array('4.2', '5.0', '5.1', '5.2', '5.3', '5.4', '5.5', '5.6'))) {
    $laravelVersion = $latestLaravelVersion;
}


$laravel42Obs = 'As of PHP 5.5, some OS distributions may require you to manually install the PHP JSON extension. 
When using Ubuntu, this can be done via apt-get install php5-json.';
$laravel50Obs = 'PHP version should be < 7. As of PHP 5.5, some OS distributions may require you to manually install the PHP JSON extension. 
When using Ubuntu, this can be done via apt-get install php5-json';

$reqList = array(
    '4.2' => array(
        'php' => '5.4',
        'mcrypt' => true,
        'pdo' => false,
        'openssl' => false,
        'mbstring' => false,
        'tokenizer' => false,
        'xml' => false,
        'ctype' => false,
        'json' => false,
        'obs' => $laravel42Obs
    ),
    '5.0' => array(
        'php' => '5.4',
        'mcrypt' => true,
        'openssl' => true,
        'pdo' => false,
        'mbstring' => true,
        'tokenizer' => true,
        'xml' => false,
        'ctype' => false,
        'json' => false,
        'obs' => $laravel50Obs
    ),
    '5.1' => array(
        'php' => '5.5.9',
        'mcrypt' => false,
        'openssl' => true,
        'pdo' => true,
        'mbstring' => true,
        'tokenizer' => true,
        'xml' => false,
        'ctype' => false,
        'json' => false,
        'obs' => ''
    ),
    '5.2' => array(
        'php' => '5.5.9',
        'mcrypt' => false,
        'openssl' => true,
        'pdo' => true,
        'mbstring' => true,
        'tokenizer' => true,
        'xml' => false,
        'ctype' => false,
        'json' => false,
        'obs' => ''
    ),
    '5.3' => array(
        'php' => '5.6.4',
        'mcrypt' => false,
        'openssl' => true,
        'pdo' => true,
        'mbstring' => true,
        'tokenizer' => true,
        'xml' => true,
        'ctype' => false,
        'json' => false,
        'obs' => ''
    ),
    '5.4' => array(
        'php' => '5.6.4',
        'mcrypt' => false,
        'openssl' => true,
        'pdo' => true,
        'mbstring' => true,
        'tokenizer' => true,
        'xml' => true,
        'ctype' => false,
        'json' => false,
        'obs' => ''
    ),
    '5.5' => array(
        'php' => '5.6.4',
        'mcrypt' => false,
        'openssl' => true,
        'pdo' => true,
        'mbstring' => true,
        'tokenizer' => true,
        'xml' => true,
        'ctype' => false,
        'json' => false,
        'obs' => ''
    ),
    '5.6' => array(
        'php' => '7.1.3',
        'mcrypt' => false,
        'openssl' => true,
        'pdo' => true,
        'mbstring' => true,
        'tokenizer' => true,
        'xml' => true,
        'ctype' => true,
        'json' => true,
        'obs' => ''
    ),
);


$strOk = '<i class="fa fa-check"></i>';
$strFail = '<i class="fa fa-times"></i>';
$strUnknown = '<i class="fa fa-question"></i>';

$requirements = array();


// PHP Version
$requirements['php_version'] = (version_compare(PHP_VERSION, $reqList[$laravelVersion]['php'], ">=") >= 0);

// OpenSSL PHP Extension
$requirements['openssl_enabled'] = extension_loaded("openssl");

// PDO PHP Extension
$requirements['pdo_enabled'] = defined('PDO::ATTR_DRIVER_NAME');

// Mbstring PHP Extension
$requirements['mbstring_enabled'] = extension_loaded("mbstring");

// Tokenizer PHP Extension
$requirements['tokenizer_enabled'] = extension_loaded("tokenizer");

// XML PHP Extension
$requirements['xml_enabled'] = extension_loaded("xml");

// CTYPE PHP Extension
$requirements['ctype_enabled'] = extension_loaded("ctype");

// JSON PHP Extension
$requirements['json_enabled'] = extension_loaded("json");

// Mcrypt
$requirements['mcrypt_enabled'] = extension_loaded("mcrypt_encrypt");

// mod_rewrite
$requirements['mod_rewrite_enabled'] = null;

if (function_exists('apache_get_modules')) {
    $requirements['mod_rewrite_enabled'] = in_array('mod_rewrite', apache_get_modules());
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Server Requirements &dash; Laravel PHP Framework</title>
    <link href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        @import url(//fonts.googleapis.com/css?family=Lato:300,400,700);

        body {
            margin: 0;
            font-size: 16px;
            font-family: 'Lato', sans-serif;
            text-align: center;
            color: #999;
        }

        .wrapper {
            width: 300px;
            margin: 50px auto;
        }

        p {
            margin: 0;
        }

        p small {
            font-size: 13px;
            display: block;
            margin-bottom: 1em;
        }

        p.obs {
            margin-top: 20px;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            color: #31708f;
            background-color: #d9edf7;
            border-color: #bce8f1;
        }

        .icon-ok {
            color: #27ae60;
        }

        .icon-remove {
            color: #c0392b;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <a href="http://laravel.com" title="Laravel PHP Framework">
        <svg xmlns="http://www.w3.org/2000/svg" width="84.1" height="57.6" viewBox="0 0 84.1 57.6">
            <path fill="#FB503B"
                  d="M83.8 26.9c-.6-.6-8.3-10.3-9.6-11.9-1.4-1.6-2-1.3-2.9-1.2s-10.6 1.8-11.7 1.9c-1.1.2-1.8.6-1.1 1.6.6.9 7 9.9 8.4 12l-25.5 6.1L21.2 1.5c-.8-1.2-1-1.6-2.8-1.5C16.6.1 2.5 1.3 1.5 1.3c-1 .1-2.1.5-1.1 2.9S17.4 41 17.8 42c.4 1 1.6 2.6 4.3 2 2.8-.7 12.4-3.2 17.7-4.6 2.8 5 8.4 15.2 9.5 16.7 1.4 2 2.4 1.6 4.5 1 1.7-.5 26.2-9.3 27.3-9.8 1.1-.5 1.8-.8 1-1.9-.6-.8-7-9.5-10.4-14 2.3-.6 10.6-2.8 11.5-3.1 1-.3 1.2-.8.6-1.4zm-46.3 9.5c-.3.1-14.6 3.5-15.3 3.7-.8.2-.8.1-.8-.2-.2-.3-17-35.1-17.3-35.5-.2-.4-.2-.8 0-.8S17.6 2.4 18 2.4c.5 0 .4.1.6.4 0 0 18.7 32.3 19 32.8.4.5.2.7-.1.8zm40.2 7.5c.2.4.5.6-.3.8-.7.3-24.1 8.2-24.6 8.4-.5.2-.8.3-1.4-.6s-8.2-14-8.2-14L68.1 32c.6-.2.8-.3 1.2.3.4.7 8.2 11.3 8.4 11.6zm1.6-17.6c-.6.1-9.7 2.4-9.7 2.4l-7.5-10.2c-.2-.3-.4-.6.1-.7.5-.1 9-1.6 9.4-1.7.4-.1.7-.2 1.2.5.5.6 6.9 8.8 7.2 9.1.3.3-.1.5-.7.6z"></path>
        </svg>
    </a>

    <form action="?" method="get"/>
    <select name="v" onchange="this.form.submit()">
        <option value="5.6" <?php echo ($laravelVersion == '5.6') ? 'selected' : '' ?> >Laravel 5.6 Latest</option>
        <option value="5.5" <?php echo ($laravelVersion == '5.5') ? 'selected' : '' ?> >Laravel 5.5 LTS</option>
        <option value="5.4" <?php echo ($laravelVersion == '5.4') ? 'selected' : '' ?> >Laravel 5.4</option>
        <option value="5.3" <?php echo ($laravelVersion == '5.3') ? 'selected' : '' ?> >Laravel 5.3</option>
        <option value="5.2" <?php echo ($laravelVersion == '5.2') ? 'selected' : '' ?> >Laravel 5.2</option>
        <option value="5.1" <?php echo ($laravelVersion == '5.1') ? 'selected' : '' ?> >Laravel 5.1 LTS</option>
        <option value="5.0" <?php echo ($laravelVersion == '5.0') ? 'selected' : '' ?> >Laravel 5.0</option>
        <option value="4.2" <?php echo ($laravelVersion == '4.2') ? 'selected' : '' ?> >Laravel 4.2</option>
    </select>
    </form>

    <h1>Server Requirements.</h1>

    <p>
        PHP
        >= <?php echo $reqList[$laravelVersion]['php'] ?> <?php echo $requirements['php_version'] ? $strOk : $strFail; ?>
    </p>


    <?php if ($reqList[$laravelVersion]['openssl']) : ?>
        <p>OpenSSL PHP Extension <?php echo $requirements['openssl_enabled'] ? $strOk : $strFail; ?></p>
    <?php endif; ?>

    <?php if ($reqList[$laravelVersion]['pdo']) : ?>
        <p>PDO PHP Extension <?php echo $requirements['pdo_enabled'] ? $strOk : $strFail; ?></p>
    <?php endif ?>

    <?php if ($reqList[$laravelVersion]['mbstring']) : ?>
        <p>Mbstring PHP Extension <?php echo $requirements['mbstring_enabled'] ? $strOk : $strFail; ?></p>
    <?php endif ?>

    <?php if ($reqList[$laravelVersion]['tokenizer']) : ?>
        <p>Tokenizer PHP Extension <?php echo $requirements['tokenizer_enabled'] ? $strOk : $strFail; ?></p>
    <?php endif ?>


    <?php if ($reqList[$laravelVersion]['xml']) : ?>
        <p>XML PHP Extension <?php echo $requirements['xml_enabled'] ? $strOk : $strFail; ?></p>
    <?php endif ?>

    <?php if ($reqList[$laravelVersion]['ctype']) : ?>
        <p>CTYPE PHP Extension <?php echo $requirements['ctype_enabled'] ? $strOk : $strFail; ?></p>
    <?php endif ?>

    <?php if ($reqList[$laravelVersion]['json']) : ?>
        <p>JSON PHP Extension <?php echo $requirements['json_enabled'] ? $strOk : $strFail; ?></p>
    <?php endif ?>

    <?php if ($reqList[$laravelVersion]['mcrypt']) : ?>
        <p>Mcrypt PHP Extension <?php echo $requirements['mcrypt_enabled'] ? $strOk : $strFail; ?></p>
    <?php endif ?>

    <?php if (!empty($reqList[$laravelVersion]['obs'])): ?>
        <p class="obs"><?php echo $reqList[$laravelVersion]['obs'] ?></p>
    <?php endif; ?>

</div>
</body>
</html>

