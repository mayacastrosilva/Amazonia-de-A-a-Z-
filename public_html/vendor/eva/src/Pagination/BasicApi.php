<?php

/**
 * Created by PhpStorm.
 * User: Charles
 * Date: 11/12/2017
 * Time: 13:17
 */

namespace Eva\Pagination;

class BasicApi implements PaginationInterface
{

    public function buildPagination($args)
    {
        // TODO: Implement buildPagination() method.
        $results = $args['results'];
        $page = $args['page'];
        $urlDaPagina = $args['urlDaPagina'];
        $totalPerPage = $args['totalPerPage'];
        $paginationHtml = "";
        if(isset($results->totalResults))
        {
            if($results->prev)
            {
                $pagPrev = $page - 1;
                $paginationHtml .= "<a href=\"{$urlDaPagina}\"><< início</a>";
                $paginationHtml .= "<a href=\"{$urlDaPagina}&pag={$pagPrev}\">< anterior</a>";
            }
            if($results->next)
            {
                $numpages = ceil($results->totalFiltered/$totalPerPage);
                $pagNext = $page + 1;
                $paginationHtml .= "<a href=\"{$urlDaPagina}&pag={$pagNext}\">próximo ></a>";
                $paginationHtml .= "<a href=\"{$urlDaPagina}&pag={$numpages}\">final >></a>";
            }
        }
        return $paginationHtml;
    }
}