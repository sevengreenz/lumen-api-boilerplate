<?php

namespace App\Domain;

class Sample implements EntityInterface
{
    protected $id;

    /** @var string $title*/
    public $title;

    /** @var bool $isDone */
    public $isDone;

    /** @var Datetime $createdAt */
    public $createdAt;

    /**
     * constructor
     */
    public function __construct(
        string $id,
        string $title,
        bool $isDone,
        \Datetime $createdAt
    ) {
        $this->id        = $id;
        $this->title     = $title;
        $this->isDone    = $isDone;
        $this->createdAt = $createdAt;
    }

    public function getIdentifier()
    {
        return $this->id;
    }
}
