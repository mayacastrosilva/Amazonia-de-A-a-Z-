<?php /* Template Name: Tags */ ?>
<?php
use Eva\Pagination\PaginationService;
use Eva\Pagination\BasicApi;
use Eva\Pagination\PaginationAdvanceApi;
use Eva\Pagination\PaginationAmazonia;

global $w;
$vars = $wp->query_vars;
$paginationHtml = "";

if(isset($vars['tag_slug']))
{
    $slug = $vars['tag_slug'];
    $page = (isset($vars['page'])) ? $vars['page'] : 1;
    $totalPerPage = 1;
    $query = "/sumauma/posts?post_tags_slug={$slug}&limit={$totalPerPage}";

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

    $mensagemResultado = ($results) ? "<h1>Resultado de busca para tag: <b class=\"page-title\">{$slug}</b></h1><p>{$results->totalFiltered} resultado(s) encontrado(s)</p>" : "<h1>Nenhum resultado encontrado para a tag: <b class=\"page-title\">{$slug}</b></h1>";


} else {
    get_404();
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
