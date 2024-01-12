<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class NewComment
{
    use SerializesModels;

    public $commment;

    /**
     * Create a new event instance.
     */
    public function __construct($commment)
    {
        $this->commment = $commment;
    }
}
