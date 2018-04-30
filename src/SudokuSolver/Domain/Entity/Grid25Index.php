<?php

namespace Sudoku\Domain\Entity;

use Sudoku\Domain\Exception\InvalidGridIndexException;

/**
 * Description of Grid25Index
 *
 * @author haclong
 */
class Grid25Index {
    protected $index ;
    
    public function __construct($index)
    {
        if($index > 24)
        {
            throw new InvalidGridIndexException() ;
        }
        $this->index = $index ;
    }
    
    public function __toString()
    {
        return $this->get() ;
    }
    
    public function get()
    {
        return $this->index ;
    }
}
