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
    <meta name="description"content="This is an iterative method proposed in 2008 to solve a SVM classification without dealing with Quadratic Programming (QP) solutions. Their creators proposed a first algorithm which is the basic form, and a second alternative, which is assumed to be more efficient.">
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
        let start_time=1573067592;
    </script>
    <script src="../../js/post/index.js"></script>
    <title>Binary classification: Dual Coordinate Descent | <?php echo APP_NAME; ?></title>
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
                                This is an iterative method proposed in 2008 to solve a SVM classification 
                                without dealing with Quadratic Programming (QP) solutions. Their creators proposed a first
                                algorithm which is the basic form, and a second alternative, which is assumed to be more efficient.
                                The main reference can be found <a class="link" href="https://www.csie.ntu.edu.tw/~cjlin/papers/cddual.pdf">here</a>.
                            </p>

                            <br>

                            <p class="article">
                                An example is included for a better understanding.
                            </p>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>The optimization problem</h1>

                            <p class="article">
                                The dual optimization of a SVM is: 
                            </p>

                            <p class="latex">
                                \[max: f(\alpha_1,\alpha_2,...,\alpha_n)=\displaystyle\sum_{i=1}^n \alpha_i - \frac{1}{2}\displaystyle\sum_{i=1}^n\sum_{j=1}^n \boldsymbol{y}_i \boldsymbol{\alpha}_i (\boldsymbol{X}_i·\boldsymbol{X}_j)\boldsymbol{y}_j \boldsymbol{\alpha}_j\]
                            </p>

                            <p class="article">
                                Which can be converted to:
                            </p>

                            <p class="latex">
                                \[min: f(\alpha_1,\alpha_2,...,\alpha_n)=-\displaystyle\sum_{i=1}^n \alpha_i + \frac{1}{2}\displaystyle\sum_{i=1}^n\sum_{j=1}^n \boldsymbol{y}_i \boldsymbol{\alpha}_i (\boldsymbol{X}_i·\boldsymbol{X}_j)\boldsymbol{y}_j \boldsymbol{\alpha}_j\]
                            </p>

                            <p class="article">
                                And the idea is to try to find the values of\(\boldsymbol{\alpha_i}\). Knowing the values of
                                \(\boldsymbol{\alpha_i}\), we get the vector \(\boldsymbol{w}\), which is:
                            </p>

                            <p class="latex">
                                \[\boldsymbol{w}=\displaystyle\sum_{i=1}^m \boldsymbol{\alpha}_i\boldsymbol{y}_i\boldsymbol{X}_i\]
                            </p>

                            <p class="article">
                                And finally we can classify an unlabeled feature \(\boldsymbol{X}\) with:
                            </p>

                            <p class="latex">
                                \[label=sgn(\boldsymbol{w}^T \boldsymbol{X})\]
                            </p>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>The algorithm step by step</h1>

                            <ol>
                                <li>Set \(\boldsymbol{X}\): the set of features.</li>
                                <li>Set \(\boldsymbol{y}\): the set of labels.</li>
                                <li>Set \(C\): the penalty term. </li>
                                <li>Set \(nI\): the number of instances/samples. </li>
                                <li>Set \(nF\): the number of features. </li>
                                <li>Set \(\boldsymbol{\alpha}&larr;\{0_1,0_2,0_3,...,0_{nI}\}\): a zero-vector \(\alpha\) with \(nI\) elements.</li>
                                <li>Set \(\boldsymbol{w}&larr;\{0_1,0_2,0_3,...,0_{nF}\}\): a zero-vector \(\boldsymbol{w}\) with \(nF\) elements.</li>
                                <li>Set \(\nabla^P\boldsymbol{f}&larr;\{0_1,0_2,0_3,...,0_{nI}\}\): a zero vector \(\nabla^P\boldsymbol{f}\) with \(nI\) elements</li>
                                <li>Set \(\epsilon\): the machine epsilon.</li>
                                <li>Set \(K&larr;nI\)</li>
                                <li>Set \(k&larr;1\)</li>
                                <li>\(\boldsymbol{\alpha}\)&larr;randomPermutationOf(\(\boldsymbol{\alpha}\))</li>
                                <li>if \(k>K\): \(k=1\) and go to step 12</li>
                                <li>\(Q=\boldsymbol{X_k^T X_k}\)</li>
                                <li>\(G=\boldsymbol{y_k w_k^T X_k}-1\)</li>
                                <li>if \(\boldsymbol{\alpha}_k=0\):<p class="latex">\[\quad PG=min(G,0)\text{ and }\nabla^P \boldsymbol{f}_k=PG\]</p></li>
                                <li>else if \(\boldsymbol{\alpha}_k=C\):<p class="latex">\[\quad PG=max(G,0)\text{ and }\nabla^P \boldsymbol{f}_k=PG\]</p></li>
                                <li>else if \(0 < \boldsymbol{\alpha}_k < C\):<p class="latex">\[\quad PG=G\text{ and }\nabla^P \boldsymbol{f}_k=PG\]</p></li>
                                <li>\(M=max_j\nabla^P_j\boldsymbol{f}\)</li>
                                <li>\(m=min_j\nabla^P_j\boldsymbol{f}\)</li>
                                <li>if \(M-m<\epsilon\): exit</li>
                                <li>if \(|PG|\neq 0\):
                                    <p class="latex">
                                        \[\hat{\boldsymbol{\alpha}}_k\leftarrow\boldsymbol{\alpha}_k\\
                                        \boldsymbol{\alpha}_k\leftarrow min(max(\hat{\boldsymbol{\alpha}}_k-G/Q,0),C)\\
                                        \boldsymbol{w}\leftarrow\boldsymbol{w}+(\boldsymbol{\alpha}-\hat{\boldsymbol{\alpha}})\boldsymbol{y}_k\boldsymbol{X}_k\]
                                    </p>
                                </li>
                                <li>\(k=k+1\)</li>
                                <li>Go to step 13</li>
                            </ol>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Python Code</h1>

                            <pre><code class="python">
