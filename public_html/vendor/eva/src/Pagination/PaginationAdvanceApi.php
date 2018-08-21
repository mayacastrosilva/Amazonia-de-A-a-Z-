<?php
/**
 * Created by PhpStorm.
 * User: Charles
 * Date: 14/12/2017
 * Time: 11:08
 */

namespace Eva\Pagination;


class PaginationAdvanceApi implements PaginationInterface
{

    public function buildPagination($args)
    {
        // TODO: Implement buildPagination() method. /search/?term={$term}
        $results = $args['results'];
        $total = $results->totalFiltered;
        $paginationHtml = "";
        if($total > 0)
        {
            $page = $args['page'];
            $totalPerPage = $args['totalPerPage'];

            $urlDaPagina = $args['urlDaPagina'];
            $paginationHtml .= "<div id=\"pagination\">";

            $prox = $page + 1;
            $ant = $page - 1;
            $ultima_pag = ceil($total / $totalPerPage);
            $penultima = $ultima_pag - 1;
            $adjacentes = 2;

            $paginationHtml .= "<a href=\"{$urlDaPagina}\"><< in&iacute;cio</a>";

            if ($page > 1)
                $paginationHtml .= "<a href=\"{$urlDaPagina}&pag={$ant}\">< anterior</a>";
            else
                $paginationHtml .= "<a href=\"{$urlDaPagina}\">< anterior</a>";

            if ($ultima_pag <= 5)
            {
                for ($i=1; $i< $ultima_pag+1; $i++)
                {
                    if ($i == $page)
                    {
                        $paginationHtml .= "<a class=\"atual\" href=\"{$urlDaPagina}&pag={$i}\">{$i}</a>";
                    } else {
                        $paginationHtml .= "<a href=\"{$urlDaPagina}&pag={$i}\">{$i}</a>";
                    }
                }
            }

            if ($ultima_pag > 5)
            {
                if ($page < 1 + (2 * $adjacentes))
                {
                    for ($i=1; $i< 2 + (2 * $adjacentes); $i++)
                    {
                        if ($i == $page)
                        {
                            $paginationHtml .= "<a class=\"atual\" href=\"{$urlDaPagina}&pag={$i}\">{$i}</a>";
                        } else {
                            $paginationHtml .= "<a href=\"{$urlDaPagina}&pag={$i}\">{$i}</a>";
                        }
                    }
                    $paginationHtml .= '&nbsp;...&nbsp;&nbsp;';
                    $paginationHtml .= "<a href=\"{$urlDaPagina}&pag={$penultima}\">{$penultima}</a>";
                    $paginationHtml .= "<a href=\"{$urlDaPagina}&pag={$ultima_pag}\">{$ultima_pag}</a>";
                }
                elseif($page > (2 * $adjacentes) && $page < $ultima_pag - 3)
                {
                    $paginationHtml .= "<a href=\"{$urlDaPagina}&pag=1\">1</a>";
                    $paginationHtml .= "<a href=\"{$urlDaPagina}?pag=1\">2</a>&nbsp;...&nbsp;";
                    for ($i = $page - $adjacentes; $i<= $page + $adjacentes; $i++)
                    {
                        if ($i == $page)
                        {
                            $paginationHtml .= "<a class=\"atual\" href=\"{$urlDaPagina}&pag={$i}\">{$i}</a>";
                        } else {
                            $paginationHtml .= "<a href=\"{$urlDaPagina}&pag={$i}\">{$i}</a>";
                        }
                    }
                    $paginationHtml .= '...';
                    $paginationHtml .= "<a href=\"{$urlDaPagina}&pag={$penultima}\">{$penultima}</a>";
                    $paginationHtml .= "<a href=\"{$urlDaPagina}&pag={$ultima_pag}\">{$ultima_pag}</a>";
                }
                else {
                    $paginationHtml .= "<a href=\"{$urlDaPagina}&pag=1\">1</a>";
                    $paginationHtml .= "<a href=\"{$urlDaPagina}&pag=2\">2</a>&nbsp;...&nbsp;";
                    for ($i = $ultima_pag - (4 + (2 * $adjacentes)); $i <= $ultima_pag; $i++)
                    {
                        if ($i == $page)
                        {
                            $paginationHtml .= "<a class=\"atual\" href=\"{$urlDaPagina}&pag={$i}\">{$i}</a>";
                        } elseif($i > 2 ) {
                            $paginationHtml .= "<a href=\"{$urlDaPagina}&pag={$i}\">{$i}</a>";
                        }
                    }
                }
            }

            if ($prox <= $ultima_pag && $ultima_pag > 2)
                $paginationHtml .= "<a href=\"{$urlDaPagina}&pag={$prox}\">pr&oacute;ximo ></a>";

            $paginationHtml .= "<a href=\"{$urlDaPagina}&pag={$ultima_pag}\">último >></a>";

            $paginationHtml .= "</div>";

        }

        return $paginationHtml;

    }
}