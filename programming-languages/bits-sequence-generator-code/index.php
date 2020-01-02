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
        let start_time=1573060217;
    </script>
    <script src="../../js/post/index.js"></script>
    <title>Bits Sequence Generator Code | <?php echo APP_NAME; ?></title>
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
                            <h1>Bits sequence generator</h1>

                            <p class="article">
                                A demo of this code can be found <a class="link" href="../../tools/bits-sequence">here</a>.
                            </p>

                            <br>

                            <p class="article">
                                This is a function to normalize a binary number:
                            </p>

                            <br>

                            <pre><code class="js">
function normalize(n){
    let sign=n[0]=='-' ? '1' : '0', num=n.replace(/[-]/,''),
        point_pos=num.search(/[.]/)==-1 ? num.length : num.search(/[.]/),
        pos=parseFloat(num)&lt;1 ? 0 : -1;

    if(num.length==0 || parseFloat(num)==0){
        return {n:'0.0', exp:0, sign: sign}
    }

    for(i=0;i&lt;num.length;i++){
        if(num[i]==1){
            pos=i-pos;

            break;
        }
    }

    num=num.replace(/[.]/,'');

    let output = ''+[num.slice(0, pos), '.', num.slice(pos)].join('');

    if(output=='1.') output=output+'0';

    return {n: output, exp: point_pos - pos, sign: sign}
}
                            </code></pre>

                            <p class="article">
                                With this output, we can generate the 3 parts of the bits sequence: sign, exponent, significand.
                                Given an input:
                            </p>

                            <br>

                            <pre><code class="js">
input.on('input', function(){
    let allowed=this.value.replace(/[^0-9\-\.]/,'');
    
    $(this).val(allowed);

    let prec_significand=27, prec_exp=7;

    if($('#type').val()=='64'){
        prec_significand=56;
        prec_exp=10;
    }
    
    let binary_number=decimal_to_binary($(this).val(),prec_significand),
        unsigned_exponent=127+parseInt(normalize(binary_number).exp)+'';
        
    let significand=normalize(binary_number).n,
        exponent=decimal_to_binary(unsigned_exponent, 9), sign=normalize(binary_number).sign;

    significand=significand.replace(/0+1\D/,'1.');
    
    for(i=significand.length-1;i&lt;prec_significand-3;i++){
        significand+='0';
    }

    significand=significand.substring(0,prec_significand-2);

    for(i=exponent.length-1;i&lt;prec_exp;i++){
        exponent='0'+exponent;
    }


    bits_sequence.text(sign + ' ' + exponent + ' ' + significand);

    bfpn.html(normalize(binary_number).n.replace(/0+1\D/,'1.') + 'x2&lt;sup>' + normalize(binary_number).exp + '&lt;/sup>');
});
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