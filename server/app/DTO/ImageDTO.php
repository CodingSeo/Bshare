<?php

namespace App\DTO;

class ImageDTO
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var int
     */
    public $content_id;
    /**
     * @var string
     */
    public $filename;
    /**
     * @var string
     */
    public $bytes;
    /**
     * @var int
     */
    public $mime;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $updated_at;

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
     * Get the value of content_id
     *
     * @return  int
     */
    public function getContent_id()
    {
        return $this->content_id;
    }

    /**
     * Set the value of content_id
     *
     * @param  int  $content_id
     *
     * @return  self
     */
    public function setContent_id(int $content_id)
    {
        $this->content_id = $content_id;

        return $this;
    }


}
