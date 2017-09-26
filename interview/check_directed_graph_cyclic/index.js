'user strict';

/*
    detect a cycle in a directed graph.
*/

class Graph {
    constructor(n, edges) {
        this.numberOfNodes = n;
        this.edges = edges;
    }

    getSmallestChildOf(n) {
        let res = this.numberOfNodes;

        for(let e = 0; e < this.edges.length; e++) {
            if (this.edges[e][0] == n) {
                let next = this.edges[e][1];
                if (next <= res) {
                    res = next;
                }
            }
        }
        // console.log(`Smallest child of ${n} is ${res}.`);
        return res; // this.numberOfNodes, or n(self), or between 0 to (this.numberOfNodes - 1)
    }

    isCyclicStartingFrom(x) {
        let path = [x];
        let next = this.getSmallestChildOf(x);
        while (next < this.numberOfNodes) {
            if (next == x) { // child is self, of course cyclic
                // console.log(path);
                return true;
            } else { // child is a diff number
                if (path.indexOf(next) < 0) { // not in the path
                    path.push(next);
                    next = this.getSmallestChildOf(next);
                } else { // already in the path
                    // console.log(path);
                    return true;
                }
            }
        }

        // no more child
        // console.log(path);
        return false;
    }

    isCyclic() {
        for (let n = 0; n < this.numberOfNodes; n++) {
            if (this.isCyclicStartingFrom(n)) {
                return true;
            }
        }

        return false;
    }

}

function test(graph, answer) {
    let res = graph.isCyclic();
    if (res == answer) {
        console.log(`PASS: ${graph.edges} is cyclic: ${graph.isCyclic()}`);
    } else {
        console.log(`FAIL: ${graph.edges} is cyclic: ${graph.isCyclic()}. Expect ${answer}`);
    }
}

{
    let graph = new Graph(4, [[0,1], [0,2], [1,2], [2,0], [2,3], [3,3]]);
    test(graph, true);
}
{
    let graph = new Graph(4, [[0,1], [1,2], [2,3], [3,0]]);
    test(graph, true);
}
{
    let graph = new Graph(4, [[0,1], [1,2], [2,3]]);
    test(graph, false);
}
{
    let graph = new Graph(4, [[0,1], [1,2], [2,3], [0,2]]);
    test(graph, false);
}
{
    let graph = new Graph(2, [[0,1], [1,0]]);
    test(graph, true);
}
{
    let graph = new Graph(1, [[0,0], [0,0]]);
    test(graph, true);
}