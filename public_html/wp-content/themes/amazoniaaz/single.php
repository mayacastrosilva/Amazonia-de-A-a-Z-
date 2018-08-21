<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <?php
    $post_api = get_post_single_api($post->_id);
    $description = wp_trim_words($post->post_content, 40, '' );
    ?>
    <!-- START - Facebook Open Graph, Google+ and Twitter Card Tags 2.1.5 -->
    <!-- Facebook Open Graph -->
    <meta property="og:locale" content="pt_BR"/>
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
    <meta property="og:title" content="<?=$post_api->post_title?>"/>
    <meta property="og:url" content="<?=WP_SITE_URL . $post_api->post_permalink?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:description" content="<?=$description;?>"/>
    <meta property="og:image" content="<?=WP_SITE_URL . $post_api->post_thumbnail?>"/>
    <meta property="article:publisher" content="https://www.facebook.com/AmazonSat/"/>
    <meta property="fb:app_id" content="1733241490277042"/>
    <!-- Google+ / Schema.org -->
    <meta itemprop="name" content="<?=$post_api->post_title?>"/>
    <meta itemprop="description" content="<?=$description?>"/>
    <meta itemprop="image" content="<?=WP_SITE_URL . $post_api->post_thumbnail?>"/>
    <!-- Twitter Cards -->
    <meta name="twitter:title" content="<?=$post_api->post_title?>"/>
    <meta name="twitter:url" content="<?=WP_SITE_URL . $post_api->post_permalink?>"/>
    <meta name="twitter:description" content="<?=$description?>"/>
    <meta name="twitter:image" content="<?=WP_SITE_URL . $post_api->post_thumbnail?>"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <!-- SEO -->
    <link rel="canonical" href="<?=WP_SITE_URL . $post_api->post_permalink?>"/>
    <meta name="description" content="<?=$description?>"/>
    <!-- Misc. tags -->
    <!-- END - Facebook Open Graph, Google+ and Twitter Card Tags 2.1.5 -->
    <?php get_head();?>
</head>
<body>
<?php
get_header(); ?>
<div class="container all ">
    <div class="row">
            <div class="col-12 col-md-8">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main2" role="main">
                        <?php
                        while (have_posts()) : the_post();
                            get_template_part( 'template-parts/page/content-single', 'single' );
                        endwhile;
                        ?>
                        <!--SUPER BANNER DA INTERNA DO PORTAL-->
                        <div data-glade data-ad-unit-path="/1018255/portalamz-zn8" height="90" width="728" class="super-banner-secundario"></div>


                    </main><!-- .site-main -->
                    <?php get_template_part( 'template-parts/page/content-related'); ?>
                </div>
            </div>
            <div class="col-6 col-md-4">

            <!--SQUARE PORTAL AMAZÔNIA-->
            <div data-glade data-ad-unit-path="/1018255/portalamz-zn3" class="square" height="250" width="300"></div>

            </div>


    </div><!-- .content-area -->
</div>
</div>
<?php get_footer(); ?>
</body>
</html>