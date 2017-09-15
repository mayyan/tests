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

    reverse() {
        
    }

    print() {
        let p = this;

        while(p != null) {
            console.log(p.value);
            p = p.next;
        }
    }
}

let head = new Node(2, null);
head.append(4);
head.append(6);
head.append(8);
head.print();

let list = head.reverse();
list.print();