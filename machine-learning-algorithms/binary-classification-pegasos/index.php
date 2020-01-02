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
    <meta name="description"content="This algorithm is an iterative method, proposed in 2000, to solve a SVM classification without dealing with Quadratic Programming (QP) solutions. Its name comes from Primal Estimated sub-GrAdient SOlver for SVM. This method works with the primal unconstrained minimization SVM.">
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
        let start_time=1573067623;
    </script>
    <script src="../../js/post/index.js"></script>
    <title>Binary classification: PEGASOS | <?php echo APP_NAME; ?></title>
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
                                This algorithm is an iterative method, proposed in 2000, to solve a SVM classification 
                                without dealing with Quadratic Programming (QP) solutions. Its name comes from 
                                <span class="highlight">P</span>rimal <span class="highlight">E</span>stimated
                                sub-<span class="highlight">G</span>r<span class="highlight">A</span>dient
                                <span class="highlight">SO</span>lver for <span class="highlight">S</span>VM. This method 
                                works with the primal unconstrained minimization SVM. The main reference is found <a class="link" href="https://www.cs.huji.ac.il/~shais/papers/ShalevSiSrCo10.pdf">here</a>. 
                            </p>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>The optimization problem</h1>

                            <p class="article">
                                The Primal Unconstrained minimization of a SVM is: 
                            </p>

                            <p class="latex">
                                \[min_w: \frac{C}{2}\|\boldsymbol{w}\|^2 + \frac{1}{m}\displaystyle\sum_{i=1}^m max(0, 1-\boldsymbol{y}_i(\boldsymbol{w}^T \boldsymbol{X}_i))\]
                            </p>

                            <p class="article">
                                The objective is to get the values of the vector \(\boldsymbol{w}\). For the classify an unlabeled feature:
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
                                <li>Set \(B=\{1,2,3,...,nI\}\): a set from 1 to nI elements</li>
                                <li>Set \(\boldsymbol{w}=\{0_1,0_2,0_3,...,0_{nF}\}\): a zero-vector with nF elements</li>
                                <li>Set \(k\): the number of samples \(\{X,y\}\) to take into consideration at each iteration</li>
                                <li>Set \(T=nI\)</li>
                                <li>Set \(t=1\)</li>
                                <li>If \(t>T\): exit</li>
                                <li>Randomly: \(A_t\subseteq B \text{ with }|A_t|=k\), with \(A_t\) of length \(k\)</li>
                                <li>
                                    <p class="latex">
                                        \[A_t^+ =\{i\in A_t\mid y_i\langle\boldsymbol{w}_t\boldsymbol{X}_t\rangle < 1\}\]
                                    </p>
                                </li>
                                <li>\(s=\frac{1}{Ct}\)</li>
                                <li>
                                    <p class="latex">
                                        \[\boldsymbol{w}_{t+1}\leftarrow (1-sC)\boldsymbol{w}_t + \frac{s}{k} \displaystyle\sum_{i\in A_i^+}y_i\boldsymbol{X_i}\]
                                    </p>
                                </li>
                                <li>
                                    <p class="latex">
                                        \[\boldsymbol{w}_{t+1}\leftarrow min(1,\frac{1\sqrt{C}}{\|\boldsymbol{w}_{t+1}\|})\]
                                    </p>
                                </li>
                                <li>\(k=k+1\)</li>
                                <li>Go to step 11</li>
                            </ol>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Python Code</h1>

                            <pre><code class="python">

