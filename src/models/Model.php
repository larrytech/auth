<?php namespace Larrytech\Auth\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent {

    /**
     * Gets the primary key of the model.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the created at timestamp.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Gets the updated at timestamp.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}