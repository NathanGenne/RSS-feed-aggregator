<?php

class Topic {

    /** Nom du centre d'intérêt
     * @var string
     */
    private $name;

    /** Get le nom du centre d'intérêt
     * @return string
     */
    public function getName(): string
    {
       return $this->name;
    }
    
    /** Get le nom du centre d'intérêt
     * @return string
     */
    public function setName(): string
    {
       return $this->name;
    }

    public function __construct(object $topics) {
        
    }
}

?>