'use strict';

/* 
    https://www.youtube.com/watch?v=pLT_9jwaPLs&index=2&list=PL2_aWCzGMAwLPEZrZIcNEq9ukGWPfLT4A
    Count occurrences of a number in a sorted array with duplicates using Binary Search
*/
function binarySearch(arr, n, searchFirst) {
    let size = arr.length;

    let low = 0;
    let high = size - 1;
    let mid = -1;
    let res = -1;

    while(low <= high) {
        mid = Math.floor((low + high) / 2);

        if (arr[mid] === n) {
            res = mid;
            if (searchFirst) {
                high = mid - 1;
            } else {
                low = mid + 1;
            }
        } else if (arr[mid] < n) {
            low = mid + 1;
        } else if (arr[mid] > n) {
            high = mid - 1;
        }
        
    }

    return res;
}

function getCount(arr, n) {
    let first = binarySearch(arr, n, true);
    let last = binarySearch(arr, n, false);
    let count = 0;
    if (first != -1 && last != -1) {
        count = last - first + 1;
    }
    return count;
}

function printResult(arr, n, count) {
    console.log(`[${arr}], ${n} occured ${count} times.`);
}

function test(arr, n) {
    let count = getCount(arr, n);
    printResult(arr, n, count);
}

test([2, 4, 5, 10, 13, 18, 20], 10);
test([2, 4, 5, 10, 10, 10, 18, 20], 10);
test([2, 4, 5, 10, 10, 10, 18, 20], 20);
test([2, 4, 5, 10, 10, 10, 18, 20], 1);
test([2, 4, 5, 10, 10, 10, 18, 20], 22);
test([2, 4, 5, 10, 10, 10, 18, 20], 12);
test([2, 4, 5, 10, 10, 10, 18, 20], 2);
test([1, 1, 3, 3, 5, 5, 5, 5, 5, 9, 9, 11], 5);