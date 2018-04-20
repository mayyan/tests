'user strict';

/*
    Make this work, update the original too.
    [1,2,3,4,5].duplicate()
*/

function duplicate(arr) {

    let l = arr.length;
    for(let i=0; i<l; i++) {
        arr.push(arr[i]);
    }
}

function test(arr, answer) {
    duplicate(arr);
    if (arr == answer) {
        console.log(`PASS: ${arr}`);
    } else {
        console.log(`FAIL: ${arr}, expect ${answer}.`)
    }
}

test([1,2,3,4,5], '1,2,3,4,5,1,2,3,4,5');