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
        let start_time=1577201386;
    </script>
    <script src="../../js/post/index.js"></script>
    <title>Multiclass classification: Artificial Neural Network - Standard Algorithm | <?php echo APP_NAME; ?></title>
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
                                The standard learning algorithm for training a neural network is called <em>backpropagation</em>
                                (backward propagation of error), and the purpose of this document is to try to show its formulation and
                                resolution, based on reliable references.
                            </p>

                            <br>

                            <p class="article">
                                One of the main usage of a neural network is in classification tasks, specially for multiclass
                                classification tasks, where there are three classes or more. In this document we are going to use 
                                <em>backpropagation</em> to train a neural network to classify a dataset containing 10 classes,
                                each representing a handwritten digit: \(0,1,2,3,4,5,6,7,8,9\). See the dataset <a href="https://archive.ics.uci.edu/ml/datasets/optical+recognition+of+handwritten+digits" class="link">here</a>.
                            </p>

                            <br>
                            
                            <p class="article">
                                The neural network to build is a <em>Feedforward Neural Network</em>. This is the simplest type
                                of network, and has a very simple estructure: neurons, layers with neurons, and neurons weights:
                            </p>

                            <img src="../../images/posts/ann_structure.png" alt="ANN STRUCTURE" class="image">

                            <br>

                            <p class="article">
                                The idea is to give input information (input layer) to get output results (output layer).
                            </p>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Feedforward neural network structure</h1>

                            <p class="article">
                                When building a neural network the first thing is to set its structure, that mainly implies to
                                set the number of hidden layers, and the number of neurons/nodes in each one of them. There
                                is always an input and an output layer, and the nodes in the input layer is determined
                                by the attributes of each sample in the dataset. In our case we are using the <a href="https://archive.ics.uci.edu/ml/datasets/optical+recognition+of+handwritten+digits"><em>Optical Recognition of Handwritten Digits Data Set</em></a>
                                which have 63 attributes per sample. The number of nodes in the output layer is determined by the number of
                                classes, in this case 10 classes, then there will be 10 output nodes.
                            </p>

                            <br>

                            <p class="article">
                                Because this dataset and the task classification to aim is not too complex, with one hidden layer should be
                                enough. the only hidden layer will contain 52 nodes. This was derived by below calculation:
                            </p>

                            <p class="latex">
                                \[nhidden=ninput \times \frac{2}{3} + noutput = 63 \times \frac{2}{3} + 10 = 52\]
                            </p>

                            <br>

                            <p class="article">
                                Finally, the neural network configuration is: 63 input nodes, 52 hidden nodes and 10 output nodes. This
                                estructure is called 2-layer neural network, the input layer does not count because no calculations are made
                                in this layer, this layer only contain the external data information. The neural net looks like this: 
                            </p>

                            <img src="../../images/posts/nn-config.png" alt="NEURAL NETWORK CONFIGUTATION" class="image">

                            <br>

                            <p class="article">
                                Knowing the network configuration, the feedforward neural network do the following:
                            </p>

                            <h2>Weighted sum</h2>

                            <p class="latex">
                                \[
                                \begin{align}
                                    h_{1} & = w_{a1,1}x_{1} + w_{a1,2}x_{2} + w_{a1,3}x_{3} + \dots + w_{a1,63}x_{63}\\
                                    h_{2} & = w_{a2,1}x_{1} + w_{a2,2}x_{2} + w_{a2,3}x_{3} + \dots + w_{a2,63}x_{63}\\
                                    h_{3} & = w_{a3,1}x_{1} + w_{a3,2}x_{2} + w_{a3,3}x_{3} + \dots + w_{a3,63}x_{63}\\
                                    & \vdots\\
                                    h_{52} & = w_{a52,1}x_{1} + w_{a52,2}x_{2} + w_{a52,3}x_{3} + \dots + w_{a52,63}x_{63}
                                \end{align}
                                \]
                            </p>

                            <h2>Softmax activation</h2>

                            <p class & = "latex">
                                \[
                                \begin{align}
                                    h_{1} & = \frac{exp(h_{1})}{\displaystyle\sum_{i}^{52}exp(h_i)}\\
                                    h_{2} & = \frac{exp(h_{2})}{\displaystyle\sum_{i}^{52}exp(h_i)}\\
                                    h_{3} & = \frac{exp(h_{3})}{\displaystyle\sum_{i}^{52}exp(h_i)}\\
                                    & \vdots\\
                                    h_{52} & = \frac{exp(h_{52})}{\displaystyle\sum_{i}^{52}exp(h_i)}
                                \end{align}
                                \]
                            </p>

                            <br>

                            <p class="article">
                                Where \(w_{n,n}\) are the optimum weights after network's training. In the next slides we will see
                                how to calculate these weights. The <em>softmax activation</em> is a vector function \(R^k \to R^k\)
                                that works as transfer function (or activation function). Read more <a href="https://en.wikipedia.org/wiki/Softmax_function" class="link">here</a>. 
                            </p>

                            <br>

                            <p class="article">
                                After calculating every hidden neuron \(h_n\), these ones are taken as input for the output layer, that is:
                            </p>

                            <h2>Weighted sum</h2>

                            <p class="latex">
                                \[
                                \begin{align}
                                    y_{1} & = w_{b1,1}h_{1} + w_{b1,2}h_{2} + w_{b1,3}h_{3} + \dots + w_{b1,52}h_{52}\\
                                    y_{2} & = w_{b2,1}h_{1} + w_{b2,2}h_{2} + w_{b2,3}h_{3} + \dots + w_{b2,52}h_{52}\\
                                    y_{3} & = w_{b3,1}h_{1} + w_{b3,2}h_{2} + w_{b3,3}h_{3} + \dots + w_{b3,52}h_{52}\\
                                    & \vdots\\
                                    y_{10} & = w_{b10,1}h_{1} + w_{b10,2}h_{2} + w_{b10,3}h_{3} + \dots + w_{b10,52}h_{52}
                                \end{align}
                                \]
                            </p>

                            <h2>Softmax activation</h2>

                            <p class="latex">
                                \[
                                \begin{align}
                                    y_{1} & = \frac{exp(y_{1})}{\displaystyle\sum_{i}^{10}exp(y_i)}\\
                                    y_{2} & = \frac{exp(y_{2})}{\displaystyle\sum_{i}^{10}exp(y_i)}\\
                                    y_{3} & = \frac{exp(y_{3})}{\displaystyle\sum_{i}^{10}exp(y_i)}\\
                                    & \vdots\\
                                    y_{10} & = \frac{exp(y_{10})}{\displaystyle\sum_{i}^{10}exp(y_i)}\\
                                \end{align}
                                \]
                            </p>

                            <br>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Target vector - output vector</h1>

                            <p class="article">
                                In classification problems, every class is seen as a vector: the target vector. For example
                                in our case, we have 10 classes: number 0, number 1, ..., number 9. These values are seen as vectors,
                                specifically a one-hot vector:
                            </p>

                            <br>

                            <p class="latex">
                                \[
                                0=[1,0,0,0,0,0,0,0,0,0]\\
                                1=[0,1,0,0,0,0,0,0,0,0]\\
                                2=[0,0,1,0,0,0,0,0,0,0]\\
                                3=[0,0,0,1,0,0,0,0,0,0]\\
                                4=[0,0,0,0,1,0,0,0,0,0]\\
                                5=[0,0,0,0,0,1,0,0,0,0]\\
                                6=[0,0,0,0,0,0,1,0,0,0]\\
                                7=[0,0,0,0,0,0,0,1,0,0]\\
                                8=[0,0,0,0,0,0,0,0,1,0]\\
                                9=[0,0,0,0,0,0,0,0,0,1]
                                \]
                            </p>

                            <br>

                            <p class="article">
                                The output vector is the the vector containing the nodes of the output layer. For that reason, in
                                our example we have 10 ouput nodes. This allows us to know the quality of the neural network, just
                                checking if the maximum element in the target vector coincides with the maximum element in the output vector,
                                if so, the example is classified correctly.
                            </p>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Backpropagation</h1>

                            <p class="article">
                                Given initial-random weights, the idea is to iteratively adjust/update these weights to minimize the
                                discrepancy between the target vector and the output vector. This discrepancy is calculated with a loss function.
                                The most popular for multiclass classification is <em>Cross Entropy Loss</em>. For example, suppose that
                                the target vector is
                            </p>
                                
                            <p class="latex">
                                \[[0,0,1,0,0,0,0,0,0,0]\] 
                            </p>

                            <p class="article">
                                and after a certain sample go through the network, the output vector is
                            </p>

                            <p class="latex">
                                \[[0.1,0.2,0.25,0.1,0.1,0.1,0.05,0.05,0.025,0.025]\]
                            </p>
                            
                            <p class="article">
                                The discrepancy is calculated as:
                            </p>

                            <br>

                            <p class="latex">
                                \[
                                \begin{align}
                                E & =-\displaystyle\sum_i^{class}t_i ln(y_i)\\
                                & =-t_{1}ln(y_{1})-t_{2}ln(y_{2})-t_{3}ln(y_{3})-t_{4}ln(y_{4})-t_{5}ln(y_{5})-t_{6}ln(y_{6})-t_{7}ln(y_{7})-t_{8}ln(y_{8})-t_{9}ln(y_{9})-t_{10}ln(y_{10})\\
                                & =-0 \times ln(0.1)-0 \times ln(0.2)-1 \times ln(0.25)-0 \times ln(0.1)-0 \times ln(0.1)-0 \times ln(0.1)-0 \times ln(0.05)-0 \times ln(0.05)-0 \times ln(0.025)-0 \times ln(0.025)\\
                                & =1.3863294361
                                \end{align}
                                \]
                            </p>

                            <br>

                            <p class="article">
                                Where \(ln(x)\) is the natural logarithm and \(y_i\) is the \(ith\) element of the output vector,
                                in our case is a <em>softmax vector</em>.  \(t_i\) is the \(ith\) element of the target vector.

                                <br><br>

                                Because the target vector is a one-hot vector, the <em>Cross entropy</em> is simplified as:
                            </p>

                            <p class="latex">
                                \[E=-ln(y_p), \quad \text{where } p \text{ is the one-hot position}\]
                            </p>

                            <br>

                            <p class="article">
                                When trying to minimize a function, the ideal result is zero. In the above equation, if \(y_p=1\),
                                then \(E=-ln(y_p)=0\), because is exactly like the target vector, there is no discrepancy.
                            </p>

                            <br>

                            <p class="article">
                                <em>Backpropagation</em> adjusts the weights to get a minor error in each iteration. And it does with the
                                following formula:
                            </p>

                            <p class="latex">
                                \[w_{i}=w_{i-1} - \eta \frac{\partial E}{\partial w_{i-1}}\]
                            </p>

                            <br>

                            <p class="article">
                                \(\eta\) is the <em>learning rate</em>, a value generally between 0 and 1. This value can be setted to 1 for now.                                <br>
                                \(\frac{\partial E}{\partial w_{i-1}}\) is the partial derivative of the <em>Cross entropy error</em> with respect
                                to the weight.

                                <br><br>

                                This form of updating the weights is called <em>gradient descent</em>. Lets calculate the gradient:
                            </p>

                            <br>

                            <p class="latex">
                                \[
                                \begin{align}
                                    E & =-t_p ln(y_p)\\
                                    y_p & = \frac{exp(s_p)}{\displaystyle\sum_i^{nclass}exp(s_i)}\\
                                    s_p & = w_{p1} x_{1} + w_{p2} x_{2} + \dots + w_{p10} x_{10}\\
                                    s_i & = w_{i1} x_{1} + w_{i2} x_{2} + \dots + w_{i10} x_{10}
                                \end{align}
                                \]
                            </p>

                            <h2>Weights connecting with output layer</h2>

                            <p class="latex">
                                \[
                                \begin{align}
                                    \frac{\partial E}{\partial w_{ji}} & = \frac{\partial E}{\partial y_{i}} \times \frac{\partial y_i}{\partial s_{i}} \times \frac{\partial s_i}{\partial w_{ji}}, \quad \text{for } ith \text{ weight in } jth \text{ hidden node} 
                                \end{align}
                                \]
                            </p>

                            <br>

                            <img src="../../images/posts/weight-connection.png" alt="WEIGHTS PER OUTPUT NODE" class="image">
                        
                            <p class="latex">
                                \[
                                \begin{align}
                                    \frac{\partial E}{\partial y_i} & = -\frac{t_i}{y_i}\\[20pt]
                                    \frac{\partial y_i}{\partial s_k} & = 
                                    \begin{cases}
                                        \frac{exp(s_i)}{\displaystyle\sum_c ^ {nclass} exp(s_c)} - \left(\frac{exp(s_i)}{\displaystyle\sum_c ^ {nclass} exp(s_c)}\right)^2 & \quad \text{if } i=k\\
                                        -\frac{exp(s_i)exp(s_k)}{\left(\displaystyle\sum_c ^ {nclass} exp{(s_i)}\right)^2} & \quad \text{if } i \neq k
                                    \end{cases}\\
                                    & = 
                                    \begin{cases}
                                        y_i(1 - y_i) & \quad \text{if } i=k\\
                                        -y_i y_k & \quad \text{if } i \neq k
                                    \end{cases}\\[20pt]
                                    \frac{\partial E}{\partial s_i} & = \displaystyle\sum_k ^ {nclass} \frac{\partial E}{\partial y_k} \frac{\partial y_k}{\partial s_i}\\
                                    & = \frac{\partial E}{\partial y_i} \frac{\partial y_i}{\partial s_i} - \displaystyle\sum_{k \neq i} \frac{\partial E}{\partial y_k} \frac{\partial y_k}{\partial s_i}\\
                                    & = -t_i(1-y_i) + \displaystyle\sum_{k \neq i} t_k y_i\\
                                    & = -t_i + y_i \displaystyle\sum_k t_k\\
                                    & = y_i - t_i\\[20pt]
                                    \frac{\partial s_i}{\partial w_{ji}} & = h_j \\[20pt]
                                    \frac{\partial E}{\partial w_{ji}} & = \frac{\partial E}{\partial s_i} \frac{\partial s_i}{\partial w_{ji}}\\
                                    & = (y_i - t_i)h_j
                                \end{align}
                                \]
                            </p>

                            <h2>Weights connecting with hidden layer</h2>

                            <p class="article">
                                Weight \(w_{kj}\) connecting input unit \(k\) to hidden unit \(j\) has gradient:
                            </p>

                            <p class="latex">
                                \[
                                \begin{align}

                                    \frac{\partial E}{\partial w_{kj}} & = \frac{\partial E}{\partial s_j} \frac{\partial s_j}{\partial w_{kj}}\\[20pt]
                                    \frac{\partial E}{\partial s_j} & = \left(\displaystyle\sum_i ^ {nclass} \frac{\partial E}{\partial s_i} \times \frac{\partial s_i}{\partial h_j}\right) \times \frac{\partial h_j}{\partial s_j}\\
                                    & = \left(\displaystyle\sum_i ^ {nclass} (y_i - t_i) w_{ji} \right) (h_j (1 - h_j))\\[20pt]
                                    \frac{\partial s_j}{\partial w_{kj}} & = x_k \\[20pt]
                                    \frac{\partial E}{\partial w_{kj}} & = \frac{\partial E}{\partial s_j} \frac{\partial s_j}{\partial w_{kj}}\\
                                    & = \left(\displaystyle\sum_i ^ {nclass} (y_i - t_i) w_{ji} \right) (h_j (1 - h_j)) x_k

                                \end{align}
                                \]
                            </p>

                            <h2>Reference</h2>

                            <p class="article">
                                This gradient formulation and resolutian was found <a href="https://www.ics.uci.edu/~pjsadows/notes.pdf" class="link">here</a>.
                            </p>

                            <h2>Practical example</h2>

                            <p class="article">
                                In this example, we apply <em>backpropagation</em> to adjust initial-random weights, given an arbitrary training
                                sample \([x_1,x_2]\) and a target vector \([t_1,t_2]\). This is the <em>Neural Network Structure</em>:
                            </p>

                            <img src="../../images/posts/simple_nn.png" alt="SIMPLE NEURAL NET STRUCTURE" class="image">

                            <br>

                            <p class="latex">
                                \[
                                \begin{align}
                                & x_1 = 7 \\
                                & x_2 = 3.5 \\[10pt]
                                & t_1 = 1 \\
                                & t_2 = 0 \\[10pt]
                                & \eta = 1 \quad \text{learning rate, can be any value} \\[10pt]
                                & w_{a1,1} = 0.1 \\
                                & w_{a1,2} = 0.2 \\
                                & w_{a2,1} = 0.01 \\
                                & w_{a2,2} = 0.4 \\
                                & w_{b1,1} = 0.1 \\
                                & w_{b1,2} = 0.1 \\
                                & w_{b2,1} = 0.3 \\
                                & w_{b2,2} = 0.1 \\[10pt]
                                & \text{feedworward:} \\
                                & h_1 = w_{a1,1}x_1 + w_{a2,1}x_2 = 0.735 \\
                                & h_2 = w_{a1,2}x_1 + w_{a2,2}x_2 = 2.8 \\
                                & h_1 = \frac{exp(h1)}{exp(h1) + exp(h2)}=0.11254547 \\
                                & h_2 = \frac{exp(h2)}{exp(h1) + exp(h2)}=0.88745453 \\[10pt]
                                & y_1 = w_{b1,1}h_1 + w_{b2,1}h_2 = 0.277490906 \\
                                & y_2 = w_{b1,2}h_1 + w_{b2,2}h_2 = 0.1 \\
                                & y_1 = \frac{exp(y1)}{exp(y1) + exp(y2)}=0.5442566 \\
                                & y_2 = \frac{exp(y2)}{exp(y1) + exp(y2)}=0.4557434 \\[10pt]
                                & \text{Cross entropy error} \\
                                & E=-t_1 ln(y_1)=0.6083344521610367 \\[10pt]
                                & \text{backpropagation (hidden-output weights):} \\
                                & \frac{\partial E}{\partial w_{b1,1}}=(y_1 - t_1)h_1=-0.051291855 \\
                                & \frac{\partial E}{\partial w_{b1,2}}=(y_2 - t_2)h_1=0.051291855 \\
                                & \frac{\partial E}{\partial w_{b2,1}}=(y_1 - t_1)h_2=-0.404451544 \\
                                & \frac{\partial E}{\partial w_{b2,2}}=(y_2 - t_2)h_2=0.404451544 \\[10pt]
                                & w_{b1,1}=w_{b1,1} - \eta \frac{\partial E}{\partial w_{b1,1}} = 0.151291855 \\
                                & w_{b1,2}=w_{b1,2} - \eta \frac{\partial E}{\partial w_{b1,2}} = 0.048708145 \\
                                & w_{b2,1}=w_{b2,1} - \eta \frac{\partial E}{\partial w_{b2,1}} = 0.704451544 \\
                                & w_{b2,2}=w_{b2,2} - \eta \frac{\partial E}{\partial w_{b2,2}} = -0.304451544 \\[10pt]
                                & \text{backpropagation (input-hidden weights):} \\
                                & \frac{\partial E}{\partial w_{a1,1}}= \left(\displaystyle\sum_{i=1} ^ {2} (y_i - t_i) w_{b1,i} \right) (h_1 (1 - h_1)) x_1=0.0 \\
                                & \frac{\partial E}{\partial w_{a1,2}}= \left(\displaystyle\sum_{i=1} ^ {2} (y_i - t_i) w_{b2,i} \right) (h_2 (1 - h_2)) x_1=-0.0637268648899 \\
                                & \frac{\partial E}{\partial w_{a2,1}}= \left(\displaystyle\sum_{i=1} ^ {2} (y_i - t_i) w_{b1,i} \right) (h_1 (1 - h_1)) x_2=0.0 \\
                                & \frac{\partial E}{\partial w_{a2,2}}= \left(\displaystyle\sum_{i=1} ^ {2} (y_i - t_i) w_{b2,i} \right) (h_2 (1 - h_2)) x_2=-0.031863432445 \\[10pt]
                                & w_{a1,1}=w_{a1,1} - \eta \frac{\partial E}{\partial w_{a1,1}}=0.1 \\
                                & w_{a1,2}=w_{a1,2} - \eta \frac{\partial E}{\partial w_{a1,2}}=0.263726864 \\
                                & w_{a2,1}=w_{a2,1} - \eta \frac{\partial E}{\partial w_{a2,1}}=0.01 \\
                                & w_{a2,2}=w_{a2,2} - \eta \frac{\partial E}{\partial w_{a2,2}}=0.431863432 \\
                                \end{align}
                                \]
                            </p>

                            <p class="article">
                                We then do the <em>feedforward</em> again with the updated weights, and the error \(E\) should be minor:
                            </p>

                            <br>

                            <p class="latex">
                                \[
                                \begin{align}
                                    & \text{feedworward:} \\
                                    & h_1 = w_{a1,1}x_1 + w_{a2,1}x_2 = 0.735 \\
                                    & h_2 = w_{a1,2}x_1 + w_{a2,2}x_2 = 3.35761006 \\
                                    & h_1 = \frac{exp(h1)}{exp(h1) + exp(h2)}=0.06769738 \\
                                    & h_2 = \frac{exp(h2)}{exp(h1) + exp(h2)}=0.93230262 \\[10pt]
                                    & y_1 = w_{b1,1}h_1 + w_{b2,1}h_2 = 0.667004082 \\
                                    & y_2 = w_{b1,2}h_1 + w_{b2,2}h_2 = -0.280543558 \\
                                    & y_1 = \frac{exp(y1)}{exp(y1) + exp(y2)}=0.72062172 \\
                                    & y_2 = \frac{exp(y2)}{exp(y1) + exp(y2)}=0.27937828 \\[10pt]
                                    & \text{Cross entropy error} \\
                                    & E=-t_1 ln(y_1)=0.3276409395736821
                                \end{align}
                                \]
                            </p>

                            <br>

                            <p class="article">
                                After just 10 iterations, we got an error of 0.05315358340693026. Remember that
                                the first error was 0.6083344521610367.
                            </p>

                            <pre><code class="python">
