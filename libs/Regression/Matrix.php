<?php

class Lib_Matrix
{

    //global vars
    protected $rows;
    protected $columns;
    protected $MainMatrix = array();

    
    function __construct($matrix)
    {
        for ($i = 0; $i < count($matrix); $i++)
        {
            for ($j = 0; $j < count($matrix[$i]); $j++)
                $this->MainMatrix[$i][$j] = $matrix[$i][$j];
        }
        $this->rows = count($this->MainMatrix);
        $this->columns = count($this->MainMatrix[0]);
        if (!$this->isValidMatrix())
        {
            throw new Exception("Invalid matrix");
        }
    }

    
    private function isValidMatrix()
    {
        for ($i = 0; $i < $this->rows; $i++)
        {
            $numCol = count($this->MainMatrix [$i]);
            if ($this->columns != $numCol)
                return false;
        }
        return true;
    }

    
    public function DisplayMatrix()
    {
        $rows = $this->rows;
        $cols = $this->columns;
        echo "Order of the matrix is ($rows rows X $cols columns)\n";
        for ($r = 0; $r < $rows; $r++)
        {
            for ($c = 0; $c < $cols; $c++)
            {
                echo $this->MainMatrix[$r][$c];
            }
            echo "\n";
        }
    }

    
    public function GetInnerArray()
    {
        return $this->MainMatrix;
    }

    
    public function NumRows()
    {
        return count($this->MainMatrix);
    }

    
    public function NumColumns()
    {
        return count($this->MainMatrix[0]);
    }

    
    public function GetElementAt($row, $col)
    {
        return $this->MainMatrix[$row][$col];
    }

    /**
     * Is this a square matrix?
     * 
     * Determinants and inverses only exist for square matrices!
     * 
     * @return bool 
     */
    public function isSquareMatrix()
    {
        if ($this->rows == $this->columns)
            return true;

        return false;
    }

    
    public function Subtract(Lib_Matrix $matrix2)
    {
        $rows1 = $this->rows;
        $columns1 = $this->columns;

        $rows2 = $matrix2->NumRows();
        $columns2 = $matrix2->NumColumns();

        if (($rows1 != $rows2) || ($columns1 != $columns2))
            throw new Exception('Matrices are not the same size!');

        for ($i = 0; $i < $rows1; $i++)
        {
            for ($j = 0; $j < $columns1; $j++)
            {
                $newMatrix[$i][$j] = $this->MainMatrix[$i][$j] -
                        $matrix2->GetElementAt($i, $j);
            }
        }
        return new Lib_Matrix($newMatrix);
    }

    
    function Add(Lib_Matrix $matrix2)
    {
        $rows1 = $this->rows;
        $rows2 = $matrix2->NumRows();
        $columns1 = $this->columns;
        $columns2 = $matrix2->NumColumns();
        if (($rows1 != $rows2) || ($columns1 != $columns2))
            throw new Exception('Matrices are not the same size!');

        for ($i = 0; $i < $rows1; $i++)
        {
            for ($j = 0; $j < $columns1; $j++)
            {
                $newMatrix[$i][$j] = $this->MainMatrix[$i][$j] +
                        $matrix2->GetElementAt($i, $j);
            }
        }
        return new Lib_Matrix($newMatrix);
    }

    
    function Multiply(Lib_Matrix $matrix2)
    {
        $sum = 0;
        $rows1 = $this->rows;
        $columns1 = $this->columns;

        $columns2 = $matrix2->NumColumns();
        $rows2 = $matrix2->NumRows();
        if ($columns1 != $rows2)
            throw new Exception('Incompatible matrix types supplied');
        for ($i = 0; $i < $rows1; $i++)
        {
            for ($j = 0; $j < $columns2; $j++)
            {
                $newMatrix[$i][$j] = 0;
                for ($ctr = 0; $ctr < $columns1; $ctr++)
                {
                    $newMatrix[$i][$j] += $this->MainMatrix[$i][$ctr] *
                            $matrix2->GetElementAt($ctr, $j);
                }
            }
        }
        return new Lib_Matrix($newMatrix);
    }

    
    public function ScalarMultiply($scalar)
    {
        $rows = $this->rows;
        $columns = $this->columns;

        $newMatrix = array();
        for ($i = 0; $i < $rows; $i++)
        {
            for ($j = 0; $j < $columns; $j++)
            {
                $newMatrix[$i][$j] = $this->MainMatrix[$i][$j] * $scalar;
            }
        }
        return new Lib_Matrix($newMatrix);
    }

