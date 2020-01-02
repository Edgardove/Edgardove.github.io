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
        let start_time=1574709338;
    </script>
    <script src="../../js/post/index.js"></script>
    <title>Clustering: KMeans | <?php echo APP_NAME; ?></title>
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
                                <em>K-Means</em> is about dividing a dataset into <em>k</em> groups, and each data
                                belongs to the group with the nearest mean or center.
                            </p>

                            <br>

                            <p class="article">
                                For example the following data is given, and we set <em>k</em>=5 (five clusters or groups): 
                            </p>

                            <br>

                            <img src="../../images/posts/kmeans-non-means.png" alt="DATASET" class="image">

                            <br>

                            <img src="../../images/posts/kmeans-means.png" alt="CLUSTER MARKS" class="image">
                            
                            <br>

                            <img src="../../images/posts/kmeans-clustering.gif" alt="CLUSTERING ANIMATION" class="image">
                        
                            <br>

                            <p class="article">
                                When the data is divided into <em>k</em> parts, we have clustered the dataset.
                            </p>

                            <br>

                            <img src="../../images/posts/kmeans-clustering.png" alt="DATASET CLUSTERING" class="image">
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Standard algorithm</h1>

                            <h2>Random partition</h2>

                            <ul>
                                <li>Set \(k\): number of clusters</li>
                                <li>Let \(\boldsymbol{X}\) be the dataset</li>
                                <li>Let \(\boldsymbol{S}_i=\emptyset\text{, for i=1,...,}k\)</li>
                                <li>Let \(r\) be a random variable following the discrete uniform distribution over the set \(\{1,...,k\}\)</li>
                                <li>\(\boldsymbol{S}_r=\boldsymbol{S}_r\cup\{\boldsymbol{x}\},\quad \forall \boldsymbol{x} \in \boldsymbol{X}\)</li>
                            </ul>

                            <h2>Assignment and update</h2>

                            <ol>
                                <li>
                                    <p class="latex">
                                        \[\boldsymbol{m}_i^{(t+1)}=\frac{1}{|\boldsymbol{S}_i^{(t)}|}\displaystyle\sum_{\boldsymbol{x} \in \boldsymbol{S}^{(t)}} \boldsymbol{x}, \text{ for } i=1,...,k\]
                                    </p>
                                </li>
                                <li>
                                    <p class="latex">
                                        \[\boldsymbol{S}_i^{(t)}=\{\boldsymbol{x}:\|\boldsymbol{x}-\boldsymbol{m}_i\|^2 \le \|\boldsymbol{x}-\boldsymbol{m}_j\|^2 \quad \forall j, 1 \le j \le k\}\]
                                    </p>
                                </li>
                                <li>
                                    <p class="latex">
                                        \[\text{if }\exists \boldsymbol{x} \neq \boldsymbol{z}, \quad \forall \boldsymbol{x} \in \boldsymbol{S}_i^{(t)} \land \forall \boldsymbol{z} \in \boldsymbol{S}_i^{(t+1)}:\quad \text{repeat 1 and 2}\]
                                    </p>
                                </li>
                            </ol>

                            <br>

                            <p class="article">
                                When the step three holds, \(\boldsymbol{S}_i\) are the set of clusters and \(\boldsymbol{m}_i\) are the means.
                            </p>
                        </section>
                    </section>

                    <section class="slide">
                        <section class="content">
                            <h1>Algorithm in python using numpy</h1>

                            <br>

                            <pre><code class="python">
def random_partition(data, k):
	clusters=[[] for i in range(k)]
	means=[]

	for i in data:
		clusters[random.randint(0,k-1)].append(i)

	for cluster in clusters:
		means.append(numpy.array(cluster, dtype=numpy.dtype('Float64')).mean(axis=0))

	return numpy.array(means, dtype=numpy.dtype('Float64'))

def kmeans(data, means, k):
	iteration=1

	while True:
		old_centroids=means

		clusters=[[] for i in range(k)]

		for i in range(k):
			for datum in data:
				counter=0

				for mean in means:
					if math.pow(linalg.norm(datum-means[i]),2) <= math.pow(linalg.norm(datum - mean),2):
						counter+=1

					if(counter==k):
						clusters[i].append(datum)

		means=[]

		for cluster in clusters:
			means.append(numpy.array(cluster, dtype=numpy.dtype('Float64')).mean(axis=0))

		means=numpy.array(means, dtype=numpy.dtype('Float64'))

		new_centroids=means

		if(numpy.array_equal(old_centroids, new_centroids)):
			print("non change after " + str(iteration) + " iterations")

			break

		iteration+=1

	return {
		"clusters": clusters,
		"means": means
	}

initial_means=random_partition(data, k)

output=kmeans(data, initial_means, k)
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