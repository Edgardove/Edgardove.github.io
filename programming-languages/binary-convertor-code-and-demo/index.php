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
        let start_time=1573059741;
    </script>
    <script src="../../js/post/index.js"></script>
    <title>BInary Convertor Code and Demo  | <?php echo APP_NAME; ?></title>
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
                            <h1>Decimal to binary function</h1>

                            <p class="article">
                                A demo of this code, can be found <a class="link" href="../../tools/binary-convertor">here</a>.
                            </p>

                            <br>

                            <pre><code class="js">
function decimal_to_binary(n){
    let int=isNaN(parseInt(n.split('.')[0])) ? 0 : parseInt(n.split('.')[0]), 
        frac=isNaN(parseFloat(n.split('.')[1])) ? 0 : parseFloat('0.' + n.split('.')[1]),
        sign='', output='';

    if(int&lt;0 || 1/int===-Infinity) sign='-';

    int=Math.abs(int);   
    
    if(int==0 && frac==0){
        return '0';
    }

    if(int>0){
        while(int!=1){
            output+=''+int%2;
            int=Math.floor(int/2);
        }

        output+='1';

        output=reverse(output);
    }
    else output='0';

    if(frac>0){
        output+='.';

        for(i=0;i&lt;23;i++){
            frac=frac*2;
            if(frac&lt;1) output+='0';

            else if(frac>1){
                n=frac.toString();
                frac=parseFloat('0.' + n.split('.')[1]);
                output+='1';
            }
        }
    }

    return sign+output;
}
                            </code></pre>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Binary to decimal function</h1>

                            <pre><code class="js">
function binary_to_decimal(n){
    let int=isNaN(parseInt(n.split('.')[0])) ? 0 : parseInt(n.split('.')[0]), 
        frac=isNaN(parseFloat(n.split('.')[1])) ? 0 : parseFloat('0.' + n.split('.')[1]),
        sign=1, output=0;

    if(int&lt;0) sign=-1;

    int=(''+int).replace(/[-]/g,'');

    frac=(''+parseFloat('0.' + n.split('.')[1])).replace(/0./,'');

    let c=int.length-1;

    for(i=0;i&lt;int.length;i++){
        output+=parseInt(int[i])*Math.pow(2,c);
        c--;
    }

    for(i=0;i&lt;frac.length;i++){
        output+=parseInt(frac[i])*Math.pow(2,-(i+1));
    }

    return output*sign; 
}

function reverse(s){
    return s.split("").reverse().join("");
}
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