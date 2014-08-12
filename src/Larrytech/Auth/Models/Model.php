<?php namespace Larrytech\Auth\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class Model extends Eloquent {

    /**
     * @var \Illuminate\Support\MessageBag
     */
    protected $errors;

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);

        $this->errors = new MessageBag();
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function($model)
        {
            return $model->validate();
        });
    }

    /*
     * Returns the array of constraints.
     *
     * @return array
     */
    public function getConstraints()
    {
        return array();
    }

    /**
     * Gets the created at timestamp.
     *
     * @return \Carbon\Carbon
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Gets the validation errors.
     * 
     * @return \Illuminate\Support\MessageBag
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Gets the id of the model.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the updated at timestamp.
     *
     * @return \Carbon\Carbon
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Gets the validator for the model.
     *
     * @return \Illuminate\Validation\Validator
     */
    public function getValidator()
    {
        return Validator::make($this->toArray(), $this->getConstraints());
    }
    
    /**
     * Sets the validation errors.
     * 
     * @return \Illuminate\Support\MessageBag
     */
    protected function setErrors(MessageBag $errors)
    {
        $this->errors = $errors;
    }

    /**
     * Validates the attributes on the model.
     *
     * @return bool
     */
    public function validate()
    {
        $v = Validator::make($this->toArray(), $this->getConstraints());

        if ($v->passes())
        {
            return true;
        }

        $this->setErrors($v->messages());
        return false;
    }
}