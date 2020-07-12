<?php

namespace App\DTO;

class CommentDTO
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
     * @var string
     */
    public $body;
    /**
     * @var RepliesDTO[]
     */
    public $replies;
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
     * Get the value of replies
     *
     * @return  RepliesDTO[]
     */
    public function getReplies()
    {
        return $this->replies;
    }

    /**
     * Set the value of replies
     *
     * @param  RepliesDTO[]  $replies
     *
     * @return  self
     */
    public function setReplies($replies)
    {
        $this->replies = $replies;

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
