## Sum Pairs

### Requirements

Write a function f(x) that returns all distinct pairs of integers between -50 and 50 (inclusive) whose sum is `x`. Thus:

* f(100) returns []
* f(99) returns (49,50)
* f(0) returns (-50,50)(-49,49)(-48,48)(-47,47)(-46,46)(-45,45)(-44,44)(-43,43)(-42,42)(-41,41)(-40,40)(-39,39)(-38,38)(-37,37)(-36,36)(-35,35)(-34,34)(-33,33)(-32,32)(-31,31)(-30,30)(-29,29)(-28,28)(-27,27)(-26,26)(-25,25)(-24,24)(-23,23)(-22,22)(-21,21)(-20,20)(-19,19)(-18,18)(-17,17)(-16,16)(-15,15)(-14,14)(-13,13)(-12,12)(-11,11)(-10,10)(-9,9)(-8,8)(-7,7)(-6,6)(-5,5)(-4,4)(-3,3)(-2,2)(-1,1)

### Discussion

While the solution is a bit overkill for the problem at hand, the code shows a number of concepts that are important in software development, namely:

* Object-oriented programming principles
    * Single responsibility
    * Dependency inversion
    * Don't repeat yourself
* Test driven development (or at the very least, having functional tests)
* Exception handling
* Lazy class loading
* Namespacing

#### Big-O

The functionality that solves the problem posed basically boils down to the following:

    // input
    $sum = 0;
    $range = [-50, 50];
    $pairs = [];

    // loop range
    for ( $i=$range[0] ; $i<=$range[1] ; $i++ ) {

        for ( $j=$i+1 ; $j<=$range[1] ; $j++ ) {

            if ( $sum === ( $i + $j ) ) {
                $pairs[] = [$i, $j];
            }

        }

    }

* $sum, $range, and $pairs assignment: `O(1)`
* outer loop: `O(n)`
* inner loop: `O(.5n)` as it will average half as many iterations as the outer loop
* is equal conditional: `O(1)`
* append to $pairs array: `O(1)`

Written out and simplifying yields:

    O(1) + O(1) + O(1) + O(n){ O(.5n)[ O(1) + O(1) ] }
    O(3) + O(n^2)
    O(n^2)

A more efficient approach for a large dataset might be, for a single outer iteration:

1. split the inner range in half [1sthalf, 2ndhalf]
2. take the first value of the 2ndhalf
3. add this value to the outer index
4. compare this calculation ($calc) to the input $sum
5. if $calc < $sum, split 2ndhalf into new [1sthalf, 2ndhalf]; else split 1sthalf into new [1sthalf, 2ndhalf]
6. repeat steps 2-5 until the proper inner value is found
