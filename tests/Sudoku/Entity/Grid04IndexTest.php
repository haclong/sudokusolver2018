<?php

namespace Tests\Sudoku\Entity;

use PHPUnit_Framework_TestCase;
use Sudoku\Domain\Entity\Grid04Index;

/**
 * Description of Grid04IndexTest
 *
 * @author haclong
 */
class Grid04IndexTest extends PHPUnit_Framework_TestCase {
    public function testSetCorrectIndex()
    {
        $index = new Grid04Index(2, 4) ;
        $this->assertEquals(2, $index->get()) ;
    }
    
    /**
     * @expectedException Sudoku\Domain\Exception\InvalidGridIndexException
     */
    public function testIncorrectIndexThrowsException()
    {
//        $this->expectException(InvalidGridIndexException::class);
        new Grid04Index(4, 4) ;
    }
    
    /**
     * @expectedException Sudoku\Domain\Exception\GridIndexAndGridSizeNotMatchException
     */
    public function testGridSizeAndGridIndexNotMatchException()
    {
//        $this->expectException(InvalidGridIndexException::class);
        new Grid04Index(4, 2) ;
    }
}