X=numpy.array([[7,3.5]], dtype=numpy.dtype('Float64'))
y=numpy.array([[1,0]], dtype=numpy.dtype('Float64'))

def nn(X, y, iterations=10):
    W=[numpy.array([[0.1, 0.01],[0.2, 0.4]], dtype=numpy.dtype('Float64')), numpy.array([[0.1, 0.3],[0.1, 0.1]], dtype=numpy.dtype('Float64'))]

    for ep in range(iterations):
        lr=1
        
        for i,x in enumerate(X):
            X_rec=[x]
            
            for layer,w in enumerate(W):
                nets=[]

                for node in w:
                    nets.append(numpy.matmul(node,x))

                x=softmax(nets)

                X_rec.append(x)

            X_rec=X_rec[:-1]

            delta_err=x - y[i]

            print('error: ' + str(-numpy.log(x[ list(y[i]).index(1) ])))

            gradients=[]

            for j in reversed([i for i in range(len(W[1:]))]):
                gradients.append( numpy.array( [ sum( [ delta_err[i] * W[j+1][i] for i in range( len( delta_err ) ) ] ) * X_rec[j+1]*( 1 - X_rec[j+1] ) * h for h in X_rec[j] ], dtype=numpy.dtype('Float64')).transpose() )

            gradients.insert( 0, numpy.array( [ delta_err * i for i in X_rec[-1] ], dtype=numpy.dtype('Float64') ).transpose() )
            
            for j,g in enumerate(reversed(range(len(W)))):
                W[j]=W[j] - lr * gradients[g]
    return W

