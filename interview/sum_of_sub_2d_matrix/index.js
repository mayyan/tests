'use restrict';

/*
    Sum of 2D matrix from i,j to m,n
    DO NOT assume x1 <= x2, y1 <= y2
*/

function getSubSum(arr, x1, y1, x2, y2) {
    let sum = 0;
    // for (let i = x1; i<=x2; i++) {
    //     for (let j = y1; j<=y2; j++) {
    //         sum += arr[i][j];
    //     }
    // }

    let i = x1;
    let j = y1;

    let boundX = (x1 <= x2) ? x2+1 : x2-1;
    let boundY = (y1 <= y2) ? y2+1 : y2-1;

    while (i != boundX) {
        while (j != boundY) {
            sum += arr[i][j];

            j = (y1 <= y2) ? (j + 1) : (j - 1);
        }
        i = (x1 <= x2) ? (i + 1) : (i - 1);
        j = y1;
    }

    return sum;
}

function test(arr, x1, y1, x2, y2, answer) {
    let res = getSubSum(arr, x1, y1, x2, y2);

    if (res == answer) {
        console.log(`PASS: Found sum for [${arr}] within ${x1}, ${y1}, ${x2}, ${y2} is ${res}.`);
    } else {
        console.log(`FAIL: Found sum for [${arr}] within ${x1}, ${y1}, ${x2}, ${y2} is ${res}. Expect ${answer}.`);
    }
}


test([[2, 4, 6, 8],
      [5, 9,12,16],
      [2,11, 5, 9],
      [3, 2, 1, 8]], 0,1, 1,3, 55);


test([[2, 4, 6, 8],
      [5, 9,12,16],
      [2,11, 5, 9],
      [3, 2, 1, 8]], 2,3, 2,3, 9);

test([[2, 4, 6, 8],
      [5, 9,12,16],
      [2,11, 5, 9],
      [3, 2, 1, 8]], 2,2, 0,3, 56);


