<?php

namespace TilmannTMS\WeclappLaravelApi\Filters;

class WeclappFilterBuilder
{
    /**
     * The filter array.
     *
     * @var array
     */
    protected array $filters = [];

    /**
     * Add a filter condition.
     *
     * @param string $field
     * @param string $operator
     * @param mixed $value
     * @return $this
     */
    public function where(string $field, string $operator, $value = null): self
    {
        $filter = $field . '-' . $operator;

        // Handle special cases like null or notnull where value is ignored
        if (!in_array($operator, ['null', 'notnull'])) {
            $filter .= '=' . (is_array($value) ? json_encode($value) : $value);
        }

        $this->filters[] = $filter;

        return $this;
    }

    /**
     * Build the query string.
     *
     * @return string
     */
    public function toQuery(): string
    {
        return implode('&', $this->filters);
    }

    /**
     * Reset the filters.
     *
     * @return $this
     */
    public function reset(): self
    {
        $this->filters = [];
        return $this;
    }
}