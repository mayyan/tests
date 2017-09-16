'use strict';

/* 
    https://www.youtube.com/watch?v=KYH83T4q6Vs&list=PL2_aWCzGMAwLPEZrZIcNEq9ukGWPfLT4A&index=8
    Reverse a linked list using recursion
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

function print(head) {
    let f = [];
    function print1(head) {
        if (head) {
            f.push(head.value);
            print1(head.next);
        }
    }
    print1(head);
    console.log(f);
}

function reverse(head) {
    if (head) {
        let newHead = null;

        if (head.next) {
            newHead = reverse(head.next);

            head.next.next = head;
            head.next = null;
        } else {
            newHead = head;
        }
    
        return newHead;
    } else {
        return head;
    }
}

let head1 = new Node(2, null);
head1.append(4);
head1.append(6);
head1.append(8);
print(head1);
let list1 = reverse(head1);
print(list1);

let head2 = new Node(2, null);
print(head2);
let list2 = reverse(head2);
print(list2);


let head3 = new Node(2, null);
head3.append(4);
print(head3);
let list3 = reverse(head3);
print(list3);

let head4 = new Node(2, null);
head4.append(4);
head4.append(6);
print(head4);
let list4 = reverse(head4);
print(list4);

let head5 = null;
print(head5);
let list5 = reverse(head5);
print(list5);
