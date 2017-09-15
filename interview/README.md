# Programming Interview Questions

Questions are taken from https://www.youtube.com/playlist?list=PL2_aWCzGMAwLPEZrZIcNEq9ukGWPfLT4A



## binary_search_first_and_last_occurrence
Binary search - finding first or last occurrence of a number in a SORTED array
```
$ devtool ./index.js  --break
$ node ./index.js

$ node index.js
[2,4,5,10,13,18,20], first of 10 is 3, last 10 is 3.
[2,4,5,10,10,10,18,20], first of 10 is 3, last 10 is 5.
[2,4,5,10,10,10,18,20], first of 20 is 7, last 20 is 7.
[2,4,5,10,10,10,18,20], first of 1 is -1, last 1 is -1.
[2,4,5,10,10,10,18,20], first of 22 is -1, last 22 is -1.
[2,4,5,10,10,10,18,20], first of 12 is -1, last 12 is -1.
[2,4,5,10,10,10,18,20], first of 2 is 0, last 2 is 0.
[2,4,5,10,10,10,18,20], first of 20 is 7, last 20 is 7.
```
Time complexity is O(log(n))

## count_of_occurrence
Count occurrences of a number in a sorted array with duplicates using Binary Search
```
$ devtool ./index.js  --break
$ node index.js
[2,4,5,10,13,18,20], 10 occured 1 times.
[2,4,5,10,10,10,18,20], 10 occured 3 times.
[2,4,5,10,10,10,18,20], 20 occured 1 times.
[2,4,5,10,10,10,18,20], 1 occured 0 times.
[2,4,5,10,10,10,18,20], 22 occured 0 times.
[2,4,5,10,10,10,18,20], 12 occured 0 times.
[2,4,5,10,10,10,18,20], 2 occured 1 times.
[1,1,3,3,5,5,5,5,5,9,9,11], 5 occured 5 times.
```
Time complexity is O(log(n)).

## rotated_array
How many times is a sorted array rotated?
```
$ node index.js
PASS: [11,12,2,3,5,6] rotated 2 times.
PASS: [2,3,5,6,11,12] rotated 0 times.
PASS: [12,2,3,5,6,11] rotated 1 times.
PASS: [12,11,6,5,3,2] rotated 5 times.
PASS: [11,12,15,18,2,5,6,8] rotated 4 times.
```
Time complexity is O(log(n)).

## find_in_circular_sorted_array
Search element in a circular sorted array
```$ node index.js
PASS: [12,14,18,21,3,6,8,9], found 18 at 2.
PASS: [12,14,18,21,3,6,8,9], found 12 at 0.
PASS: [12,14,18,21,3,6,8,9], found 21 at 3.
PASS: [12,14,18,21,3,6,8,9], found 3 at 4.
PASS: [12,14,18,21,3,6,8,9], found 9 at 7.
PASS: [12,14,18,21,3,6,8,9], found 5 at -1.
```

## spiral_print_array
Print 2-D array in spiral order
```
node index.js
PASS: [2,4,6,8,5,9,12,16,2,11,5,9,3,2,1,8] spiral [2,4,6,8,16,9,8,1,2,3,2,5,9,12,5,11].
PASS: [2,4,6,8,7,5,9,12,16,4,2,11,5,9,6,3,2,1,8,1] spiral [2,4,6,8,7,4,6,1,8,1,2,3,2,5,9,12,16,9,5,11].
```

## reverse_linked_list
Reverse a linked list - Iterative method