def fit(X, y, penalty=1):
    w=np.zeros(len(X[0]), dtype=np.float64)

    alphas=np.zeros(len(y), dtype=np.float64)

    projected_gradient_vector=np.zeros(len(y), dtype=np.float64)

    global W
    global b
    global C
    global U

    W=w

    b=0

    C=penalty

    U=C
    D=0 

    while True:
        alphas=np.random.permutation(alphas)
        
        for i in range(len(y)):
        
            gradient=y[i]*np.dot(w,X[i]) - 1 + D*alphas[i]
            
            if alphas[i]==0:
                
                projected_gradient=min(gradient,0)
                
                projected_gradient_vector[i]=projected_gradient
                
            elif alphas[i]==U:
                
                projected_gradient=max(gradient,0)
                
                projected_gradient_vector[i]=projected_gradient
                
            elif 0 < alphas[i] < U:
                
                projected_gradient=gradient
                
                projected_gradient_vector[i]=projected_gradient
                
            M=np.max(projected_gradient_vector)
            m=np.min(projected_gradient_vector)
            eps=np.finfo(float).eps
            
            if M-m < eps: 
            
                W=w
                
                b=0
                
                unlabeled sample=[ 0.7534068,  -0.11394449,  0.71386598,  0.65815634, -0.54870557, -0.23729117,-0.05749318,  0.43439269,  0.29711878, -1.0571938,   0.69956576,  0.31596177,0.62519434,  0.59411043, -0.30600538, -0.04348982, -0.18679726,  0.68839558,0.04452071, -0.11419554,  0.78293974,  0.10141534,  0.69814393,  0.66698174,-0.6824632,  -0.26950087, -0.1937647,  0.49933764, -0.14682283, -0.6464708 ]
                
                print("w = ", W)
                
                type_cancer="benign"
                
                if np.dot(W,unlabeled_sample) < 0: type_cancer="malignant"
                
                print("unlabeled_sample = ", type_cancer)
                
                return

            if abs(projected_gradient)!=0:
                
                old_alpha=alphas[i]
                
                new_alpha=min( max( old_alpha - ( gradient/( np.dot( X[i], X[i] ) + D ) ), 0 ), U )
                
                alphas[i]=new_alpha
                
                append_descent=(new_alpha-old_alpha)*y[i]*X[i]
                
                w=w+append_descent
            