def fit(X, y, k=1, penalty=1, iterations=10):

    n_instances=len(y)

    n_features=len(X[0])

    w=np.zeros(n_features, dtype=np.float64)

    global W
    global C
    global b

    W=w
    b=0
    C=penalty

    # variables of convergence:
    sum_1=0
    sum_2=0
    c=(math.sqrt(C)+np.max(np.linalg.norm(X, axis=1)))**2
    A_t_array=[]

    for i in range(iterations):

        A_t=np.random.choice(n_instances, k, replace=False) # random choise subset of n_instances
        A_t_array.append(A_t)
        A_t_tuned=getTunedSubset(X, y, w, A_t)

        n_t=1/(C*(i+1)) # step size
        
        w=w*( 1 - n_t*C ) + ( n_t / k ) * np.sum(A_t_tuned, 0)
            
        w=w*min( 1, ( 1 / math.sqrt(C) ) / np.linalg.norm(w) )
        
        sum_1+=(C/2)*(np.linalg.norm(w))**2+(1/k)*getSumOfHingeLossForA_t(X, y, w, A_t)
        
        if i==iterations-1:
        
            for j in A_t_array:
                sum_2+=(C/2)*(np.linalg.norm(w))**2+(1/k)*getSumOfHingeLossForA_t(X, y, w, j)
                
            if (1/iterations)*sum_1 <= (1/iterations)*sum_2 + (c*(1+math.log(iterations)))/2*C*iterations:
                print("Got optimum w* solution after", iterations, "iterations")
                
            else: 
                print("Failed getting optimum w* solution after", iterations, "iterations")
            
            W=w
            
            unlabeled sample=[ 0.7534068,  -0.11394449,  0.71386598,  0.65815634, -0.54870557, -0.23729117,-0.05749318,  0.43439269,  0.29711878, -1.0571938,   0.69956576,  0.31596177,0.62519434,  0.59411043, -0.30600538, -0.04348982, -0.18679726,  0.68839558,0.04452071, -0.11419554,  0.78293974,  0.10141534,  0.69814393,  0.66698174,-0.6824632,  -0.26950087, -0.1937647,  0.49933764, -0.14682283, -0.6464708 ]

            type_cancer="benign"
            
            if np.dot(W,unlabeled sample) < 0: type_cancer="malignant"
            
            print("w=", W)
                
            print("unlabeled sample = ", type_cancer)
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
                                Got optimum w* solution after 10 iterations 
                            </p>
                            <p class="python_output">
                                w = [-0.15069671, -0.01151086, -0.14325101, -0.14570863, -0.00019509,  -0.02027337, -0.04948397, -0.09071151, -0.02422592,  0.08539943,  -0.11705517, -0.00342588, -0.09828861, -0.13180375,  0.03724529,  -0.02781042, -0.01446634, -0.05062253,  0.00973741,  0.03596281,  -0.18346759, -0.03108999, -0.1677182 , -0.19269945, -0.04153699,  -0.03370983, -0.0383926 , -0.10034278, -0.05628762,  0.04368789]
                            </p>
                            <p class="python_output">
                                unlabeled sample = malignant 
                            </p>
                            <p class="python_output">
                                score: 0.9541284403669725
                            </p>

                            <br><br>

                            <p class="python_output">
                                Got optimum w* solution after 10 iterations 
                            </p>
                            <p class="python_output">
                                w = [-0.20686934,  0.1973529 , -0.20770825, -0.21015289, -0.00816597,  -0.09172559, -0.15505612, -0.23583185,  0.10011091,  0.15157233,  -0.1919367 ,  0.17543604, -0.18531842, -0.1728421 , -0.00026198,  -0.04319045, -0.07153597, -0.24532546, -0.04022268,  0.0443598 ,  -0.19122475,  0.16122742, -0.19102686, -0.18262484, -0.06227437,  -0.06407785, -0.09965222, -0.22035173, -0.01040236,  0.00994991]
                            </p>
                            <p class="python_output">
                                unlabeled sample = malignant 
                            </p>
                            <p class="python_output">
                                score: 0.908256880733945
                            </p>

                            <br><br>

                            <p class="python_output">
                                Got optimum w* solution after 10 iterations 
                            </p>
                            <p class="python_output">
                                w = [-0.18486092, -0.08499988, -0.17808619, -0.16698979, -0.07370129,  -0.02336567, -0.08975441, -0.09691733,  0.01318181,  0.18290818,  0.03617729, -0.02507894,  0.00354094, -0.01653254, -0.00667443,  0.12991268,  0.08583866,  0.0537965 ,  0.13372307,  0.28272229,  -0.189421  , -0.18694772, -0.17774282, -0.16646996, -0.14889888,  -0.09593508, -0.06173081, -0.13823545, -0.1215791 ,  0.02815563]
                            </p>
                            <p class="python_output">
                                unlabeled sample = malignant 
                            </p>
                            <p class="python_output">
                                score: 0.9174311926605505
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