<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Pingraphy
 */


$term = (isset($_GET['term']) && $_GET['term'] != '') ? $_GET['term'] : "";


?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700" rel="stylesheet">



<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'pingraphy' ); ?></a>

	<header id="" class="" role="banner">
		<div class="fix">
            <div class="tudo">
                <div class="site-branding2">
                    <a href="http://portalamazonia.com/" target="_blank">
                        <img src="<?=get_template_directory_uri(); ?>/images/logo1.png" >
                    </a>
                </div>
                <div class="prod">
                    <p>Produzido por</p>
                </div>
			<div class="section-one1">
				<div class="">
					<?php if( has_nav_menu('primary'))  : ?>
					<a class="toggle-mobile-menu" href="#" title="Menu"><i class="fa fa-bars"></i></a>
					<nav id="primary-navigation" class="main-navigation" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => 'menu clearfix' ) ); ?>
					</nav><!-- #site-navigation -->
					<?php endif; ?>
					<div class="site-branding">
						<?php pingraphy_header_title() ?>
					</div><!-- .site-branding -->

					<div class="search-style-one" id="searchform">
						<a id="trigger-overlay">
<!--							<i class="fa fa-search"></i>-->
                            Bem vindo à sua Enciclopédia Online da Amazônia!
						</a>
						<div class="overlay overlay-slideleft">
							<div class="search-row">
								<form method="get" id="searchform" class="search-form" action="/search" _lpchecked="1">
									<a ahref="#" class="overlay-close"><i class="fa fa-times"></i></a>
									<input type="text" name="term" id="s" value="<?=$term?>" placeholder="<?php esc_html_e('O que você quer saber sobre a Amazônia?', 'pingraphy'); ?>" />
                                    <button>Pesquisar</button>
								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="section-two">
				<?php if( has_nav_menu('secondary'))  : ?>
				<div class="inner clearfix">

					<a class="mobile-only toggle-mobile-menu" href="#" title="Menu"><?php _e('Main Navigation', 'pingraphy'); ?> <i class="fa fa-angle-down"></i></a>
					<nav id="secondary-navigation" class="second-navigation" role="navigation">
						<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'menu_id' => 'secondary-menu', 'menu_class' => 'menu clearfix' ) ); ?>
					</nav><!-- #site-navigation -->

				</div>
				<?php endif; ?>
			</div>

                <?php
                use Eva\Pagination\PaginationService;
                use Eva\Pagination\BasicApi;
                use Eva\Pagination\PaginationAmazonia;



                $mensagemSearch = "Pesquise por Ordem Alfabética";
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

                <div class="wrap">
                    <header class="page-header">
                        <?=$mensagemSearch?>
                        <span><?=$mensagemResultado?></span>
                    </header><!-- .page-header -->

                    <div id="primary" class="content-area cont">
                        <main id="main" class="site-main letras" role="main">
                            <section id="search-2" class="widget widget_search letras-search" style="clear: both;">
                                <?=$letrasHtml?>
                            </section>

                        </main><!-- #main -->
                    </div><!-- #primary -->
                    <?php //get_sidebar(); ?>
                </div><!-- .wrap -->



            </div>
		</div>
		<div id="catcher"></div>
	</header><!-- #masthead -->
	<?php 
		
		$class = ' sidebar-right';

		// for page condition
		if (is_page()) {
			if ( is_page_template( 'sidebar-left.php' )) {
				$class = ' sidebar-left';
			} else if ( is_page_template( 'full-width.php' )) {
				$class = ' full-width';
			} else {
				$class = ' sidebar-right';
			}
		}
	?>

	<div id="content" class="site-content<?php echo $class; ?>">
		<div class="inner ">