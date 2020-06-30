<?php
namespace App\DTO;

class EloquentPaginateDTO
{
    /**
     * @var string
     */
    public $first_page_url;
    /**
     * @var int
     */
    public $from;
    /**
     * @var int
     */
    public $current_page;
    /**
     * @var int
     */
    public $last_page;
    /**
     * @var string
     */
    public $last_page_url;
    /**
     * @var string
     */
    public $next_page_url;
    /**
     * @var string
     */
    public $path;
    /**
     * @var int
     */
    public $per_page;
    /**
     * @var string
     */
    public $prev_page_url;
    /**
     * @var int
     */
    public $to;
    /**
     * @var int
     */
    public $total;
}
