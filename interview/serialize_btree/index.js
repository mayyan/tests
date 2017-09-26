'use strict';

/*
    serialize a binary tree and unserialize from the data you get?  
*/

class Node {
    constructor(value, left, right) {
        this.value = value;
        this.left = left;
        this.right = right;
    }
}

function serialize_preorder(node) {
    var res = [];

    if (node) {
        res.push(node.value);

        let left = serialize_preorder(node.left);
        res = res.concat(left);

        let right = serialize_preorder(node.right);
        res= res.concat(right);
    } else {
        return [-1];
    }

    return res;
}

function unserialize_preorder(arr) {
    var tree;

    let i = 0
    while (i < arr.length-2) {
        if (arr[i] > 0) {
        
            let left = unserialize_preorder(arr[i+1]);
            let right = unserialize_preorder(arr[i+2]);
            
            tree = new Node(arr[i], left, right);
        } else {
            return null;
        }
        i++;
    }

    return tree;
}


function test_serialize(node, answer) {
    let res = serialize_preorder(node);
    if (res == answer) {
        console.log(`PASS: ${res}.`);
    } else {
        console.log(`FAIL: ${res}. Expect ${answer}.`);
    }
}
function test_unserialize(arr, answerTree) {
    let tree = unserialize_preorder(arr);

    let answerArr = serialize_preorder(answerTree);

    if (arr == answerArr) {
        console.log(`PASS: ${arr}.`);
    } else {
        console.log(`FAIL: ${arr}. Expect ${answerArr}.`);
    }
}

{
    let n8 = new Node(8, null, null);
    let n6 = new Node(6, null, null);
    let n4 = new Node(4, null, null);
    n8.left=n6;
    n6.left=n4;
    test_serialize(n8, '8,6,4,-1,-1,-1,-1');
    test_unserialize('8,6,4,-1,-1,-1,-1', n8);
}
{
    let n8 = new Node(8, null, null);
    test_serialize(n8, '8,-1,-1');
    test_unserialize('8,-1,-1', n8);
}
{
    let n10 = new Node(10, null, null);
    let n5 = new Node(5, null, null);
    let n16 = new Node(16, null, null);
    let n4 = new Node(4, null, null);
    let n7 = new Node(7, null, null);
    let n1 = new Node(1, null, null);
    let n11 = new Node(11, null, null);
    n10.left = n5; n10.right = n16;
    n5.left = n4; n5.right=n7
    n4.left=n1;
    n7.right=n11;
    test_serialize(n10, '10,5,4,1,-1,-1,-1,7,-1,11,-1,-1,16,-1,-1');
}
