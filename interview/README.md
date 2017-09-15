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
Speed is O(log(n))

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
Speed is O(log(n)).