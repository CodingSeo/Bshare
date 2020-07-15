<?php

namespace App\DTO;

class ContentDTO
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $body;
    /**
     * @var ImageDTO[]
     */
    public $images;
    /**
     * Get the value of body
     *
     * @return  string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set the value of body
     *
     * @param  string  $body
     *
     * @return  self
     */
    public function setBody(string $body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of images
     *
     * @return  ImageDTO[]
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set the value of images
     *
     * @param  ImageDTO[]  $images
     *
     * @return  self
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }
}
