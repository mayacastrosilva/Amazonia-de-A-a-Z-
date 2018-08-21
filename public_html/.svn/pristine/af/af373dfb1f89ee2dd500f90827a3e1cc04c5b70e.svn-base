<?php /* Template Name: Search */ ?>
<?php

use Eva\Pagination\PaginationService;
use Eva\Pagination\BasicApi;
use Eva\Pagination\PaginationAmazonia;

$results = false;
$paginationHtml = "";
$urlDaPagina = "/search/?term={$term}";

if(isset($_GET['term']) && $_GET['term'] != '')
{
    $totalPerPage = 8;
    $siteId = WP_SITE_ID;
    $term = $_GET['term'];
    $search = utf8_decode($term);
    $query = "/sumauma/posts?search={$search}&limit={$totalPerPage}&post_status=publish,private&site_blog_id={$siteId}";
    $page = 1;

    if(isset($_GET['pag']))
    {
        $page = filter_var($_GET['pag'], FILTER_VALIDATE_INT);
        $query .= ($page > 1) ? "&page={$page}" : "&page=1";
    }

    //echo $query;
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
        $mensagemResultado = ($results) ? "<h1>Resultado de busca para: <b class=\"page-title\">{$term}</b></h1><p>{$results->totalFiltered} resultado(s) encontrado(s)</p>" : "<h1>Nenhum resultado encontrado para: <b class=\"page-title\">{$term}</b></h1>";
        //$mensagemSearch = "Buscando por: <b>{$term}</b><br />";
    }
}

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <?php get_head();?>
</head>
<body>
<?php get_header(); ?>
<div class="container all ">
        <header class="page-header">
            <?=$mensagemResultado?>
        </header>

    <div class="row">
        <?php
        if($results) {
            foreach ($results->data as $post) {
                $tagsHtml = "";
                $num_words = rand(15, 45);
                if($post->post_tags)
                {
                    foreach ($post->post_tags as $tag) {
                        $tagsHtml .= "<a href=\"/tags/{$tag->slug}\"><span class=\"label label-success\">{$tag->name}</span>";
                    }
                }
                $categoriesHtml = ($post->categories) ? "<a href=\"/{$post->categories[0]->slug}\"><span class=\"label label-success\">{$post->categories[0]->name}</span>" : "";
                ?>
        <div class="col-sm-6 col-md-3">
                    <div class="thumbnail just searsh-list">
                        <?php if($post->post_thumbnail): ?>
                            <img src="<?=$post->post_thumbnail?>" alt="...">
                        <?php endif; ?>
                        <div class="txt">
                            <h3><?=$categoriesHtml?></h3>
                            <div class="caption">
                                <h3><a href="<?=$post->post_permalink?>"><?=$post->post_title?></a></h3>
                                <span>publicado em</span> <span><?=date('d/m/Y H:i:s',strtotime($post->post_modified))?></span>
                                <p><br><a href="<?=$post->post_permalink?>"><?=wp_trim_words($post->post_content, $num_words, $more = null);?></a></p>
                                <p class="bd"><a href="#" class="btn " role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> <a href="#" class="btn btn-comment" role="button"> <i class="fa fa-comment" aria-hidden="true">1</i> </a> </p>

                            </div>
                        </div>
                    </div>
        </div>
                <?php
            }
        }
        ?>

    </div>
    <div class="center" style="clear: both;">
        <?=$paginationHtml?>
    </div>
</div>
<?php get_footer(); ?>
</body>
</html>

