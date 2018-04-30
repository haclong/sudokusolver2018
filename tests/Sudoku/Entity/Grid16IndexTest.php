<?php

namespace Tests\Sudoku\Entity;

use PHPUnit_Framework_TestCase;
use Sudoku\Domain\Entity\Grid16Index;

/**
 * Description of Grid16IndexTest
 *
 * @author haclong
 */
class Grid16IndexTest extends PHPUnit_Framework_TestCase {
    public function testSetCorrectIndex()
    {
        $index = new Grid16Index(2) ;
        $this->assertEquals(2, $index->get()) ;
    }
    
    /**
     * @expectedException Sudoku\Domain\Exception\InvalidGridIndexException
     */
    public function testIncorrectIndexThrowsException()
    {
//        $this->expectException(InvalidGridIndexException::class);
        new Grid16Index(16) ;
    }
}
