<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class JobType extends Entity
{
    /**
    * Define properties that are automatically converted to Time instances.
    */
    protected $dates = [ 'created_at', 'updated_at', 'deleted_at'];

    /**
    * Array of field names and the type of value to cast them as
    * when they are accessed.
    */
    protected $casts = [
        'status' => 'boolean',
    ];

    public function link() 
    {
        return route_to('jobtypes_show', $this->id);
    }

    public function pdf_link() 
    {
        return route_to('jobtypes_htmlToPDF', $this->id);
    }

    /**
     * Activate installation.
     *
     * @return $this
     */
    public function activate()
    {
        $this->attributes['status'] = 1;
        return $this;
    }

    /**
     * Deactivate installation.
     *
     * @return $this
     */
    public function deactivate()
    {
        $this->attributes['status'] = 0;
        return $this;
    }
}