'use strict';

/* 
    https://www.youtube.com/watch?v=hNP72JdOIgY&list=PL2_aWCzGMAwLPEZrZIcNEq9ukGWPfLT4A&index=9
    Reverse a string or linked list using stack.
*/
function reverseString(str) {
    let stack = [];
    let res = [];

    for(let i = 0; i < str.length; i++) {
        stack.push(str.charAt(i));
    }

    for(let i = 0; i < str.length; i++) {
        res[i] = stack.pop();
    }

    return res.join('');
}

function test_reverseString(str, answer) {
    let s = reverseString(str);
    if (s == answer) {
        console.log(`PASS: '${str}', reversed to '${s}'.`);
    } else {
        console.log(`FAIL: '${str}', reversed to '${s}', EXPECT '${answer}'.`);
    }
}

test_reverseString('', '');
test_reverseString('A', 'A');
test_reverseString('hello', 'olleh');

class Node {
    constructor(value, next) {
        this.value = value;
        this.next = next;
    }

    append(value) {
        let p = this;
        let prev = p;

        while(p != null) {
            prev = p;
            p = p.next;
        }

        let n = new Node(value, null);
        prev.next = n;
    }
}

function printLikedlist(head) {
    let f = [];
    function printLikedlist1(head) {
        if (head) {
            f.push(head.value);
            printLikedlist1(head.next);
        }
    }
    printLikedlist1(head);
    console.log(f);
}

function reverseLikedlist(head) {
    let stack = [];
    let p = head;

    while (p) {
        stack.push(p);
        p = p.next;
    }

    let newHead = stack.pop();
    let n = newHead;
    while (n) {
        n.next = stack.pop();
        n = n.next;
    }

    return newHead;
}


let head1 = new Node(2, null);
head1.append(4);
head1.append(6);
head1.append(8);
printLikedlist(head1);
let r1 = reverseLikedlist(head1);
printLikedlist(r1);


let head2 = new Node(2, null);
printLikedlist(head2);
let r2 = reverseLikedlist(head2);
printLikedlist(r2);


let head3 = new Node(2, null);
head3.append(4);
printLikedlist(head3);
let r3 = reverseLikedlist(head3);
printLikedlist(r3);

let head4 = new Node(2, null);
head4.append(4);
head4.append(6);
printLikedlist(head4);
let r4 = reverseLikedlist(head4);
printLikedlist(r4);

let head5 = null;
printLikedlist(head5);
let r5 = reverseLikedlist(head5);
printLikedlist(r5);

