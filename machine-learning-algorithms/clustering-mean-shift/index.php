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
    <link rel="stylesheet" href="highlight/a11y-light.css">
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
    <script src="highlight/highlight.pack.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <script>
        let start_time=1574709356;
    </script>
    <script src="../../js/post/index.js"></script>
    <title>Clustering: Mean Shift | <?php echo APP_NAME; ?></title>
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
                                <em>Mean Shift</em> is an iterative technique used for clustering a dataset. And it does by
                                locating "high density areas" into the dataset. A graphical example would be this:
                            </p>

                            <img src="../../images/posts/0.png" alt="MEAN SHIFT DATASET" class="image">

                            <p class="article">
                                The algorithm search and locate the zones with more density points
                            </p>

                            <img src="../../images/posts/clustering_marks.png" alt="CLUSTERING MARKS" class="image">
                        
                            <p class="article">
                                And group the data:
                            </p>

                            <img src="../../images/posts/clustering.gif" alt="CLUSTERING ANIMATION">
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Algorithm</h1>

                            <ul>
                                <li>Let \(\boldsymbol{X}\) be the dataset</li>
                                <li>\(\boldsymbol{S}\gets\boldsymbol{X}\)</li>
                                <li>
                                    Let \(K(\boldsymbol{x})\) be a unit flat kernel:

                                    <p class="latex">
                                        \[
                                        K(\boldsymbol{x})=
                                        \begin{cases}
                                        1   & \quad \text{if } \|\boldsymbol{x}\| \le 1 \\
                                        0   & \quad \text{if } \|\boldsymbol{x}\| > 1
                                        \end{cases}
                                        \]
                                    </p>
                                </li>
                                <li>Let \(h>0\) be the bandwidth: a free parameter</li>
                            </ul>

                            <h2>Iteration</h2>

                            <ol>
                                <li>
                                    <p class="latex">\[\boldsymbol{M}=\emptyset\]</p>
                                </li>
                                <li>
                                    <p class="latex">
                                        \[
                                        \boldsymbol{m}(\boldsymbol{x})=\frac{\displaystyle\sum_{\boldsymbol{s} \in \boldsymbol{S}}K \left( \frac{\boldsymbol{s} - \boldsymbol{x}}{h} \right) \boldsymbol{s}}{\displaystyle\sum_{\boldsymbol{s} \in \boldsymbol{S}}K \left( \frac{\boldsymbol{s} - \boldsymbol{x}}{h} \right)},
                                        \quad \boldsymbol{M} \gets \boldsymbol{M} \cup \{\boldsymbol{m}(\boldsymbol{x})\},
                                        \quad \forall \boldsymbol{x} \in \boldsymbol{X}
                                        \]
                                    </p>
                                </li>
                                <li>
                                    <p class="latex">
                                    \[\text{if  }\exists \boldsymbol{s} \neq \boldsymbol{m}, \quad \forall \boldsymbol{s} \in \boldsymbol{S} \land \forall \boldsymbol{m} \in \boldsymbol{M}:\quad \boldsymbol{S} \gets \boldsymbol{M} \text{, repeat 1 and 2}\]
                                    </p>
                                </li>
                            </ol>

                            <br>

                            <p class="article">
                                When the step three holds, \(\boldsymbol{S}\) is the set with the means or centroids of the dataset \(\boldsymbol{X}\).
                            </p>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Algorithm in python using numpy</h1>

                            <pre><code class="python">
def unit_flat_kernel(x, x_i, h):
    n=numpy.linalg.norm((x-x_i)/h)

    if n<=1: return 1
    else: return 0

def mean_shift(data, bandwidth):
    X=data
    S=data
    h=bandwidth
    c=0

    while True:
        M=[]
        prev_X=X
        for x in X:
            num=[]
            den=0
            for x_i in S:
                num.append(unit_flat_kernel(x, x_i, h)*x_i)
                den+=unit_flat_kernel(x, x_i, h)

            num=numpy.array(num, dtype=numpy.dtype('Float64'))

            m=numpy.sum(num, axis=0)/den

            M.append(numpy.sum(num, axis=0)/den)


        M=numpy.array(M, dtype=numpy.dtype('Float64'))

        X=numpy.unique(M, axis=0)

        if numpy.array_equal(X, prev_X):
            print('clustered after ' + str(c) + ' iterations')

            clusters=[]

            for t in range(len(X)): 
                clusters.append([])

            for point in data:
                distances=[]

                for centroid in X:
                    distances.append(numpy.linalg.norm(centroid - point))

                idx=distances.index(min(distances))

                clusters[idx].append(point)

            break

        c+=1

    return {'centroids': X, 'clusters': clusters}
                            </code></pre>
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