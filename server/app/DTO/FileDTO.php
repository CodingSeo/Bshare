<?php

namespace App\DTO;

class FileDTO
{
    public $filename;
    public $filepath;
    public $size;
    public $extension;

    /**
     * Get the value of filename
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set the value of filename
     *
     * @return  self
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get the value of size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set the value of size
     *
     * @return  self
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the value of extension
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set the value of extension
     *
     * @return  self
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get the value of filepath
     */
    public function getFilepath()
    {
        return $this->filepath;
    }

    /**
     * Set the value of filepath
     *
     * @return  self
     */
    public function setFilepath($filepath)
    {
        $this->filepath = $filepath;

        return $this;
    }
}
