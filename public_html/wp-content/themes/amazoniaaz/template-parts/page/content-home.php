<article>
<!--    <section class="square">-->
<!--        <div class="thumbnail just ">-->
<!--            <!-- SQUARE PORTAL AMAZÔNIA-->
<!--            <div data-glade data-ad-unit-path="/1018255/portalamz-zn3" height="250" width="300"></div>-->
<!--        </div>-->
<!-- -->
<!--    </section>-->
    <?php

    $args=array(
        'orderby' => 'rand',
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 8,
        'caller_get_posts'=> 1
    );
    $az_query = null;
    $az_query = new WP_Query($args);
    if($az_query->have_posts())
    {
        $pathTemplate = get_template_directory_uri();
        $min = 15;
        $max = 45;
        while ($az_query->have_posts()) : $az_query->the_post();
            $num_words = rand($min, $max);
            ?>


            <section>
                <div class="thumbnail just">
                    <?=the_post_thumbnail();?>
                    <div class="txt">
                        <h3><a href="/<?=get_the_category()[0]->slug?>"><span class="label label-success"><?=get_the_category()[0]->name?></span></a></h3>
                        <div class="caption">
                            <h3><a href="<?=the_permalink();?>"><?=the_title();?></a></h3>
                            <span>posted on</span> <span>11 de dezembro de 2017</span>
                            <p><br><a href="<?=the_permalink();?>"><?=wp_trim_words(get_the_content(), $num_words, $more = null);?></a></p>
                            <p class="bd"><a href="<?=the_permalink();?>" class="btn " role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <a href="#" class="btn btn-comment" role="button"> <i class="fa fa-comment" aria-hidden="true">1</i> </a> </p>

                        </div>
                    </div>
                </div>
            </section>

            <?php
        endwhile;
        wp_reset_query();
    }
    ?>
</article>