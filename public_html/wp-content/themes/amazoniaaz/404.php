<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <?php get_head();?>
</head>
<body>
<?php get_header(); ?>
<div class="container all ">
    <div class="row">

<div class="site-content-contain">
	<div id="content" class="site-content">
		<div class="wrap">
			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">

					<section class="error-404 not-found">
						<header class="page-header">
							<h1 class="page-title"><?php _e( 'Oops! Página não encontrada.', 'amazoniaaz' ); ?></h1>
						</header><!-- .page-header -->
						<div class="page-content">
							<p><?php _e( 'Parece que nada foi encontrado neste local. Talvez tente uma pesquisa ... ', 'amazoniaaz' ); ?></p>
						</div><!-- .page-content -->
					</section><!-- .error-404 -->
				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- .wrap -->
	</div>
</div>
    </div>
</div>
<?php get_footer(); ?>
</body>
</html>
