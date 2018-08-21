<?php
/**
 * Created by PhpStorm.
 * User: Charles
 * Date: 11/12/2017
 * Time: 13:21
 */

namespace Eva\Pagination;


class PaginationService implements PaginationInterface
{

    protected $service;

    public function __construct(PaginationInterface $pagination)
    {
        $this->service = $pagination;
    }


    public function buildPagination($results)
    {
        // TODO: Implement buildPagination() method.
        return $this->service->buildPagination($results);
    }
}