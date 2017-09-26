'use strict';

/*
    given an array of word, print a word after each second
*/

function tickerize(str) {
    let words = str.split(' ');

    for (let i = 0; i < words.length; i++) {
        (function (i) {
            setTimeout(function() {
                console.log(words[i]);
            }, i * 1000);
        })(i);
    }
}

function tickerize2(str) {
    let words = str.split(' ');

    for (let i = 0; i < words.length; i++) {

        setTimeout(function() {
            console.log(words[i]);
        }, i * 1000);

    }
}

tickerize('hello world word1 word2 word3');
tickerize2('hello world word1 word2 word3');

/*
You may think the output is
hello
world
word1
word2
word3
hello
world
word1
word2
word3

This is the actual result
hello
hello
world
world
word1
word1
word2
word2
word3
word3
*/
