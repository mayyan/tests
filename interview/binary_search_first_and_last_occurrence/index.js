'use strict';

/* Binary search - finding first or last occurrence of a number in a SORTED array */
function binarySearch_first(arr, n) {
    let size = arr.length;

    let low = 0;
    let high = size - 1;
    let mid = -1;
    let res = -1;

    while(low <= high) {
        mid = Math.floor(low + (high - low) / 2);

        if (arr[mid] === n) {
            res = mid;
            high = mid - 1;
        } else if (arr[mid] < n) {
            low = mid + 1;
        } else if (arr[mid] > n) {
            high = mid - 1;
        }
        
    }

    return res;
}

function binarySearch_last(arr, n) {
    let size = arr.length;

    let low = 0;
    let high = size - 1;
    let mid = -1;
    let res = -1;

    while(low <= high) {
        mid = Math.floor(low + (high - low) / 2);

        if (arr[mid] === n) {
            res = mid;
            low = mid + 1;
        } else if (arr[mid] < n) {
            low = mid + 1;
        } else if (arr[mid] > n) {
            high = mid - 1;
        }
        
    }

    return res;
}

function printResult(arr, n, res1, res2) {
    console.log(`[${arr}], first of ${n} is ${res1}, last of ${n} is ${res2}.`);
}

function test(arr, n) {
    let res1 = binarySearch_first(arr, n);
    let res2 = binarySearch_last(arr, n);
    printResult(arr, n, res1, res2);
}

test([2, 4, 5, 10, 13, 18, 20], 10);
test([2, 4, 5, 10, 10, 10, 18, 20], 10);
test([2, 4, 5, 10, 10, 10, 18, 20], 20);
test([2, 4, 5, 10, 10, 10, 18, 20], 1);
test([2, 4, 5, 10, 10, 10, 18, 20], 22);
test([2, 4, 5, 10, 10, 10, 18, 20], 12);
test([2, 4, 5, 10, 10, 10, 18, 20], 2);
test([2, 4, 5, 10, 10, 10, 18, 20], 20);