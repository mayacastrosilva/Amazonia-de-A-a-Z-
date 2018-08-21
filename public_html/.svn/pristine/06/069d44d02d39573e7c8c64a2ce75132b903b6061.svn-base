<?php /* Template Name: Letra */ ?>
<?php
use Eva\Pagination\PaginationService;
use Eva\Pagination\BasicApi;
use Eva\Pagination\PaginationAmazonia;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <?php get_head();?>
</head>
<body>
<?php get_header(); ?>
<?php
$results = false;
$paginationHtml = '';

global $w;
$vars = $wp->query_vars;
$letraSelecionada = '';

if(isset($vars['letra']))
{
    //Total de itens por pagina
    $letraSelecionada = strtoupper($vars['letra']);
    $totalPerPage = 8;
    $siteId = WP_SITE_ID;
    $query = "/sumauma/posts?post_buscaletra={$letraSelecionada}&limit={$totalPerPage}&post_status=publish,private&site_blog_id={$siteId}";
    $page = 1;

    //echo $query;
    if(isset($_GET['pag']))
    {
        $page = filter_var($_GET['pag'], FILTER_VALIDATE_INT);
        $query .= ($page > 1) ? "&page={$page}" : "&page=1";
    }

    //Realiza a busca na Hyperion.
    $results = get_post_search_api($query);

    //Url da pagina
    $urlDaPagina = "/letra/" . strtolower($letraSelecionada) . '/';

    //Gera a paginacao dos resultados.
    $paginationHtml = (new PaginationService(new PaginationAmazonia()))->buildPagination([
        'results' => $results,
        'page' => $page,
        'urlDaPagina' => $urlDaPagina,
        'totalPerPage' => $totalPerPage,
        'separator' => '?'
    ]);

    $mensagemResultado = ($results) ? "<h1>Resultado de busca para: <b class=\"page-title\">{$letraSelecionada}</b></h1><p>{$results->totalFiltered} resultado(s) encontrado(s)</p>" : "<h1>Nenhum resultado encontrado para: <b class=\"page-title\">{$letraSelecionada}</b></h1>";

} else {
    get_404();
}


?>
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
                $cartegoria = ($post->categories) ? "<a href=\"/{$post->categories[0]->slug}\"><span class=\"label label-success\">{$post->categories[0]->name}</span>" : "";
                ?>
        <div class="col-sm-6 col-md-3">
                    <div class="thumbnail just searsh-list">
                        <?php if($post->post_thumbnail): ?>
                            <img src="<?=$post->post_thumbnail?>" alt="...">
                        <?php endif; ?>
                        <div class="txt">
                            <h3><?=$cartegoria?></h3>
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