    public function ScalarDivide($scalar)
    {
        $rows = $this->rows;
        $columns = $this->columns;

        $newMatrix = array();
        for ($i = 0; $i < $rows; $i++)
        {
            for ($j = 0; $j < $columns; $j++)
            {
                $newMatrix[$i][$j] = $this->MainMatrix[$i][$j] / $scalar;
            }
        }
        return new Lib_Matrix($newMatrix);
    }

    public function GetSubMatrix($crossX, $crossY)
    {
        $rows = $this->rows;
        $columns = $this->columns;

        $newMatrix = array();
        $p = 0; // submatrix row counter
        for ($i = 0; $i < $rows; $i++)
        {
            $q = 0; // submatrix col counter
            if ($crossX != $i)
            {
                for ($j = 0; $j < $columns; $j++)
                {
                    if ($crossY != $j)
                    {
                        $newMatrix[$p][$q] = $this->GetElementAt($i, $j);
                        //$matrix[$i][$j];
                        $q++;
                    }
                }
                $p++;
            }
        }
        return new Lib_Matrix($newMatrix);
    }

    public function Determinant()
    {
        if (!$this->isSquareMatrix())
            throw new Exception("Not a square matrix!");
        $rows = $this->rows;
        $columns = $this->columns;
        $determinant = 0;
        if ($rows == 1 && $columns == 1)
        {
            return $this->MainMatrix[0][0];
        }
        if ($rows == 2 && $columns == 2)
        {
            $determinant = $this->MainMatrix[0][0] * $this->MainMatrix[1][1] -
                    $this->MainMatrix[0][1] * $this->MainMatrix[1][0];
        } else
        {
            for ($j = 0; $j < $columns; $j++)
            {
                $subMatrix = $this->GetSubMatrix(0, $j);
                if (fmod($j, 2) == 0)
                {
                    $determinant += $this->MainMatrix[0][$j] * $subMatrix->Determinant();
                } else
                {
                    $determinant -= $this->MainMatrix[0][$j] * $subMatrix->Determinant();
                }
            }
        }
        return $determinant;
    }

    public function Transpose()
    {
        $rows = $this->rows;
        $columns = $this->columns;
        $newArray = array();
        for ($i = 0; $i < $rows; $i++)
        {
            for ($j = 0; $j < $columns; $j++)
            {
                $newArray[$j][$i] = $this->MainMatrix[$i][$j];
            }
        }
        return new Lib_Matrix($newArray);
    }

    
    function Inverse()
    {
        if (!$this->isSquareMatrix())
            throw new Exception("Not a square matrix!");
        $rows = $this->rows;
        $columns = $this->columns;

        $newMatrix = array();
        for ($i = 0; $i < $rows; $i++)
        {
            for ($j = 0; $j < $columns; $j++)
            {
                $subMatrix = $this->GetSubMatrix($i, $j);
                if (fmod($i + $j, 2) == 0)
                {
                    $newMatrix[$i][$j] = ($subMatrix->Determinant());
                } else
                {
                    $newMatrix[$i][$j] = -($subMatrix->Determinant());
                }
            }
        }
        $cofactorMatrix = new Lib_Matrix($newMatrix);
        return $cofactorMatrix->Transpose()
                ->ScalarDivide($this->Determinant());
    }
}

?>
