<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <?php get_head();?>
</head>
<body>
    <?php get_header(); ?>
    <div class="container all ">
        <div class="row">
            <?php get_template_part('template-parts/page/content-home',get_post_format()); ?>
        </div>
    </div>
    <!--slick slider-->
    <?php get_template_part('template-parts/page/content-news-portal',get_post_format()); ?>
    <?php get_footer(); ?>
</body>

</html>



