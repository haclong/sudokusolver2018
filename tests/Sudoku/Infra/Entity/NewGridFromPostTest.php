<?php

namespace Tests\Sudoku\Infra\Entity;

use PHPUnit_Framework_TestCase;
use Sudoku\Infra\Entity\NewGridFromPost;

/**
 * Description of NewGridFromPostTest
 *
 * @author haclong
 */
class NewGridFromPostTest extends PHPUnit_Framework_TestCase {
    protected function mockArray($size)
    {
        $t = [] ;
        for($i=0; $i<$size; $i++)
        {
            $t[$i] = [] ;
            for($j=0; $j<$size; $j++)
            {
                $t[$i][$j] = '' ;
            }
        }
        return $t ;
    }
    /**
     * @expectedException Sudoku\Infra\Exception\ArrayExpected
     */
    public function testArrayExpected()
    {
        new NewGridFromPost(['t' => '', 'size' => 9, 'level' => 'easy']) ;
    }

    /**
     * @expectedException Sudoku\Infra\Exception\ArrayKeyNotFound
     */
    public function testArrayKeyLevelExpected()
    {
        new NewGridFromPost(['size' => 9, 't' => []]) ;
    }

    /**
     * @expectedException Sudoku\Infra\Exception\ArrayKeyNotFound
     */
    public function testArrayKeyTExpected()
    {
        new NewGridFromPost(['size' => 9, 'level' => 'easy']) ;
    }

    /**
     * @expectedException Sudoku\Infra\Exception\ArrayKeyNotFound
     */
    public function testArrayKeySizeExpected()
    {
        new NewGridFromPost(['t' => [], 'level' => 'easy']) ;
    }

    /**
     * @expectedException Sudoku\Infra\Exception\IntExpected
     */
    public function testIntExpected()
    {
        new NewGridFromPost(['t' => [], 'size' => 'A', 'level' => 'easy']) ;
    }

    /**
     * @expectedException Sudoku\Infra\Exception\WrongGridSize
     */
    public function testWrongGridSizeExpected()
    {
        $t4 = $this->mockArray(4) ;
        $t9 = $this->mockArray(9) ;
        $t16 = $this->mockArray(16) ;
        $t25 = $this->mockArray(25) ;
        $t5 = $this->mockArray(5) ;
        
        new NewGridFromPost(['t' => $t4, 'size' => 4, 'level' => 'easy']) ;
        new NewGridFromPost(['t' => $t9, 'size' => 9, 'level' => 'easy']) ;
        new NewGridFromPost(['t' => $t16, 'size' => 16, 'level' => 'easy']) ;
        new NewGridFromPost(['t' => $t25, 'size' => 25, 'level' => 'easy']) ;
        new NewGridFromPost(['t' => $t5, 'size' => 5, 'level' => 'easy']) ;
    }

    /**
     * @expectedException Sudoku\Infra\Exception\ArraySizeNotMatching
     */
    public function testArraySizeNotMatchingExpected()
    {
        new NewGridFromPost(['t' => [], 'size' => 4, 'level' => 'easy']) ;
    }

    /**
     * @expectedException Sudoku\Infra\Exception\ArraySizeNotMatching
     */
    public function testInnerArraySizeNotMatchingExpected()
    {
        new NewGridFromPost(['t' => [0 => ['', '', '', ''], 1 => [], 2 => [], 3 => []], 'size' => 4, 'level' => 'easy']) ;
    }

    /**
     * @expectedException Sudoku\Infra\Exception\InvalidFigureCount
     */
    public function testInvalidFigureCountExpected()
    {
        $array = [
            't' => [
                0 => ['', '', 2, 3],
                1 => [1, '', 4, ''],
                2 => [1, '', 5, ''],
                3 => ['', 2, '', 5]
            ],
            'size' => 4,
            'level' => 'easy'
        ] ;
        new NewGridFromPost($array) ;
    }

    public function testNewGridFilterEasyLevelValueIsOk()
    {
        $array = [
            't' => [
                0 => ['', '', 2, 3],
                1 => [1, '', 4, ''],
                2 => [1, '', 3, ''],
                3 => ['', 2, '', 4]
            ],
            'size' => 4,
            'level' => 'easy'
        ] ;
        
        $this->assertInstanceOf(NewGridFromPost::class, new NewGridFromPost($array) ) ;
    }
    
    public function testNewGridFilterNormalLevelValueIsOk()
    {
        $array = [
            't' => [
                0 => ['', '', 2, 3],
                1 => [1, '', 4, ''],
                2 => [1, '', 3, ''],
                3 => ['', 2, '', 4]
            ],
            'size' => 4,
            'level' => 'normal'
        ] ;
        
        $this->assertInstanceOf(NewGridFromPost::class, new NewGridFromPost($array) ) ;
    }
    
    public function testNewGridFilterHardLevelValueIsOk()
    {
        $array = [
            't' => [
                0 => ['', '', 2, 3],
                1 => [1, '', 4, ''],
                2 => [1, '', 3, ''],
                3 => ['', 2, '', 4]
            ],
            'size' => 4,
            'level' => 'hard'
        ] ;
        
        $this->assertInstanceOf(NewGridFromPost::class, new NewGridFromPost($array) ) ;
    }

    public function testNewGridFilterCrazyLevelValueIsOk()
    {
        $array = [
            't' => [
                0 => ['', '', 2, 3],
                1 => [1, '', 4, ''],
                2 => [1, '', 3, ''],
                3 => ['', 2, '', 4]
            ],
            'size' => 4,
            'level' => 'crazy'
        ] ;
        
        $this->assertInstanceOf(NewGridFromPost::class, new NewGridFromPost($array) ) ;
    }

    /**
     * @expectedException Sudoku\Infra\Exception\InvalidLevelValue
     */
    public function testNewGridFilterThrowsLevelValueException()
    {
        $array = [
            't' => [
                0 => ['', '', 2, 3],
                1 => [1, '', 4, ''],
                2 => [1, '', 3, ''],
                3 => ['', 2, '', 4]
            ],
            'size' => 4,
            'level' => 'difficult'
        ] ;
        
        new NewGridFromPost($array) ;
    }

    public function testNewGridFilterReturnsRightfulArray()
    {
        $array = [
            't' => [
                0 => ['', '', 2, 3],
                1 => [1, '', 4, ''],
                2 => [1, '', 3, ''],
                3 => ['', 2, '', 4]
            ],
            'size' => 4,
            'level' => 'easy'
        ] ;
        
        $expected[0][2] = 2 ;
        $expected[0][3] = 3 ;
        $expected[1][0] = 1 ;
        $expected[1][2] = 4 ;
        $expected[2][0] = 1 ;
        $expected[2][2] = 3 ;
        $expected[3][1] = 2 ;
        $expected[3][3] = 4 ;
        
        $filter = new NewGridFromPost($array) ;
        $this->assertEquals($filter->getArray(), $expected) ;
        $this->assertEquals($filter->getSize(), 4) ;
        $this->assertEquals($filter->getLevel(), 'easy') ;
    }
}
