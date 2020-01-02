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
    <meta name="description"content="The first thing to know about binary numbers, is how counting with these numbers, just like we did with decimal numbers.">
    <link rel="shortcut icon" class="link" href="../../images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" class="link" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" class="link" href="../../css/post/index.css">
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
        let start_time=1572897420;
    </script>
    <script src="../../js/post/index.js"></script>
    <title>Binary numbers | <?php echo APP_NAME; ?></title>
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
                                The first thing to know about binary numbers, is how counting with these numbers, just
                                like we did with decimal numbers. 
                            </p>

                            <br>

                            <p class="article">
                                The main tool to understand binary numbers is with decimal numbers. That is, the number system
                                with 10 digits: 0, 1, 2, 3, 4, 5, 6, 7, 8 and 9.
                            </p>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Counting in binary</h1>

                            <p class="article">
                                With decimal numbers there are ten possible different symbols. From least to greatest
                                they are:
                            </p>

                            <p class="latex">
                                \[0,1,2,3,4,5,6,7,8,9\]
                            </p>

                            <p class="article">
                                When counting in decimals, we have to notice what happens when we reach the number 9. This
                                number is the "last possible digit" when counting in decimals. After this number, we have to
                                "reset", i.e., after 9 follow 10. That is because 9 is reseted to 0 and the number on the left
                                is increased by 1. What is the number on the left of 9? It is 0: \(9=09\). For that reason we got
                                10 after 9. The same happens with 19. The 9 is converted to 0 and the number on the left (1) is
                                increased 1 unit. After 19 follow 20. And the same happens with 99. These two 9's are reseted to 0
                                and the number on the left is increased. The number on the left is 0, \(99=099\). For that reason
                                after 99 follow 100.
                            </p>

                            <p class="latex opaque">
                                \[\color{#ff4800}0,\color{#ff4800}1,\color{#ff4800}2,\color{#ff4800}3,\color{#ff4800}4,\color{#ff4800}5,\color{#ff4800}6,\color{#ff4800}7,\color{#ff4800}8,\color{#ff4800}9,1\color{#ff4800}0,1\color{#ff4800}1,1\color{#ff4800}2,1\color{#ff4800}3,1\color{#ff4800}4,1\color{#ff4800}5,1\color{#ff4800}6,1\color{#ff4800}7,1\color{#ff4800}8,1\color{#ff4800}9,2\color{#ff4800}0,2\color{#ff4800}1,2\color{#ff4800}2,2\color{#ff4800}3,2\color{#ff4800}4,2\color{#ff4800}5,2\color{#ff4800}6,2\color{#ff4800}7,2\color{#ff4800}8,2\color{#ff4800}9,...\]
                            </p>

                            <br>

                            <p class="article">
                                The procedure with binary numbers is the same. Only that instead of 10 possible symbols there are
                                only 2 (0 and 1). Then, the last possible digit is 1 (instead of 9).
                            </p>

                            <br>

                            <p class="article">
                                When we reach a 1, this one is reseted to 0 and the number on the left is increased by 1. For example
                                after 1 we got 10, because we reset 1 to 0 and the number on the left is increased: \(1=01\). After 10
                                follow 11 because we normally can increase 0 to 1. After 11 follow 100, because \(11=011\) and these two
                                one's are reseted to 0 and the leftmost digit is increased. After 100 follow 101, after 101 follow
                                110, after 110 follow 111, after \(111=0111\) follow 1000, etc. 
                            </p>

                            <p class="latex">
                                \[0,1,10,11,100,101,110,111,1000,1001,1010,1011,1100,1101,1110,1111,10000\]
                            </p>

                            <img src="../../images/posts/Binary_counter.gif" alt="BINARY COUNTING" class="image">

                            <br>

                            <p class="article">
                                You can find a better explanation <a class="link" href="https://en.wikipedia.org/wiki/Binary_number#Counting_in_binary">here</a>.
                            </p>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Converting binary number to decimal number</h1>

                            <p class="article">
                                It's important to mention that like decimal numbers, binary numbers can have fractional
                                part.
                            </p>

                            <h2>Converting 101101</h2>

                            <p class="article">
                                - Set the position of every digit, from right to left and from least to greatest, starting with 0:
                            </p>

                            <img class="image" src="../../images/posts/num_position.jpg" alt="NUMBERS POSITION">

                            <p class="article">
                                - Multiply every digit by 2 raised to the power of the corresponding position:
                            </p>

                            <p class="latex big_font">
                                \[2^\color{#f46904}{5}\times1\quad 2^\color{#f46904}{4}\times0\quad 2^\color{#f46904}{3}\times1\quad 2^\color{#f46904}{2}\times1\quad 2^\color{#f46904}{1}\times0\quad 2^\color{#f46904}{0}\times1\quad\]
                            </p>

                            <p class="latex big_font">
                                \[32\quad 0\quad 8\quad 4\quad 0\quad 1\quad\]
                            </p>

                            <p class="article">
                                - Sum the results:
                            </p>

                            <p class="latex big_font">
                                \[32+0+8+4+0+1=45\]
                            </p>

                            <h2>Converting 0.01</h2>

                            <p class="article">
                                - Set the position of every digit, from left to right and from greatest to least, starting with 0:
                            </p>

                            <img class="image" src="../../images/posts/step-1-binary-fractional-to-decimal.jpg" alt="NUMBERS POSITION">

                            <p class="article">
                                - Multiply every digit by 2 raised to the power of the corresponding position:
                            </p>

                            <p class="latex big_font">
                                \[2^\color{#f46904}{0}\times0\quad 2^\color{#f46904}{-1}\times0\quad 2^\color{#f46904}{-2}\times1\]
                            </p>

                            <p class="latex big_font">
                                \[0\quad 0\quad \frac{1}{4}\]
                            </p>

                            <p class="article">
                                - Sum the results:
                            </p>

                            <p class="latex big_font">
                                \[0+0+\frac{1}{4}=\frac{1}{4}\]
                            </p>

                            <br>

                            <p class="article">
                                More information about binary convertion: <a class="link" href="https://en.wikipedia.org/wiki/Binary_number#Conversion_to_and_from_other_numeral_systems">Wikipedia article</a>.
                            </p>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Converting decimal number to binary number</h1>

                            <h2>Converting 99</h2>

                            <p class="article">
                                - Until reach a quotient of 1, divide the number by 2, like that:
                            </p>

                            <p class="latex big_font">
                                \[99\div 2=49 \text{ mod }\color{#f46904}{1}\\
                                49\div 2=24 \text{ mod }\color{#f46904}{1}\\
                                24\div 2=12 \text{ mod }\color{#f46904}{0}\\
                                12\div 2=6 \text{ mod }\color{#f46904}{0}\\
                                6\div 2=3 \text{ mod }\color{#f46904}{0}\\
                                3\div 2=1 \text{ mod }\color{#f46904}{1}\\
                                1\div 2=1 \text{ mod }\color{#f46904}{1}\]
                            </p>

                            <p class="article">
                                - Flip vertically the remainder sequence, and that is the result: \(99_{10}=1100011_2\)
                            </p>

                            <h2>Converting \(\frac{1}{4}\)</h2>

                            <p class="article">
                                - Until reach an equality, multiply by 2, like that:
                            </p>

                            <p class="latex big_font">
                                \[\frac{1}{4} < 1\quad\color{#f46904}{0.}\\
                                \frac{2}{4} < 1\quad\color{#f46904}{0.0}\\
                                \frac{4}{4} = 1\quad\color{#f46904}{0.01}\\\]
                            </p>

                            <p class="article">
                                The result is: \(\frac{1}{4}_{10}=0.01_2\)
                            </p>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Binary addition</h1>

                            <p class="latex big_font">
                                \[0+0=0\\
                                0+1=1\\
                                1+0=1\\
                                1+1=0\text{ carry 1}\]
                            </p>

                            <img class="image" src="../../images/posts/binary-addition.jpeg" alt="BINARY ADDITION">
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Binary subtraction</h1>

                            <p class="latex big_font">
                                \[0-0=0\\
                                0-1=1\text{ borrow 1}\\
                                1-0=1\\
                                1-1=0\]
                            </p>

                            <img class="image" src="../../images/posts/binary-subtraction.jpeg" alt="BINARY SUBTRACTION">
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Binary multiplication</h1>

                            <p class="latex big_font">
                                \[0\times0=0\\
                                0\times1=0\\
                                1\times0=0\\
                                1\times1=1\]
                            </p>

                            <img class="image" src="../../images/posts/binary-multiplication.jpeg" alt="BINARY MULTIPLICATION">
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Binary division</h1>

                            <p class="article">
                                Example 1:
                            </p>

                            <img class="image" src="../../images/posts/binary-division-1.jpeg" alt="BINARY DIVISION">
                            
                            <p class="article">
                                Example 2:
                            </p>

                            <img class="image" src="../../images/posts/binary-division-2.jpeg" alt="BINARY DIVISION">
                            
                            <p class="article">
                                Example 3:
                            </p>

                            <img class="image" src="../../images/posts/binary-division-3.jpeg" alt="BINARY DIVISION">

                            <br>

                            <p class="article">
                                <a class="link" href="https://en.wikipedia.org/wiki/Binary_number#Binary_arithmetic">Binary arithmetic article</a>.
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