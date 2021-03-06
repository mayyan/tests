'user strict';

/* 
    https://www.youtube.com/watch?v=sYcOK51hl-A&list=PL2_aWCzGMAwLPEZrZIcNEq9ukGWPfLT4A&index=6
    Reverse a linked list - Iterative method 
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

function reverse(head) {
    if (head) {
        let prev = null;
        let curr = head;
        let next = head.next;

        while(next != null) {
            prev = curr;
            curr = next;
            next = curr.next;

            curr.next = prev;
        }

        head.next = null;
        return curr;
    } else {
        return head;
    }
}

function print(head) {
    let res = [];

    if (head) {
        let p = head;

        while(p != null) {
            res.push(p.value);
            p = p.next;
        }
    }
    console.log(res);
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
