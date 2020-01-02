<?php require_once '../php/app_sources.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-155264062-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-155264062-1');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Contact with the admin and report any issue or suggestion about the site.">
    <link rel="stylesheet" href="../css/home.css">
    <?php require_once '../php/files.php'; ?>
    <title>Report issue | <?php echo APP_NAME; ?></title>
</head>
<body>
    <div class="container">
        <?php include_once '../templates/header.php'; ?>
    
        <section class="main">
            <section class="presentation">
                <h1>Write to the admin</h1>

                <p>
                    Site email: suggestion@sysmath.net
                </p>
                <p>
                    Personal email: edgar.hyde.000@gmail.com
                </p>
            </section>
        </section>
    
        <?php include_once '../templates/footer.php'; ?>
    </div>
</body>
</html>