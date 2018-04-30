<?php

namespace Sudoku\Domain\Entity;

use Sudoku\Domain\Exception\InvalidGridIndexException;

/**
 * Description of Grid4Index
 *
 * @author haclong
 */
class Grid04Index {
    protected $index ;
    
    public function __construct($index)
    {
        if($index > 3)
        {
            throw new InvalidGridIndexException () ;
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
