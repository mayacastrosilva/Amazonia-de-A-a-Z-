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

$mensagemResultado = "";
$mensagemSearch = "Digite sua busca .... ";
if(isset($_GET['term']))
{
    if(!empty($term))
    {
        $mensagemResultado = ($results) ? "Encontramos {$results->totalFiltered} resultados" : "Não foram encontrados resultados...";
        $mensagemSearch = "Buscando por: <b>{$term}</b><br />";
    }
}

?>
<?php get_header(); ?>
    <style>
        #pagination a {padding: 2px 10px 2px 10px;margin-right: 5px;}
        #pagination a:hover {background: #ccc;}
        #pagination a.atual {background: aquamarine;}
    </style>
    <div class="wrap">
        <header class="page-header">
            <?=$mensagemSearch?>
            <span><?=$mensagemResultado?></span>
        </header><!-- .page-header -->

        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <section id="search-2" class="widget widget_search">
                    <form method="get" class="search-form" action="/search">
                        <input type="search" id="search-form-5a2df50823939" class="search-field" placeholder="Search …" value="<?=$term?>" name="term">
                        <button type="submit" class="search-submit"><svg class="icon icon-search" aria-hidden="true" role="img"> <use href="#icon-search" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-search"></use> </svg><span class="screen-reader-text">Search</span></button>
                    </form>
                </section>
                <?php if($results): ?>
                    <section id="results">
                            <?php foreach ($results->data as $post) { ?>
                                <p><a href="<?=$post->post_permalink?>"><?=$post->post_title?></a></p>
                            <?php } ?>
                    </section>
                    <section id="paginacao">
                            <?=$paginationHtml?>
                    </section>
                <?php endif; ?>
            </main><!-- #main -->
        </div><!-- #primary -->
        <?php //get_sidebar(); ?>
    </div><!-- .wrap -->
<?php get_footer();
