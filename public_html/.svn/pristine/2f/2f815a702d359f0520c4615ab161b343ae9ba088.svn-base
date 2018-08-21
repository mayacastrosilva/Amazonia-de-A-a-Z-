<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

use Eva\Pagination\PaginationService;
use Eva\Pagination\BasicApi;
use Eva\Pagination\PaginationAmazonia;

get_header();

global $w;
$vars = $wp->query_vars;

if(isset($vars['category_name']))
{
	$category_name = $vars['category_name'];

	//Total de itens por pagina
	$totalPerPage = 2;
	$siteId = WP_SITE_ID;
	$query = "/posts?categories={$category_name}&limit={$totalPerPage}&post_status=publish,private&site_blog_id={$siteId}";
	$page = 1;

	//echo $query;
	if(isset($_GET['pag']))
	{
		$page = filter_var($_GET['pag'], FILTER_VALIDATE_INT);
		$query .= ($page > 1) ? "&page={$page}" : "&page=1";
	}

	$urlDaPagina = "/{$category_name}/";

	//Realiza a busca na Hyperion.
	$results = get_post_search_api($query);

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

<div class="wrap">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
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
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