nn(X,y)
                            </code></pre>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Learning rate</h1>

                            <p class="article">
                                The <em>learning rate</em> can be seen as a percent change, where \(1\) represents 100% of change and \(0\),
                                no change at all. This value is a <em>tunning parammeter</em> (setted before a process starts) that
                                "determines the step size at each iteration while moving toward a minimum of a loss function"<sub><a href="https://en.wikipedia.org/wiki/Learning_rate" class="link">ref</a></sub>.
                                The learning rate is often denoted with the character \(\eta\) or \(\alpha\).
                            </p>

                            <p class="latex">
                                \[w_{new}=w_{old} - \eta \frac{\partial E}{\partial w_{old}}\]
                            </p>
                                
                            <br>
                            
                            <p class="article">
                                A good method to set the learning rate is called <em>Cyclical Learning Rates</em>, which instead of setting a static value,
                                at each iteration, changes it in a cyclical-triangular way. See the author's paper <a href="https://arxiv.org/pdf/1506.01186.pdf" class="link">here</a>.

                                <br><br>

                                The following <em>python function</em> is used to get cyclical learning rates:
                            </p>

                            <pre><code class="python">
import math

def triangular(iteration, stepsize, base_lr, max_lr):
    cycle = math.floor(1 + iteration/(2  * stepsize))
    x = abs(iteration/stepsize - 2 * cycle + 1)
    lr = base_lr + (max_lr - base_lr) * max(0, (1-x))
    return lr
                            </code></pre>

                            <br>

                            <p class="article">
                                Where <em>stepsize</em> is the number of iterations to complete half-cycle. <em>base_lr</em> is
                                the minimum learning rate to pick, and <em>max_lr</em> is the maximum learning rate to pick. The
                                plot below shows the performance of function above:
                            </p>

                            <img src="../../images/posts/learning_rate.png" alt="LEARNING RATE" class="image">

                            <br>

                            <p class="article">
                                this is the <em>learning rate method</em> that we are going to use with the <em>handwritten digits</em> dataset.
                            </p>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Handwritten digits classification</h1>

                            <p class="article">
                                Now that we know how to use <em>backpropagation</em>, we can use it to train our 63 input nodes, 52 hidden nodes,
                                10 output nodes neural network, with the <a href="https://archive.ics.uci.edu/ml/datasets/optical+recognition+of+handwritten+digits" class="link">handwritten digits</a>
                                dataset. This dataset contains 3823 training instances, 1797 testing instances and has 63 attributes per class. When the
                                dataset is relatively large, it is normal to apply <em>mini-batch learning</em>, which instead of updating the weights for each example,
                                it does "accumulating" or summing the gradients using a determined number of examples (batch size), and updates the weights with this "gradient accumulation". See
                                <a href="https://machinelearningmastery.com/gentle-introduction-mini-batch-gradient-descent-configure-batch-size/">this article</a> for a more detailed explanation.
                            
                                <br><br>

                                We follow these parammeters to train the network:

                                <br><br>

                                - mini batches: 10
                                <br>
                                - epochs: 64
                                <br>
                                - iterations: 640
                                <br>
                                - learning rate cycles: 4
                                <br>
                                - minimum learning rate: 0.001
                                <br>
                                - maximum learning rate: 0.0275 
                                <br>
                                - Activation function: softmax
                                <br>
                                - Loss function: cross entropy
                            </p>

                            <pre><code class="python">
