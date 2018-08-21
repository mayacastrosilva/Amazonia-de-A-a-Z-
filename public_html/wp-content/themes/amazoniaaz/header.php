<?php
$templateRoot = get_template_directory_uri();
$home = home_url();
?>
<header id="masthead" class="site-header" role="banner">
    <div class="fix">
        <div class="fix-bar"></div>
        <div class="site-branding2">
            <a href="http://portalamazonia.com/" target="_blank">
                <img src="<?=$templateRoot?>/img/logo1.png" >
            </a>
        </div>
        <div class="prod">
            <p>Produzido por</p>
        </div>
        <div class="tudo">
            <!-- SUPER BANNER HEADER-->
            <div data-glade data-ad-unit-path="/1018255/portalamz-zn1" height="90" width="728" style="margin-top: 30px; margin-bottom: 30px;" class="super-banner"></div>



            <div class="section-one1">
                <div class="inner1">
                    <div class="site-branding1">
                        <meta itemprop="logo" content="<?=$templateRoot?>/img/logo2.png">
                        <h1 class="site-title logo" itemprop="headline">
                            <a itemprop="url" href="<?=$home?>" rel="home" title="Bem vindo à sua Enciclopédia Online sobre a Amazônia">
                                <img src="/wp-content/themes/amazoniaaz/img/marca-2.png" alt="Bem vindo à sua Enciclopédia Online sobre a Amazônia">
                            </a>
                        </h1>

                    </div>
<!--                     .site-branding-->


                    <div class="search-style-one">

                        <div class="overlay overlay-slideleft">
                            <h1 class="site-title s-title logo" itemprop="headline">
                                <a itemprop="url" href="<?=$home?>" rel="home" title="Bem vindo à sua Enciclopédia Online sobre a Amazônia">
                                    Bem vindo à sua Enciclopédia Online da Amazônia!
                                </a>
                            </h1>

                            <div class="search-row">
                                <form method="get" id="searchform" class="search-form" action="/search" _lpchecked="1">

                                    <input type="text" name="term" id="s" value="<?=(isset($_GET['term']) && $_GET['term'] != '') ? $_GET['term'] : ''?>" placeholder="O que você quer saber sobre a Amazônia?">
                                    <button>Pesquisar</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>



            <?php get_template_part('template-parts/page/content-letras', get_post_format()); //template letras ?>

        </div>
    </div>
    <div id="catcher"></div>
</header>