<?php
	//The functions that work behind the scene to calculate the
	//Pearson Correlation Coefficient

	//The functions are external functions implemented by others.
	//The correctness of the functions are already verified by other people.
	//So we don't test these functions.
	function Correlation($arr1, $arr2)
	{        
		$correlation = 0;
		
		$k = SumProductMeanDeviation($arr1, $arr2);
		$ssmd1 = SumSquareMeanDeviation($arr1);
		$ssmd2 = SumSquareMeanDeviation($arr2);
		
		$product = $ssmd1 * $ssmd2;
		
		$res = sqrt($product);
		
		$correlation = $k / $res;
		
		return $correlation;
	}

	function SumProductMeanDeviation($arr1, $arr2)
	{
		$sum = 0;
		
		$num = count($arr1);
		
		for($i=0; $i<$num; $i++)
		{
			$sum = $sum + ProductMeanDeviation($arr1, $arr2, $i);
		}
		
		return $sum;
	}

	function ProductMeanDeviation($arr1, $arr2, $item)
	{
		return (MeanDeviation($arr1, $item) * MeanDeviation($arr2, $item));
	}

	function SumSquareMeanDeviation($arr)
	{
		$sum = 0;
		
		$num = count($arr);
		
		for($i=0; $i<$num; $i++)
		{
			$sum = $sum + SquareMeanDeviation($arr, $i);
		}
		
		return $sum;
	}

	function SquareMeanDeviation($arr, $item)
	{
		return MeanDeviation($arr, $item) * MeanDeviation($arr, $item);
	}

	function SumMeanDeviation($arr)
	{
		$sum = 0;
		
		$num = count($arr);
		
		for($i=0; $i<$num; $i++)
		{
			$sum = $sum + MeanDeviation($arr, $i);
		}
		
		return $sum;
	}

	function MeanDeviation($arr, $item)
	{
		$average = Average($arr);
		
		return $arr[$item] - $average;
	}    

	function Average($arr)
	{
		$sum = Sum($arr);
		$num = count($arr);
		
		return $sum/$num;
	}

	function Sum($arr)
	{
		return array_sum($arr);
	}
?>