fit(X_train, y_train)
        
                            </code></pre>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Example and tests</h1>

                            <p class="article">
                                Classify a breast cancer in benign or malignant using the breast cancer wisconsin
                                (diagnostic) dataset of 1995 provided by the UCI:
                            </p>

                            <br>

                            <p class="article">
                                <a class="link" href="sources/wdbcx.txt" target="_blank">Feature set X</a>
                            </p>

                            <br>

                            <p class="article">
                                <a class="link" href="sources/wdbcy.txt" target="_blank">Label set y</a>
                            </p>

                            <br>

                            <p class="article">
                                The above dataset is scaled using <em>numpy</em> and the original can be found <a class="link" href="https://archive.ics.uci.edu/ml/datasets/Breast+Cancer+Wisconsin+(Diagnostic)">here</a>.
                            </p>

                            <br>

                            <p class="article">
                                If we run the previous python function, the result will be different in each execution, even if
                                the same dataset is used. That is because this algorithm is stochastic, i.e., the output or
                                result doesn't depend on the given input:
                            </p>

                            <br>

                            <p class="python_output">
                                w = [0.18874253,  0.08090136, -0.41792539,  0.08950176,  0.05668385,  0.53847201, -0.49772711,  0.03788398,  0.02225932,  0.06727486,  -0.25157467,  0.03661574,  0.12969371,  0.18334708, -0.09503387,  -0.00958155,  0.11937432,  0.05633591, -0.05078202,  0.00330047,  -0.62323928, -0.10821759, -0.07951989,  0.51676867, -0.03020228,  -0.15570214,  0.16463813, -0.1225691 ,  0.01889327, -0.14996891]
                            </p>
                            <p class="python_output">
                                unlabeled sample = malignant 
                            </p>
                            <p class="python_output">
                                score: 0.8165137614678899
                            </p>

                            <br><br>

                            <p class="python_output">
                                w = [0.26862065, -0.08969064,  0.10675882, -0.20480725,  0.03182878,  0.56387106, -0.29113376,  0.01744558, -0.00306338, -0.17204584,  -0.42010163, -0.00475761,  0.27319777,  0.18194839, -0.0596274 ,  -0.140052  ,  0.16010498,  0.07033602, -0.07144339,  0.05492784,  -0.85372987,  0.10837559, -0.52158134,  0.78762591, -0.08777704,  0.02161435, -0.09353732, -0.10955592,  0.04298491, -0.08985858]
                            </p>
                            <p class="python_output">
                                unlabeled sample = malignant 
                            </p>
                            <p class="python_output">
                                score: 0.9174311926605505
                            </p>

                            <br><br>

                            <p class="python_output">
                                w = [0.60741604, -0.0783166 ,  0.19084787, -0.57105094,  0.0254105 ,  0.31805248,  0.0221376 , -0.17821628, -0.05557811,  0.02677952,  -0.22984055,  0.02629149,  0.38325686, -0.06919096, -0.03499296,  -0.00773795,  0.10934844, -0.13581128, -0.0997967 ,  0.02544605,  -0.94389006,  0.06884725, -1.00184867,  1.40059994, -0.02963356,  0.12541018, -0.12126272, -0.06037537,  0.08014855, -0.21461975]
                            </p>
                            <p class="python_output">
                                unlabeled sample = malignant 
                            </p>
                            <p class="python_output">
                                score: 0.8990825688073395
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