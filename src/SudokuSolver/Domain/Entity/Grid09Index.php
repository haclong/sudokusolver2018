<?php

namespace Sudoku\Domain\Entity;

use Sudoku\Domain\Exception\InvalidGridIndexException;

/**
 * Description of Grid9Index
 *
 * @author haclong
 */
class Grid09Index {
    protected $index ;
    
    public function __construct($index)
    {
        if($index > 8)
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
