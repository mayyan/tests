'use strict'

/* 
    https://www.youtube.com/watch?v=siKFOI8PNKM&list=PL2_aWCzGMAwLPEZrZIcNEq9ukGWPfLT4A&index=5
    Print 2-D array in spiral order 
*/
function print(input) {
    let x = 0;
    let y = 0;
    let dir = 'r'; // r, d, l, u
    let col = input[0].length;
    let row = input.length;
    let total = col * row;
    let printed = 0;
    let res = [];
    let run = [];

    while (printed < total) {
        if (dir == 'r') {
            run = printRow(input, x, y, col, dir);
            x = x + col - 1;
            y = y + 1;
            row = row - 1;
            dir = 'd';
        } else if (dir == 'd') {
            run = printColumn(input, x, y, row, dir);
            x = x - 1;
            y = y + row - 1;
            col = col - 1;
            dir = 'l'
        } else if (dir == 'l') {
            run = printRow(input, x, y, col, dir);
            x = x - col + 1;
            y = y - 1;
            row = row - 1;
            dir = 'u'
        } else if (dir == 'u') {
            run = printColumn(input, x, y, row, dir);
            x = x + 1;
            y = y - row + 1;
            col = col - 1;
            dir = 'r'
        }
        res = res.concat(run);
        printed = res.length;
    }

    return res;
}

function printRow(input, x, y, n, dir) {
    let printed = [];
    while (printed.length < n) {
        printed.push(input[y][x]);

        if (dir == 'r') {
            x = x+1;
        } else {
            x = x-1;
        }
    }

    return printed;
}

function printColumn(input, x, y, n, dir) {
    let printed = [];
    while (printed.length < n) {
        printed.push(input[y][x]);

        if (dir == 'd') {
            y = y+1;
        } else {
            y = y-1;
        }
    }

    return printed;
}


function test(input, answer) {
    let res = print(input);

    if (res == answer) {
        console.log(`PASS: [${input}], spiral [${res}].`);
    } else {
        console.log(`FAIL: got [${res}], EXPECT [${answer}]`);
    }
}

test([[2,4,6,8],
    [5,9,12,16],
    [2,11,5,9],
    [3,2,1,8]], '2,4,6,8,16,9,8,1,2,3,2,5,9,12,5,11');

test([[2,4,6,8,7],
    [5,9,12,16,4],
    [2,11,5,9,6],
    [3,2,1,8,1]], '2,4,6,8,7,4,6,1,8,1,2,3,2,5,9,12,16,9,5,11');


