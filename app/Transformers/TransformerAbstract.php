<?php

namespace App\Transformers;

abstract class TransformerAbstract
{
    /**
     * Transform a collection of items
     * @param  collection
     * @return array
     */
    public function transformCollection($items)
    {
        return array_map(array($this, 'transform'), $items->toArray());
    }

    /**
     * Transform a array of items
     * @param  array
     * @return array
     */

    public function transformArray($items)
    {
        return array_map(array($this, 'transform'), $items);
    }

    /**
     * Transform an item
     * @param  array
     * @return type
     */
    abstract public function transform($item);
}
