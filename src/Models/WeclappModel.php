<?php

namespace TilmannTMS\Weclapp\Models;

use TilmannTMS\WeclappLaravelApi\Filters\WeclappFilterBuilder;

abstract class WeclappModel
{
    protected $attributes = [];
    protected static $endpoint;

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }

    /**
     * Get all records with optional filters.
     */
    public static function all(array $params = [])
    {
        $response = app('weclapp')->get(static::$endpoint, $params);
        return array_map(function ($item) {
            return new static($item);
        }, $response['result'] ?? []);
    }

    /**
     * Find a record by ID.
     */
    public static function find(string $id)
    {
        $response = app('weclapp')->get(static::$endpoint . "/{$id}");
        return new static($response);
    }

    /**
     * Create a new record.
     */
    public static function create(array $data)
    {
        $response = app('weclapp')->post(static::$endpoint, $data);
        return new static($response);
    }

    /**
     * Get an attribute.
     */
    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    /**
     * Use the WeclappFilterBuilder for advanced queries.
     */
    public static function filter(): WeclappFilterBuilder
    {
        return new WeclappFilterBuilder();
    }
}
