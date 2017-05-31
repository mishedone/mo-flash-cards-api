<?php

namespace Tools;

use Phalcon\Mvc\MongoCollection;

/**
 * Behaves like Doctrine's entity manager. A really good thing about it
 * is that you can modify a set of models in various services, persist them
 * in the model manager and flush / save them all in the end.
 */
class ModelManager
{
    /**
     * Holds managed models.
     *
     * @var array
     */
    protected $models = [];
    
    /**
     * Adds a model to the pool of managed models.
     *
     * @param MongoCollection $model
     */
    public function persist(MongoCollection $model)
    {
        $this->models[] = $model;
    }
    
    /**
     * Saves all persisted models.
     */
    public function flush()
    {
        foreach ($this->models as $model) {
            $model->save();
        }
        $this->models = [];
    }
}