import numpy, time
from data import X_train, X_test, y_train, y_test

def init_weights(ninput, nhidden, noutput):
    if type(nhidden) is int:
        nhidden=[nhidden]

    res=[]

    for l in range(len(nhidden)):
        res.append([])
        for nodes in range(nhidden[l]):
            res[l].append([])
            for i in range(ninput):
                res[l][nodes].append(numpy.random.ranf())
        ninput=len(res[l])

    res.append([])

    res[len(res)-1]=[[] for i in range(noutput)]

    for i in range(len(res[len(res)-2])):
        for j in range(noutput):
            res[len(res)-1][j].append(numpy.random.ranf())

    return [numpy.array(i, numpy.dtype('Float64')) for i in res]

def triangular(iteration, stepsize, base_lr, max_lr):
    cycle = numpy.floor(1 + iteration/(2  * stepsize))
    x = numpy.abs(iteration/stepsize - 2 * cycle + 1)
    lr = base_lr + (max_lr - base_lr) * numpy.maximum(0, (1-x))
    return lr

def E(x, hot_idx): # cross entropy loss
    return -numpy.log(x[hot_idx])

def softmax(x):
    e_x = numpy.exp(x - numpy.max(x))
    return e_x / e_x.sum()

def nn(X,y,nhidden,noutput):
    ninput=len(X[0])

    W=init_weights(ninput, nhidden, noutput)

    batches=10 # number of mini batches

    cycles, stepsize = 4, batches*8

    X_batches=numpy.array_split(X_train, batches)
    y_batches=numpy.array_split(y_train, batches)

    for ep in range( int( ( stepsize / batches ) * 2 * cycles ) ):
        for b, batch in enumerate(X_batches): 
            lr=triangular(b + batches*ep, stepsize, .001, .0275)

            batch_size=len(batch)

            err=[]
            
            delta_acummulation=[numpy.zeros(numpy.shape(w)) for w in reversed(W)]
            
            for i,x in enumerate(batch):
                X_rec=[x]
                
                for layer,w in enumerate(W):
                    nets=[]

                    for node in w:
                        nets.append(numpy.matmul(node,x))

                    x=softmax(nets)

                    X_rec.append(x)

                X_rec=X_rec[:-1]

                delta_err=x - y_batches[b][i]

                err.append(E(x,y_batches[b][i].index(1)))

                gradients=[]

                for j in reversed([i for i in range(len(W[1:]))]):
                    gradients.append( numpy.array( [ sum( [ delta_err[i] * W[j+1][i] for i in range( len( delta_err ) ) ] ) * X_rec[j+1]*( 1 - X_rec[j+1] ) * h for h in X_rec[j] ], dtype=numpy.dtype('Float64')).transpose() )

                gradients.insert( 0, numpy.array( [ delta_err * i for i in X_rec[-1] ], dtype=numpy.dtype('Float64') ).transpose() )

                for d in range(len(delta_acummulation)):
                    delta_acummulation[d]=delta_acummulation[d] - lr * gradients[d]
                
            for j,g in enumerate(reversed(range(len(W)))):
                W[j]=W[j] + delta_acummulation[g]

    return W

def error_rate(X, y, W):
    p=0

    for i, x in enumerate(X):
        for layer, w in enumerate(W):
            nets=[]
            for node in w:
                nets.append(numpy.matmul(node,x))

            x=softmax(nets)

        y_hat=list(x).index(max(x))
        y_true=list(y[i]).index(max(y[i]))

        if y_hat!=y_true: p+=1

    return p/len(y)

scores=[]

start=time.time()

for i in range(3):
    scores.append(error_rate(X_test, y_test, nn(X_train, y_train, 52, 10)))

print(numpy.mean(scores), scores)

end=time.time()

print(str(end - start) + ' seconds')
                            </code></pre>

                            <br>

                            <p class="article">
                                The code above gives us the following result:

                                <br><br>

                                Error rate after 3 attempts: 0.1758486366165832, 0.057317751808569836, 0.06399554813578186
                                <br>
                                Mean error rate: 0.09905397885364496

                                <br><br>

                                Which is not perfect but a good result.
                            </p>

                            <img src="../../images/posts/output_code.png" alt="OUTPUT RESULT" class="image">
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