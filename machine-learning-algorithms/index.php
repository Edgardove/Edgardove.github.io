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
    <meta name="description"content="Brief description of some popular algorithms used to perform common tasks like classification and clustering. Some methods include: Support Vector Machines, Feedforward Neural Networks, Mean Shift, KMeans, etc.">
    <link rel="stylesheet" href="../css/section/index.css">
    <?php require_once '../php/files.php'; ?>
    <script>
        let section='machine-learning-algorithms';
    </script>
    <script src="../js/section/index.js"></script>
    <title>Machine Learning Algorithms | <?php echo APP_NAME; ?></title>
</head>
<body>
    <div class="container">
        <?php require_once '../templates/header.php'; ?>

        <section class="main">
            <section class="section_title">
                <img src="images/icon.png" alt="ICON"width="60">
                <h1>Machine Learning Algorithms</h1>
            </section>

            <section class="main_content">
                <h1>Most recent documents</h1>

                <section class="content">
                    <a href='binary-classification-dual-coordinate-descent'>Binary classification: Dual Coordinate Descent <i class='fa fa-external-link'></i></a>
                    <a href='binary-classification-pegasos'>Binary classification: PEGASOS <i class='fa fa-external-link'></i></a>
                    <a href='clustering-kmeans'>Clustering: KMeans <i class='fa fa-external-link'></i></a>
                    <a href='clustering-mean-shift'>Clustering: Mean Shift <i class='fa fa-external-link'></i></a>
                    <a href='svm-summary'>SVM summary <i class='fa fa-external-link'></i></a>
                    <a href='multiclass-classification-artificial-neural-network-standard-algorithm'>Multiclass classification: Artificial Neural Network - Standard algorithm <i class='fa fa-external-link'></i></a>
                    <a href='terms-widely-used-in-ai-explained-with-examples'>Terms widely used in AI - explained with examples <i class='fa fa-external-link'></i></a>
                </section>
            </section>
        </section>

        <?php require_once '../templates/footer.php'; ?>
    </div>
</body>
</html>