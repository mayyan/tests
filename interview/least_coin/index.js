'use strict';
/*
    Find the minimum number of coins for a value  
*/

function getLeastCoins(n) {
    const coins = [25, 10, 5, 1];
    let res = [];

    let remain = n;
    for ( let c = 0; c < coins.length; c++) {
        let quotient = Math.floor(remain / coins[c]);
        remain = remain - quotient * coins[c];

        res.push(quotient);
    }

    let count = 0;
    for (let i = 0; i < 4; i++) {
        count += res[i];
    }

    console.log(res);
    return count;
}

function test(n, answer) {
    let res = getLeastCoins(n);
    if (res == answer) {
        console.log(`PASS: Found least coins for ${n} is [${res}].`);
    } else {
        console.log(`FAIL: Found least coins of ${n} is ${res}. Expect ${answer}.`);
    }
}

test(100, 4);
test(99, 9);
test(76, 4)
test(10, 1)