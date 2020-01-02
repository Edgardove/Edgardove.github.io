<?php
    require_once '../php/app_sources.php';
?>

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
    <meta name="description"content="Utility codes collected from Internet about mathematical conversions and Machine Learning algorithms. Mainly with Python. Here is where we apply our math knowledge to take an algotithm from the theory to the practice.">
    <link rel="stylesheet" href="../css/section/index.css">
    <?php require_once '../php/files.php'; ?>
    <script>
        let section='programming-languages';
    </script>
    <script src="../js/section/index.js"></script>
    <title>Programming Languages | <?php echo APP_NAME; ?></title>
</head>
<body>
    <div class="container">
        <?php require_once '../templates/header.php'; ?>

        <section class="main">
            <section class="section_title">
                <img src="images/icon.png" alt="ICON"width="60">
                <h1>Programming Languages</h1>
            </section>

            <section class="main_content">
                <h1>Most recent documents</h1>

                <section class="content">
                    <a href='binary-convertor-code-and-demo'>Binary convertor: code and demo <i class='fa fa-external-link'></i></a>
                    <a href='bits-sequence-generator-code'>Bits sequence generator code <i class='fa fa-external-link'></i></a>
                </section>
            </section>
        </section>

        <?php require_once '../templates/footer.php'; ?>
    </div>
</body>
</html>