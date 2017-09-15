'use strict';

/* 
    https://www.youtube.com/watch?v=uufaK2uLnSI&list=PL2_aWCzGMAwLPEZrZIcNEq9ukGWPfLT4A&index=4
    Search element in a circular sorted array
    Items are unique
*/

function circularArratSearch(arr, n) {
    let low = 0;
    let high = arr.length - 1;
    let res = -1;


    while (low <= high) {
        let mid = Math.floor((low + high) / 2);

        if (arr[mid] === n) {
            res = mid;
            break;
        } 

        if (arr[mid] <= arr[high]) { // right is sorted
            // implies arr[low] > arr[mid] (left is not sorted)
            if (arr[mid] <= n && n <= arr[high]) {
                low = mid + 1;
            } else {
                high = mid - 1;
            }
        } else { // arr[mid] > arr[high] (right is not sorted)
            // implies arr[low] <= arr[mid] ( left is sorted)
            if (arr[low] <= n && n <= arr[mid]) {
                high = mid - 1;
            } else {
                low = mid + 1;
            }
        }
    }

    return res;

}

function test(arr, n, answer) {
    let pos = circularArratSearch(arr, n);
    if (pos == answer) {
        console.log(`PASS: [${arr}], found ${n} at ${pos}.`);
    } else {
        console.log(`FAIL: [${arr}], found ${n} at ${pos}. EXPECT at ${answer}.`);
    }
}

test([12,14,18,21,3,6,8,9], 18, 2);
test([12,14,18,21,3,6,8,9], 12, 0);
test([12,14,18,21,3,6,8,9], 21, 3);
test([12,14,18,21,3,6,8,9], 3, 4);
test([12,14,18,21,3,6,8,9], 9, 7);
test([12,14,18,21,3,6,8,9], 5, -1);