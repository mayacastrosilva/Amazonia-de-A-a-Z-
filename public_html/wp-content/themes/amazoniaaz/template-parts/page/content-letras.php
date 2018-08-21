<?php
$mensagemSearch = "Selecione sua letra ... ";
$mensagemResultado = "";
$letrasHtml = "";

$pathSegment = explode('/', getenv('REQUEST_URI'));
$vars = array_values(array_filter($pathSegment));
$letraSelecionada = '';

if(isset($vars[1]))
{
    $letraSelecionada = strtoupper($vars[1]);
    $mensagemSearch = "Buscando por letra: <b>{$letraSelecionada}</b>";
}

$letras = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
foreach ($letras as $letra)
{
    $letraMinuscula = strtolower($letra);
    $letra = ($letraSelecionada == $letra) ? "<span style=\"color:#5cb85c;\">{$letra}</span>" : $letra;
    $letrasHtml .= "<a href=\"/letra/{$letraMinuscula}\">{$letra}</a>";
}
?>
<style>
    #pagination a {padding: 2px 10px 2px 10px;margin-right: 5px;}
    #pagination a:hover {background: #ccc;}
    #pagination a.atual {background: aquamarine;}
</style>

<div class="section-two">
    <div class="wrap">
        <header class="page-header">
            Pesquise por Ordem Alfabética
        </header><!-- .page-header -->

        <div id="primary" class="content-area cont">
            <main id="main" class="site-main letras" role="main">
                <section id="search-2" class="widget widget_search letras-search" style="clear: both;">
                    <?=$letrasHtml?>
                </section>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->
</div>





