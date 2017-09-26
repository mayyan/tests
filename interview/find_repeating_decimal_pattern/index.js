'use strict';

/*
    get the repeating decimal pattern of a division? (e.g 1/3, 1/6)
*/

function getPatern(numerator, demoninator) {
    var res = '';
    var remainderMap = [];

    let remainder = numerator % demoninator;

    while(remainder > 0 && remainderMap[remainder] === undefined) {

        remainderMap[remainder] = res.length;

        let numr = remainder * 10;

        let quot = Math.floor(numr / demoninator);
        res += `${quot}`;

        remainder = numr % demoninator;

        if (remainder === 0) {
            res = '';
        }
        
    }

    return res.substr(remainderMap[remainder]);

}

function test(numerator, demoninator, answer) {
    let res = getPatern(numerator, demoninator);
    if (res == answer) {
        console.log(`PASS: ${numerator}/${demoninator} repeats '${res}'.`);
    } else {
        console.log(`FAIL: ${numerator}/${demoninator} repeats '${res}'. Expect '${answer}'.`);
    }
}

test(1,2, '');
test(1,3, '3');
test(2,3, '6');
test(1,4, '');
test(1,6, '6');
test(1,7, '142857');
test(50,22, '27');
