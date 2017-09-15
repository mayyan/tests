'use strict';

/* 
    https://www.youtube.com/watch?v=4qjprDkJrjY&index=3&list=PL2_aWCzGMAwLPEZrZIcNEq9ukGWPfLT4A
    How many times is a sorted array rotated? 
    Items are unique
*/
function findMin(arr) {
    let size = arr.length;

    let low = 0;
    let high = size - 1;
    let mid = -1;
    let res = 0;

    while(arr[low] > arr[high]) {
        mid = Math.floor((low + high) / 2);

        if (low == high - 1) {
            return high;
        }

        if (arr[mid] < arr[high]) {
            high = mid;
        } else {
            low = mid;
        }
    }

    return res;
}

function test(arr, answer) {
    let minPos = findMin(arr);
    if (minPos == answer) {
        console.log(`PASS: [${arr}] rotated ${minPos} times.`);
    } else {
        console.log(`FAIL: [${arr}] rotated ${minPos} times. EXPECT ${answer}.`);
    }
}

test([11,12,2,3,5,6], 2);
test([2,3,5,6,11,12], 0);
test([12,2,3,5,6,11], 1);
test([12,11,6,5,3,2], 5);
test([11,12,15,18,2,5,6,8], 4);