'use strict';

/* 
    https://www.youtube.com/watch?v=K7J3nCeRC80&index=7&list=PL2_aWCzGMAwLPEZrZIcNEq9ukGWPfLT4A
    Print elements of a linked list in forward and reverse order using recursion
*/

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

function printForward(head) {
    let f = [];
    function printForward1(head) {
        if (head) {
            f.push(head.value);
            printForward1(head.next);
        }
    }
    printForward1(head);
    console.log(f);
}

function printReverse(head) {
    let r = [];
    function printReverse1(head) {
        if (head) {
            let first = head;
            printReverse1(head.next);
            r.push(first.value);
        }
    }
    printReverse1(head);
    console.log(r);
}

let head1 = new Node(2, null);
head1.append(4);
head1.append(6);
head1.append(8);
printForward(head1);
printReverse(head1);

let head2 = new Node(2, null);
printForward(head2);
printReverse(head2);


let head3 = new Node(2, null);
head3.append(4);
printForward(head3);
printReverse(head3);

let head4 = new Node(2, null);
head4.append(4);
head4.append(6);
printForward(head4);
printReverse(head4);

let head5 = null;
printForward(head5);
printReverse(head5);



