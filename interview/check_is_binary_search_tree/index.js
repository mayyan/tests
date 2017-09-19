'use strict';

/*
    https://www.youtube.com/watch?v=yEwSGhSsT0U&index=11&list=PL2_aWCzGMAwLPEZrZIcNEq9ukGWPfLT4A
    Check if a binary tree is binary search tree or not
*/

class Node {
    constructor(value, left, right) {
        this.value = value;
        this.left = left;
        this.right = right;
    }
}

function getMin(a,b) {
    if (!a) return b;
    if (!b) return a;
    return Math.min(a, b);
}
function getMax(a,b) {
    if (!a) return b;
    if (!b) return a;
    return Math.max(a, b);
}

// traverse in left, root, right order
function traversBST(tree) {
    let res = {
        arr: [],
        min: undefined,
        max: undefined,
        isBST: true
    };
    if (!tree) {
        return res;
    }

    let leftTree = null;
    if (tree.left) {
        leftTree = traversBST(tree.left);
        res.arr = res.arr.concat(leftTree.arr);
        res.min = getMin(leftTree.min, res.min);
        res.max = getMax(leftTree.max, res.min);
    }

    res.arr.push(tree.value);
    res.min = getMin(res.min, tree.value);
    res.max = getMax(res.max, tree.value);

    let rightTree = null;
    if (tree.right) {
        rightTree = traversBST(tree.right);
        res.arr = res.arr.concat(rightTree.arr);
        res.min = getMin(rightTree.min, res.min);
        res.max = getMax(rightTree.max, res.min);
    }

    if (tree.left && tree.right) {
        if (leftTree.max <= tree.value && tree.value < rightTree.min &&
                leftTree.isBST && rightTree.isBST) {
            res.isBST = true;
        } else {
            res.isBST = false;
        }
    } else if (!tree.left && tree.right) {
        if (tree.value < rightTree.min && rightTree.isBST) {
            res.isBST = true;
        } else {
            res.isBST = false;
        }
    } else if (tree.left && !tree.right) {
        if (leftTree.max <= tree.value  && leftTree.isBST) {
            res.isBST = true;
        } else {
            res.isBST = false;
        }
    }

    return res;
}

{
    let n8 = new Node(8, null, null);
    let n6 = new Node(6, null, null);
    let n4 = new Node(4, null, null);
    n8.left=n6;
    n6.left=n4;
    console.log(traversBST(n8));
}
{
    let n8 = new Node(8, null, null);
    console.log(traversBST(n8));
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
    console.log(traversBST(n10));
}
{
    let n7 = new Node(7, null, null);
    let n4 = new Node(4, null, null);
    let n9 = new Node(9, null, null);
    let n1 = new Node(1, null, null);
    let n6 = new Node(6, null, null);
    n7.left = n4; n7.right=n9;
    n4.left = n1; n4.right = n6;
    console.log(traversBST(n7));
}
{
    let n5 = new Node(5, null, null);
    let n1 = new Node(1, null, null);
    let n8 = new Node(8, null, null);
    let n9 = new Node(9, null, null);
    let n12 = new Node(12, null, null);
    n5.left = n1; n5.right=n8;
    n8.left=n9; n8.right=n12;
    console.log(traversBST(n5));
}