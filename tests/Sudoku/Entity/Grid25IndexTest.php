<?php

namespace Tests\Sudoku\Entity;

use PHPUnit_Framework_TestCase;
use Sudoku\Domain\Entity\Grid25Index;

/**
 * Description of Grid25IndexTest
 *
 * @author haclong
 */
class Grid25IndexTest extends PHPUnit_Framework_TestCase {
    public function testSetCorrectIndex()
    {
        $index = new Grid25Index(2, 25) ;
        $this->assertEquals(2, $index->get()) ;
    }
    
    /**
     * @expectedException Sudoku\Domain\Exception\InvalidGridIndexException
     */
    public function testIncorrectIndexThrowsException()
    {
//        $this->expectException(InvalidGridIndexException::class);
        new Grid25Index(25, 25) ;
    }
    
    /**
     * @expectedException Sudoku\Domain\Exception\GridIndexAndGridSizeNotMatchException
     */
    public function testGridSizeAndGridIndexNotMatchException()
    {
//        $this->expectException(InvalidGridIndexException::class);
        new Grid25Index(25, 24) ;
    }
}
