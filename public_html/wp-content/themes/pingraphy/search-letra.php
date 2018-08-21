<?php /* Template Name: Letra */ ?>
<?php
use Eva\Pagination\PaginationService;
use Eva\Pagination\BasicApi;
use Eva\Pagination\PaginationAmazonia;

get_header();

$mensagemSearch = "Selecione sua letra ... ";
$mensagemResultado = "";

global $w;
$vars = $wp->query_vars;
$letraSelecionada = '';
if(isset($vars['letra']))
{
    $letraSelecionada = strtoupper($vars['letra']);
    $mensagemSearch = "Buscando por letra: <b>{$letraSelecionada}</b>";
}

$letras = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
$letrasHtml = "";
foreach ($letras as $letra)
{
    $letraMinuscula = strtolower($letra);
    $letra = ($letraSelecionada == $letra) ? "<strong>{$letra}</strong>" : $letra;
    $letrasHtml .= "<a href=\"/letra/{$letraMinuscula}\">{$letra}</a>" . "   ";
}

if(!empty($letraSelecionada))
{
    //Total de itens por pagina
    $totalPerPage = 2;
    $siteId = WP_SITE_ID;
    $query = "/posts?post_buscaletra={$letraSelecionada}&limit={$totalPerPage}&post_status=publish,private&site_blog_id={$siteId}";
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

}

?>
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
                <section id="search-2" class="widget widget_search" style="clear: both;">
                    <?=$letrasHtml?>
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
<?php get_footer();?>
