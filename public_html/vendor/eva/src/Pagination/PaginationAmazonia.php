<?php
/**
 * Created by PhpStorm.
 * User: Charles
 * Date: 14/12/2017
 * Time: 13:26
 */

namespace Eva\Pagination;


class PaginationAmazonia implements PaginationInterface
{

    public function buildPagination($args)
    {
        // TODO: Implement buildPagination() method.
        $results = $args['results'];
        $total = $results->totalFiltered;
        $paginationHtml = "";
        if($total > 0)
        {
            $paginationHtml = "<ul class=\"pagination\">";
            $totalPerPage = $args['totalPerPage'];
            $page = $args['page'];
            $this_page = $args['urlDaPagina'];
            $ultima_pag = ceil($total / $totalPerPage);
            $c = $args['separator'];
            //$c = substr($this_page, -1);

            $tmp = [];
            for($p=1, $i=0; $i < $total; $p++, $i += $totalPerPage)
            {
                if($page == $p) {
                    // current page shown as bold, no link
                    //$tmp[] = "<li class=\"current\"><a href=\"\">{$p}</a></li>";
                    $tmp[] = "<li><a class=\"active\" href=\"#\">{$p}</a></li>";
                } else {
                    $tmp[] = "<li><a href=\"{$this_page}{$c}pag={$p}\">{$p}</a></li>";
                }
            }

            // thin out the links (optional)
            for($i = count($tmp) - 3; $i > 1; $i--)
            {
                if(abs($page - $i - 1) > 2) {
                    unset($tmp[$i]);
                }
            }

            if(count($tmp) > 1)
            {
                //echo "<p>";
                if($page > 1) {
                    // display 'Prev' link
                    $paginationHtml .= "<li><a href=\"{$this_page}\"><<</a></li>";
                    $paginationHtml .= "<li><a href=\"{$this_page}{$c}pag=" . ($page - 1) . "\"><</a></li>";
                } else {
                    //$paginationHtml .= "<li class=\"nolink\">P&aacuteginas<li>";
                    //$paginationHtml .= "<li><a href=\"{$this_page}\">&laquo; Prev</a></li>";
                }

                $lastlink = 0;
                foreach($tmp as $i => $link)
                {
                    if($i > $lastlink + 1) {
                        $paginationHtml .= "<li><a href=\"{$this_page}\"> ... </a></li>"; //" ... "; // where one or more links have been omitted
                    } elseif($i) {
                        $paginationHtml .= "";
                    }
                    $paginationHtml .= $link;
                    $lastlink = $i;
                }

                if($page <= $lastlink) {
                    // display 'Next' link
                    $paginationHtml .= "<li><a href=\"{$this_page}{$c}pag=" . ($page + 1) . "\">></a></li>";
                    $paginationHtml .= "<li><a href=\"{$this_page}{$c}pag={$ultima_pag}\">>></a></li>";
                }

            }
            $paginationHtml .= "</ul>";
        }

        return $paginationHtml;

    }

}