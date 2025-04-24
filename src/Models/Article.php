<?php

namespace TilmannTMS\Weclapp\Models;

class Article
{
    protected $attributes;

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * Get all articles
     */
    public static function all(array $params = [])
    {
        $response = app('weclapp')->get('/article', $params);
        return array_map(function ($article) {
            return new static($article);
        }, $response['result'] ?? []);
    }

    /**
     * Find an article by ID
     */
    public static function find(string $id)
    {
        $response = app('weclapp')->get("/article/{$id}");
        return new static($response);
    }

    /**
     * Create a new article
     */
    public static function create(array $data)
    {
        $response = app('weclapp')->post('/article', $data);
        return new static($response);
    }

    /**
     * Get an attribute
     */
    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }
}