<?php

namespace Tests\Sudoku\Entity;

use PHPUnit_Framework_TestCase;
use Sudoku\Domain\Entity\Grid09Index;

/**
 * Description of Grid09IndexTest
 *
 * @author haclong
 */
class Grid09IndexTest extends PHPUnit_Framework_TestCase {
    public function testSetCorrectIndex()
    {
        $index = new Grid09Index(2) ;
        $this->assertEquals(2, $index->get()) ;
    }
    
    /**
     * @expectedException Sudoku\Domain\Exception\InvalidGridIndexException
     */
    public function testIncorrectIndexThrowsException()
    {
//        $this->expectException(InvalidGridIndexException::class);
        new Grid09Index(9) ;
    }
}
