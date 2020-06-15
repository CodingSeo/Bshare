<?php

namespace App\Models;

class Post
{
    protected $id;
    protected $email;
    protected $category_id;
    protected $title;
    protected $view_count;

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
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of view_count
     */
    public function getView_count()
    {
        return $this->view_count;
    }

    /**
     * Set the value of view_count
     *
     * @return  self
     */
    public function setView_count($view_count)
    {
        $this->view_count = $view_count;

        return $this;
    }
}
