<?php
    require_once '../../php/app_sources.php';
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
    <meta name="description"content="">
    <link rel="shortcut icon" href="../../images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/post/index.css">
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({
            messageStyle: 'none',
            tex2jax: {preview: 'none'},
            CommonHTML: {
                scale: 97
            }
        });

        MathJax.Hub.Register.StartupHook("End", function () {
            document.getElementsByClassName('mask_load')[0].style.display='none';
        });
    </script>
    <script async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/latest.js?config=TeX-MML-AM_CHTML"></script>
    <script src="../../js/libs/jquery_3.3.1.min.js"></script>
    <script>
        let start_time=1573067649;
    </script>
    <script src="../../js/post/index.js"></script>
    <title>SVM Summary | <?php echo APP_NAME; ?></title>
</head>
<body>
    <div class="container">
        <section class="main">
        <section class="menu_slide menu_invisible"></section>
            <section class="slides_content">
                <header>
                    <i class="fa fa-bars" id="menu"></i>
        
                    <i class="fa fa-arrow-left" id="back_url"></i>
                    
                    <i class="fa fa-bookmark-o" id="bookmark"></i>

                    <span class="date_text">Edition time</span>
                </header>

                <section class="slides">
                    <section class="slide">
                        <section class="content">
                            <h1>Overview</h1>

                            <p class="article">
                                - It's used for binary and multi-class classification.
                            </p>
                            <p class="article">
                                - It's a supervised procedure because the data is already grouped and labeled.
                            </p>
                            <p class="article">
                                - Given a set of training features and their corresponding labels the idea is to label a 
                                new unlabelled feature based on its attributes with respect to the attributes of the
                                training features. This is like labeling a person as "bad" or "good" based on her/his
                                behavior and our prejudice of how a "good" or "bad" person should behave.
                            </p>
                            <p class="article">
                                - Every feature is a vector with <em>n</em> components/attributes.
                            </p>
                            <p class="article">
                                - Every label or class is represented with a number.
                            </p>
                            <p class="article">
                                - This task of labelling a new unlabelled feature is done with a hyperplane or set of hyperplanes
                                previously constructed with the training features.
                            </p>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Informal glossary for SVM</h1>

                            <p class="article">
                                - <strong>Data</strong>: set of features ( vectors ) and labels ( numbers ).
                            </p>
                            <p class="article">
                                - <strong>Feature</strong>: a vector with <em>n</em> - components/attributes.
                            </p>
                            <p class="article">
                                - <strong>Feature space</strong>: space higher ( dimension ) than the input space.
                            </p>
                            <p class="article">
                                - <strong>Hard margin</strong>: it's when the samples are perfectly separated and as a result leave an empty space, like an unoccupied road: the margin.
                            </p>
                            <p class="article">
                                - <strong>Hyperplane</strong>: is the <em>( n - 1 )</em> - dimensional "wall" that separates different
                                features into a <em>n</em> - dimensinal "house".
                            </p>
                            <p class="article">
                                - <strong>Input space</strong>: is  the original space of the data.
                            </p>
                            <p class="article">
                                - <strong>Kernel</strong>: is  a similarity function in the sense that it takes two vectors as input
                                and return the similarity ( inner product ) of these objects in a higher space.
                            </p>
                            <p class="article">
                                - <strong>Kernel trick</strong>: allow us to use linear algorithms to nonlinear data applying a kernel.
                                This kernel takes as input ( arguments ) two "nonlinear vectors" and return the inner product
                                of two "linear vectors" in a higher space.
                            </p>
                            <p class="article">
                                - <strong>Label/class</strong>: is  the output of a feature, representing "the type" of feature we
                                are dealing with.
                            </p>
                            <p class="article">
                                - <strong>Maps</strong>: It's used as a verb that means "to assign".
                            </p>
                            <p class="article">
                                - <strong>Similarity function/measure</strong>: is a real-valued function that measures the similarity
                                between two objects ( e.g.: vectors ). The higher its value grater similarity. It can
                                takes zero or negative values for very dissimilar objects.
                            </p>
                            <p class="article">
                                - <strong>Soft margin</strong>: It's when the vast majority of the samples are perfectly separated by a margin, however there are some that are on the wrong side and a penalty <em>hyperparameter</em> must be included.
                            </p>
                            <p class="article">
                                - <strong>Supervised</strong>: based on samples already labelled, we label a new unlabeled sample. The
                                label on every already labelled sample is called <em>the supervisory signal</em>
                            </p>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Resolutions</h1>

                            <p class="article">
                                There are different methods to separate one class with another ( binary classification )
                                following the notions of a SVM. Two of the simplest, but not for that less effectives or
                                efficients, are PEGASOS and the Dual Coordinate Descent approach respectively.
                                Both are described in these links: 
                            </p>

                            <br>

                            <p class="article">
                                <a class="link" href="../binary-classification-dual-coordinate-descent">Dual Coordiante Descent</a>
                            </p>

                            <br>

                            <p class="article">
                                <a class="link" href="../binary-classification-pegasos">PEGASOS</a>
                            </p>
                        </section>
                    </section>
                </section>

                <section class="buttons_content">
                    <button class="btn_action" id="back">
                        &lt;
                    </button>

                    <button class="btn_action" id="next">
                        &gt;
                    </button>
                </section>
            </section>
        </section>
    </div>
</body>
</html>