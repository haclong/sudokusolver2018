<?php

namespace Tests\Sudoku\Infra\Filter;

use PHPUnit_Framework_TestCase;
use Sudoku\Infra\Filter\NewGridFilter;

/**
 * Description of NewGridFilterTest
 *
 * @author haclong
 */
class NewGridFilterTest extends PHPUnit_Framework_TestCase {
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
        new NewGridFilter(['t' => '', 'size' => 9, 'level' => 'easy']) ;
    }

    /**
     * @expectedException Sudoku\Infra\Exception\ArrayKeyNotFound
     */
    public function testArrayKeyLevelExpected()
    {
        new NewGridFilter(['size' => 9, 't' => []]) ;
    }

    /**
     * @expectedException Sudoku\Infra\Exception\ArrayKeyNotFound
     */
    public function testArrayKeyTExpected()
    {
        new NewGridFilter(['size' => 9, 'level' => 'easy']) ;
    }

    /**
     * @expectedException Sudoku\Infra\Exception\ArrayKeyNotFound
     */
    public function testArrayKeySizeExpected()
    {
        new NewGridFilter(['t' => [], 'level' => 'easy']) ;
    }

    /**
     * @expectedException Sudoku\Infra\Exception\IntExpected
     */
    public function testIntExpected()
    {
        new NewGridFilter(['t' => [], 'size' => 'A', 'level' => 'easy']) ;
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
        
        new NewGridFilter(['t' => $t4, 'size' => 4, 'level' => 'easy']) ;
        new NewGridFilter(['t' => $t9, 'size' => 9, 'level' => 'easy']) ;
        new NewGridFilter(['t' => $t16, 'size' => 16, 'level' => 'easy']) ;
        new NewGridFilter(['t' => $t25, 'size' => 25, 'level' => 'easy']) ;
        new NewGridFilter(['t' => $t5, 'size' => 5, 'level' => 'easy']) ;
    }

    /**
     * @expectedException Sudoku\Infra\Exception\ArraySizeNotMatching
     */
    public function testArraySizeNotMatchingExpected()
    {
        new NewGridFilter(['t' => [], 'size' => 4, 'level' => 'easy']) ;
    }

    /**
     * @expectedException Sudoku\Infra\Exception\ArraySizeNotMatching
     */
    public function testInnerArraySizeNotMatchingExpected()
    {
        new NewGridFilter(['t' => [0 => ['', '', '', ''], 1 => [], 2 => [], 3 => []], 'size' => 4, 'level' => 'easy']) ;
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
        new NewGridFilter($array) ;
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
        
        $this->assertInstanceOf(NewGridFilter::class, new NewGridFilter($array) ) ;
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
        
        $this->assertInstanceOf(NewGridFilter::class, new NewGridFilter($array) ) ;
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
        
        $this->assertInstanceOf(NewGridFilter::class, new NewGridFilter($array) ) ;
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
        
        $this->assertInstanceOf(NewGridFilter::class, new NewGridFilter($array) ) ;
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
        
        new NewGridFilter($array) ;
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
        
        $filter = new NewGridFilter($array) ;
        $this->assertEquals($filter->getArray(), $expected) ;
        $this->assertEquals($filter->getSize(), 4) ;
        $this->assertEquals($filter->getLevel(), 'easy') ;
    }
}
