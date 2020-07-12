<?php

namespace App\DTO;

class CategoryDTO
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $category;
    /**
     * @var int
     */
    public $writable;
    /**
     * @var int
     */
    public $use_trade;
    /**
     * @var int
     */
    public $use_book;

    /**
     * Get the value of id
     *
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  int  $id
     *
     * @return  self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of category
     *
     * @return  string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @param  string  $category
     *
     * @return  self
     */
    public function setCategory(string $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of writable
     *
     * @return  int
     */
    public function getWritable()
    {
        return $this->writable;
    }

    /**
     * Set the value of writable
     *
     * @param  int  $writable
     *
     * @return  self
     */
    public function setWritable(int $writable)
    {
        $this->writable = $writable;

        return $this;
    }

    /**
     * Get the value of use_trade
     *
     * @return  int
     */
    public function getUse_trade()
    {
        return $this->use_trade;
    }

    /**
     * Set the value of use_trade
     *
     * @param  int  $use_trade
     *
     * @return  self
     */
    public function setUse_trade(int $use_trade)
    {
        $this->use_trade = $use_trade;

        return $this;
    }

    /**
     * Get the value of use_book
     *
     * @return  int
     */
    public function getUse_book()
    {
        return $this->use_book;
    }

    /**
     * Set the value of use_book
     *
     * @param  int  $use_book
     *
     * @return  self
     */
    public function setUse_book(int $use_book)
    {
        $this->use_book = $use_book;

        return $this;
    }
}
