<?php
libxml_use_internal_errors(true);

$pathTemplate = get_template_directory_uri();
if ($xml = @simplexml_load_file(URL_RSS)):
    if ($xml):
        ?>


        <div class="container-fluid all2">
            <div class="row">
                <!--SUPER BANNER SECUNDARIO-->
                <div data-glade data-ad-unit-path="/1018255/portalamz-zn4" height="90" width="728" class="super-banner-secundario"></div>
            </div>


            <div class="row">
                <div class="portal ">
                    <div class="tudo2">
                        <div class="top-header">
                            <div class="site-branding3">
                                <a href="http://portalamazonia.com/" target="_blank">
                                    <img src="<?= $pathTemplate ?>/img/logo1.png">
                                </a>
                            </div>
                            <div class="cat">
                                <div class="traco"></div>
                                <p class="categoria">News</p>
                            </div>
                        </div>

                        <section class="responsive slider half-page">
<!--                            <div class="thumbnail just jus ">-->
<!--                                <!-- HALF PAGE INTERNA-->
<!--                                <div data-glade data-ad-unit-path="/1018255/portalamz-zn7" height="600" width="300"></div>-->
<!--                            </div>-->
                            <?php foreach ($xml->channel->item as $item): ?>

                                <div class="thumbnail just jus">
                                    <?php if($item->thumbnail): ?>
                                        <img src="<?=$item->thumbnail?>" alt="...">
                                    <?php endif;?>
                                    <div class="txt">
                                        <h3><a href="<?= $item->link ?>"><span
                                                    class="label label-success"><?= $item->category ?></span></a></h3>
                                        <div class="caption">
                                            <h3  class="titulo"><a href="<?= $item->link ?>"><?= $item->title ?></a></h3>
                                            <span>atualizado em </span>
                                            <span><?= date('d/m/Y H:i:s', strtotime($item->pubDate)) ?></span>
                                            <p><br><a href="<?= $item->link ?>"><?= $item->description ?></a></p>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </section>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- MEGA BANNER-->

                <div data-glade data-ad-unit-path="/1018255/portalamz-zn2" height="90" width="970" class="mega-banner"></div>


            </div>
        </div>
        <!--slick slider-->
        <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
        <script src="<?= $pathTemplate ?>/slick/slick.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">
    $(document).on('ready', function() {
        $('.responsive').slick({
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 3,
            slidesToScroll: 3,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });
</script>
<?php
    endif;
endif;
?>
