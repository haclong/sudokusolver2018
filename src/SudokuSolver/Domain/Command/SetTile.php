<?php

namespace Sudoku\Domain\Command;

/**
 * Description of SetCase
 *
 * @author haclong
 */
class SetTile implements CommandInterface {
    protected $row ;
    protected $col ;
    protected $value ;
    
    public function __construct()
    {
        
    }
}
