'use strict';

/* 
    https://www.youtube.com/watch?v=QZOLb0xHB_Q&index=10&list=PL2_aWCzGMAwLPEZrZIcNEq9ukGWPfLT4A
    Check for balanced parentheses using stack
*/
function isParenthesesBalanced(expression) {
    let stack = [];
    let si = 0;

    for(let i=0; i<expression.length; i++) {
        let char = expression.charAt(i);
        
        if (['(', '{', '['].indexOf(char) >= 0) {
            stack.push(char);
            si++;
        } else if ([')', '}', ']'].indexOf(char) >= 0) {
            if ( (char == ')' && stack[si-1] == '(') ||
                 (char == ']' && stack[si-1] == '[') ||
                 (char == '}' && stack[si-1] == '{') ) {
                stack.pop();
                si--;
            } else {
                return false;
            }
        }
    }
    return si == 0;
}

function test(expression, answer) {
    let res = isParenthesesBalanced(expression);
    if (res == answer) {
        console.log(`PASS: 'is ${expression} balanced?: ${res}.`);
    } else {
        console.log(`FAIL: 'is ${expression} balanced?: got ${res}, EXPECT ${answer}.`);
    }
}

test('()', true);
test('{( ) () }', true);
test('((((({})))))', true);
test('{() ()', false);
test('[ ] ( )]', false);
test('{)', false);
test(')}}', false);
test('{ab[[c+d](5*6)+(...)]}', true);