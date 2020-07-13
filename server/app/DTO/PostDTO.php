<?php

namespace App\DTO;

class PostDTO
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $user_id;
    /**
     * @var CategoryDTO
     */
    public $category;
    /**
     * @var string
     */
    public $title;
    /**
     * @var ContentDTO
     */
    public $content;
    /**
     * @var CommentDTO[]
     */
    public $comments;
    /**
     * @var int
     */
    public $view_count;
    /**
     * @var int
     */
    public $active;
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
     * Get the value of user_id
     *
     * @return  string
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @param  string  $user_id
     *
     * @return  self
     */
    public function setUser_id(string $user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of category
     *
     * @return  CategoryDTO
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @param  CategoryDTO  $category
     *
     * @return  self
     */
    public function setCategory(CategoryDTO $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of title
     *
     * @return  string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     *
     * @return  self
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of content
     *
     * @return  ContentDTO
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param  ContentDTO  $content
     *
     * @return  self
     */
    public function setContent(ContentDTO $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of comments
     *
     * @return  CommentDTO[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set the value of comments
     *
     * @param  CommentDTO[]  $comments
     *
     * @return  self
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get the value of view_count
     *
     * @return  int
     */
    public function getView_count()
    {
        return $this->view_count;
    }

    /**
     * Set the value of view_count
     *
     * @param  int  $view_count
     *
     * @return  self
     */
    public function setView_count(int $view_count)
    {
        $this->view_count = $view_count;

        return $this;
    }

    /**
     * Get the value of active
     *
     * @return  int
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of active
     *
     * @param  int  $active
     *
     * @return  self
     */
    public function setActive(int $active)
    {
        $this->active = $active;

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
