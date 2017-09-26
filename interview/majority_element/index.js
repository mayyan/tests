'use strict';

/*
    Majority Element: A majority element in an array A[] of size n is an element that appears more than n/2 times (and hence there is at most one such element).
*/

/*
    Time Complexity: O(n)
    Auxiliary Space: O(n)
*/
function getMajorityElement_map(arr) {
    var map = [];

    for(let i = 0; i < arr.length; i++) {
        let item = arr[i];

        if (!map[item]) {
            map[item] = 1;
        } else {
            map[item] += 1;
        }

        if (map[item] > arr.length / 2) {
            return item;
        }
    }

    return 0;
}

function test_map(arr, answer) {
    var res = getMajorityElement_map(arr);
    if (res == answer) {
        console.log(`PASS: Found marojity element of [${arr}] is ${res}.`);
    } else {
        console.log(`FAIL: Found marojity element of [${arr}] is ${res}. Expect ${answer}.`);
    }
}

test_map([2,3,4,4,1,1,5,3,4], 0);
test_map([3,3,4,2,4,4,2,4,4], 4);
test_map([4,3,4,4,4,1,4,3], 4);
test_map([4,3,4,4,4,1,5,3], 0);
test_map([4,3], 0);


/* 
    Time Complexity: O(n)
    Auxiliary Space : O(1)
*/
function getMajorityElement_moore(arr) {
    var candidate_index = 0;
    var vote = 0;
    for (let i=0; i<arr.length; i++) {
        let item = arr[i];

        if (item == arr[candidate_index]) {
            vote += 1;
        } else {
            vote -= 1;
        }

        if (vote == 0) {
            candidate_index = i;
            vote = 1;
        }
    }

    var candidate_value = arr[candidate_index];
    var count = 0;
    for (let i=0; i<arr.length; i++) {
            let item = arr[i];

            if (item == candidate_value) {
                count += 1;
            }
    }

    if (count > arr.length / 2) {
        return candidate_value;
    } else {
        return 0;
    }
}

function test_moore(arr, answer) {
    var res = getMajorityElement_moore(arr);
    if (res == answer) {
        console.log(`PASS: Found marojity element of [${arr}] is ${res}.`);
    } else {
        console.log(`FAIL: Found marojity element of [${arr}] is ${res}. Expect ${answer}.`);
    }
}

test_moore([2,3,4,4,1,1,5,3,4], 0);
test_moore([3,3,4,2,4,4,2,4,4], 4);
test_moore([4,3,4,4,4,1,4,3], 4);
test_moore([4,3,4,4,4,1,5,3], 0);
test_moore([4,3], 0);
