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
    <meta name="description"content="Floating point numbers (FPN) can be studied as a scientific notation, in the sense that the main idea is to try to represent real numbers, in a more structured way. Giving certain data like numberal system, precision and significand length.">
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
        let start_time=1572957568;
    </script>
    <script src="../../js/post/index.js"></script>
    <title>Floating point numbers | <?php echo APP_NAME; ?></title>
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
                                Floating point numbers (FPN) can be studied as a scientific notation, in the sense that the main
                                idea is to try to represent real numbers, in a more structured way. Giving certain data like
                                numeral system, precision and significand length.
                            </p>

                            <br>

                            <p class="article">
                                Because Decimal Floating Point Numbers (DFPN) is very similar to scientific notation, our attention
                                will be on Binary Floating Point Numbers (BFPN), since, in addition, this is how computers use them.
                            </p>
                        </section>

                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Parts of a FPN</h1>

                            <p class="article">
                                It's recommended to know a couple things about binary numbers. The slides about it are
                                <a class='link' href="../binary-numbers">here</a>.
                            </p>

                            <br>

                            <p class="article">
                                A FPN consists of 4 parts: sign, significand, base, exponent:
                            </p>

                            <img class="image" src="../../images/posts/fpn-parts.jpeg" alt="FLOATING POINT NUMBER PARTS">

                            <p class="article">
                                The significand is a positive integer, the base is a fixed 2 (because this is the radix of binary numbers),
                                sometimes omited, and the exponent is either a positive or negative integer.
                            </p>

                            <p class="latex">
                                \[-1011\times2^{-3}=-0.001011_2=-\frac{1}{104}\]
                            </p>

                            <p class="article">
                                We can see that \(-1011\times2^{-3}\) is a Binary Floating Point representation of the real number \(-\frac{1}{104}\).
                            </p>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>How computers read a real number</h1>

                            <p class="article">
                                A computer reads a real number as a binary bits sequence using BFPN. A bit (binary digit) is the smallest
                                datum in a computer, and can be 0 or 1.
                            </p>

                            <br>

                            <p class="article">
                                A bit sequence is composed by 3 parts: <span style="color: #0071ce;">sign</span>,
                                <span style="color: #3f8b00;">exponent</span>, <span style="color: #d44300;">significand</span>:
                            </p>

                            <p class="latex">
                                \[\color{#0071ce}{1}\quad\color{#3f8b00}{01111100}\quad\color{#d44300}{01100000000000000000000}\]
                            </p>

                            <p class="article">
                                The example above is the 32 bits sequence of the number \(-\frac{1}{104}\) and this are the steps to make it:
                            </p>

                            <br>

                            <p class="article">
                                - Convert the number to binary, the result is going to be \(-0.001011\).
                            </p>

                            <br>

                            <p class="article">
                                - The first digit of the binary number always has to be 1 and most contain 23 digits. This is called normalization: 
                            </p>

                            <br>

                            <p class="latex">
                                \[-0.001011=-1.011=-1.0110000000000000000000\]
                            </p>

                            <br>

                            <p class="article">
                                The first digit 1 is omited to obtain 23 digits: \(0110000000000000000000\). And as you can see, we "fill" with zeros if
                                necessary to complete 23 digits. This is the <span style="color: #d44300;">significand</span>.
                            </p>

                            <br>

                            <p class="article">
                                - To convert \(-0.001011\) to \(1.011\) we had to move the point to the right so many times until reach the first one,
                                that is, the point was displaced 3 times. This is because: \(-0.001011=1011\times2^{-3}\). This exponent -3 is added
                                to 127. 127 is called the exponent bias in 32 bits FPN. So 127 + (-3) = 125. then, 125 is the "unsigned" exponent stored.
                                But must be in binary and contain 8 digits:
                            </p>

                            <br>

                            <p class="latex">
                                \[125_{10}=1111100_2=01111100\]
                            </p>

                            <br>

                            <p class="article">
                                And this is the <span style="color: #3f8b00;">exponent</span>.
                            </p>

                            <br>

                            <p class="article">
                                - If the number is positive, the sign bit is 0, if is negative, the bit sign is 1. \(-\frac{1}{104}\) is negative, then
                                the bit sign is 1. This is the <span style="color: #0071ce;">sign</span>.
                            </p>

                            <br><br>

                            <p class="article">
                                Then the bits sequence of \(-\frac{1}{104}\) is: 1011111000110000000000000000000.
                            </p>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>32 and 64 bits</h1>

                            <p class="article">
                                In the previous slide, we got the 32 bits sequence for the number \(-\frac{1}{104}\). To obtain
                                the 64 bits sequence we have to make exactly the same. But with these changes:
                            </p>

                            <table>
                                <tr>
                                    <th>Type</th>
                                    <th>Sign</th>
                                    <th>Exponent</th>
                                    <th>Significand</th>
                                    <th>Exponent bias</th>
                                </tr>

                                <tr>
                                    <td>32 bits</td>
                                    <td>1</td>
                                    <td>8</td>
                                    <td>23</td>
                                    <td>127</td>
                                </tr>

                                <tr>
                                    <td>64 bits</td>
                                    <td>1</td>
                                    <td>11</td>
                                    <td>52</td>
                                    <td>1023</td>
                                </tr>
                            </table>

                            <p class="article">
                                The exponent occupies 11 bits, instead of 8. The significand 52 bits, instead of 23.
                                The exponent bias is 1023, and the sign bit occupies the same 1 bit.
                            </p>

                            <p class="latex">
                                \[\color{#0071ce}{1}\quad\color{#3f8b00}{00001111100}\quad\color{#d44300}{0110000000000000000000000000000000000000000000000000}\]
                            </p>

                            <p class="article">
                                You can find a better explanation <a class="link" href="https://en.wikipedia.org/wiki/Floating-point_arithmetic">here</a>.
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