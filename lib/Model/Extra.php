<?php

namespace Channable\Model;

class Extra
{
    /**
     * @var string
     */
    private $memo;

    /**
     * @var string
     */
    private $comment;

    public function __construct(string $memo, string $comment)
    {
        $this->memo = $memo;
        $this->comment = $comment;
    }

    /**
     * @return string
     */
    public function getMemo(): string
    {
        return $this->memo;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }
}
