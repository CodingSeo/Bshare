<?php

namespace App\DTO;

class FileDTO
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
    public $file_name;
    /**
     * @var string
     */
    public $file_path;
    /**
     * @var int
     */
    public $file_size;
    /**
     * @var string
     */
    public $file_type;
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

    /**
     * Get the value of file_name
     *
     * @return  string
     */
    public function getFile_name()
    {
        return $this->file_name;
    }

    /**
     * Set the value of file_name
     *
     * @param  string  $file_name
     *
     * @return  self
     */
    public function setFile_name(string $file_name)
    {
        $this->file_name = $file_name;

        return $this;
    }

    /**
     * Get the value of file_path
     *
     * @return  string
     */
    public function getFile_path()
    {
        return $this->file_path;
    }

    /**
     * Set the value of file_path
     *
     * @param  string  $file_path
     *
     * @return  self
     */
    public function setFile_path(string $file_path)
    {
        $this->file_path = $file_path;

        return $this;
    }

    /**
     * Get the value of file_size
     *
     * @return  int
     */
    public function getFile_size()
    {
        return $this->file_size;
    }

    /**
     * Set the value of file_size
     *
     * @param  int  $file_size
     *
     * @return  self
     */
    public function setFile_size(int $file_size)
    {
        $this->file_size = $file_size;

        return $this;
    }

    /**
     * Get the value of file_type
     *
     * @return  string
     */
    public function getFile_type()
    {
        return $this->file_type;
    }

    /**
     * Set the value of file_type
     *
     * @param  string  $file_type
     *
     * @return  self
     */
    public function setFile_type(string $file_type)
    {
        $this->file_type = $file_type;

        return $this;
    }

    /**
     * Get the value of created_at
     *
     * @return  string
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @param  string  $created_at
     *
     * @return  self
     */
    public function setCreated_at(string $created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     *
     * @return  string
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     *
     * @param  string  $updated_at
     *
     * @return  self
     */
    public function setUpdated_at(string $updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
