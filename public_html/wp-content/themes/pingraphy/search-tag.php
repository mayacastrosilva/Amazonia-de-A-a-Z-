<?php /* Template Name: Tags Results  */ ?>
<?php

use Eva\Pagination\PaginationService;
use Eva\Pagination\BasicApi;
use Eva\Pagination\PaginationAdvanceApi;
use Eva\Pagination\PaginationAmazonia;


get_header();

//$path = get_tag_api();
//tag_slug,page_var,page_number

global $w;
$vars = $wp->query_vars;
$paginationHtml = "";

if(isset($vars['tag_slug']))
{
    $slug = $vars['tag_slug'];
    $page = (isset($vars['page'])) ? $vars['page'] : 1;
    $totalPerPage = 1;
    $query = "/posts?post_tags_slug={$slug}&limit={$totalPerPage}";

    if(isset($_GET['pag']))
    {
        $page = filter_var($_GET['pag'], FILTER_VALIDATE_INT);
        $query .= ($page > 1) ? "&page={$page}" : "?page=1";
    }

    $results = get_post_search_api($query);

    $path = get_path_request()[0];
    $slug = $vars['tag_slug'];
    $urlDaPagina = "/{$path}/{$slug}/";

    $paginationHtml = (new PaginationService(new PaginationAmazonia()))->buildPagination([
        'results' => $results,
        'page' => $page,
        'urlDaPagina' => $urlDaPagina,
        'totalPerPage' => $totalPerPage,
        'separator' => '?'
    ]);


} else {

    status_header(404);
    include( get_query_template('404'));

}

?>

<style>
    #pagination a {padding: 2px 10px 2px 10px;margin-right: 5px;}
    #pagination a:hover {background: #ccc;}
    #pagination a.atual {background: aquamarine;}
</style>
<div class="wrap">
    <header class="page-header" style="float: none;">
        Search for: <b><?=$term?></b><br />
        <span><?php echo ($results) ? "Encontramos {$results->totalFiltered} resultados" : "Não foram encontrados resultados..." ?></span>
    </header><!-- .page-header -->
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php if($results): ?>
                <div id="results">
                    <?php foreach ($results->data as $post) { ?>
                        <p><a href="<?=$post->post_permalink?>"><?=$post->_id?> - <?=$post->post_title?></a></p>
                    <?php } ?>
                </div>
                <div id="paginacao">
                    <?=$paginationHtml?>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <?php //get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer(); ?>



