<?php

namespace Sudoku\Domain\Entity;

use Sudoku\Domain\Exception\InvalidGridIndexException;

/**
 * Description of Grid16Index
 *
 * @author haclong
 */
class Grid16Index {
    protected $index ;
    
    public function __construct($index)
    {
        if($index > 15)
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
