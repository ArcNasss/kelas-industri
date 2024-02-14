<?php

namespace App\Repositories;

use App\Models\News;
use App\Repositories\NewsRepository;

class NewsRepository extends BaseRepository
{
    public function __construct(News $model)
    {
        $this->model = $model;
    }

    /**
     * override get paginate
     *
     * @param int $limit
     * @param array|null $order
     * @return mixed
     */
    public function get_paginate(int $limit, array $order = null): mixed
    {
        return $this->model->query()
            ->latest()
            ->paginate($limit);
    }

    public function get_by_slug(string $slug): mixed
    {
        return $this->model->query()
            ->where('slug', $slug)
            ->first();
    }

}
