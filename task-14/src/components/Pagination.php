<?php

class Pagination
{
    public string $page_cur;
    public string $page_prev;
    public string $page_next;

    public function __construct(int $page, mixed $objects)
    {
        $this->page_cur = $page;
        $this->page_prev = $page > 1 ? $page - 1 : 1;
        $this->page_next = sizeof($objects) === 10 ? $page + 1 : $page;
    }

    public function isStart(): string
    {
        return $this->page_cur === $this->page_prev ? 'disabled' : '';
    }

    public function isEnd(): string
    {
        return $this->page_cur === $this->page_next ? 'disabled' : '';
    }
}