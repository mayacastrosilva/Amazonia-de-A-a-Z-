<?php /* Template Name: Results */ ?>
<?php

use Eva\Pagination\PaginationService;
use Eva\Pagination\BasicApi;
use Eva\Pagination\PaginationAmazonia;

$results = false;
$paginationHtml = "";
$urlDaPagina = "/search/?term={$term}";

if(isset($_GET['term']) && $_GET['term'] != '')
{
    $totalPerPage = 3;
    $siteId = WP_SITE_ID;
    $term = $_GET['term'];
    $query = "/posts?search={$term}&limit={$totalPerPage}&post_status=publish,private&site_blog_id={$siteId}";
    $page = 1;

    if(isset($_GET['pag']))
    {
        $page = filter_var($_GET['pag'], FILTER_VALIDATE_INT);
        $query .= ($page > 1) ? "&page={$page}" : "&page=1";
    }

    //Realiza a busca na Hyperion.
    $results = get_post_search_api($query);

    //Gera a paginacao dos resultados.
    $paginationHtml = (new PaginationService(new PaginationAmazonia()))->buildPagination([
        'results' => $results,
        'page' => $page,
        'urlDaPagina' => $urlDaPagina,
        'totalPerPage' => $totalPerPage,
        'separator' => '&'
    ]);

}

?>
<?php get_header();?>

<div id="primary" class="content-area content-masonry">
    <main id="main" class="site-main" role="main">
        <div id="masonry-container">
            <div class="masonry" class="clearfix">
                <?php if($results): ?>
                        <?php
                        foreach ($results->data as $post)
                        {
                            $classCategory = "";
                            if($post->categories)
                            {
                                foreach ($post->categories as $category) {
                                    $classCategory .= "category-{$category->slug} ";
                                }
                            }

                            $classTags = "";
                            if($post->post_tags)
                            {
                                foreach ($post->post_tags as $tag) {
                                    $classTags .= "tag-{$tag->slug} ";
                                }
                            }

                        ?>
                            <article id="post-<?=$post->ID?>" class="item has-post-thumbnail post-<?=$post->ID?> post type-post status-publish format-standard hentry <?=$classCategory?> <?=$classTags?>" style="position: absolute; left: 0px; top: 0px;">
                                <div class="thumbnail">
                                    <a href="<?=$post->post_permalink?>" rel="bookmark"><img width="240" height="150" src="<?=$post->post_thumbnail?>" class="attachment-pingraphy-home-thumbnail size-pingraphy-home-thumbnail wp-post-image" alt=""></a>
                                </div>
                                <div class="item-text">
                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="<?=$post->post_permalink?>" rel="bookmark"><?=$post->post_title?></a></h2>
                                        <div class="entry-meta">
                                            <span class="posted-on"> Posted on <a href="<?=$post->post_permalink?>" rel="bookmark"><time class="entry-date published" datetime="<?=$post->post_modified?>"><?=date('d/m/Y H:i:s',strtotime($post->post_modified))?></time><time class="updated" datetime="<?=$post->post_modified?>"></time></a> </span><span class="byline">By <span class="author vcard"><a class="url fn n" href="http://dev.amazoniadeaz.com.br/author/admin/">portal</a></span></span>
                                        </div>
                                        <!-- .entry-meta -->
                                    </header>
                                    <!-- .entry-header -->
                                    <div class="item-description">
                                        <div class="entry-content">
                                            <p><?=wp_trim_words($post->post_content, $num_words = 55, $more = null);?></p>
                                        </div>
                                        <!-- .entry-content -->
                                    </div>
                                </div>
                                <footer class="entry-footer clearfix">
                                    <div class="entry-meta">
                                        <div class="entry-footer-right">
                                            <span class="comments-link"><i class="fa fa-comment"></i> <a href="<?=$post->post_permalink?>">0</a></span>
                                        </div>
                                    </div>
                                </footer>
                                <!-- .entry-footer -->
                            </article>
                        <?php } ?>
                <?php endif; ?>
            </div>
        </div>

    </main><!-- #main -->
    <?=$paginationHtml?>
</div><!-- #primary -->







<?php get_footer(); ?>

