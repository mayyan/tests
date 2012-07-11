/*
** This is a javascript implementation of Peter Norvig's Python 21liner
Spelling
corrector program.
** See the details here http://norvig.com/spellcorrect.
html
** Find below a verbatim ( as much as possible) translation of the python code
into Javascript.
** I have retained the same function names as the original python version for easy
readability.
**
** NOTE : Edit Distance of 2 performs very badly in Javascript and hence has been
commented.
** If you still need it, please uncomment the same. There are other warts
as well and
** have been commented in the code.
**
** Feel free to rewrite, use, distribute etc without any attribution to me.
** But please quote Norvig's URL given above and credits to the Javascript
implementation of Levenshtein Distance.
**
** author : sathya288@yahoo.com
** http://nullpointers.wordpress.com
**
*/
/*
** javascript implementation of Levenshtie Distance
** http://www.mgilleland.com/ld/ldjavascriptsource.htm
**
*/
var dG = new Array();
function Minimum(a, b, c) {
var mi;
mi = a;
if (b < mi)
mi = b;
if (c < mi)
mi = c;
return mi;
}
function LD(s, t) {
var d = new Array();
var n; // length of s
var m; // length of t
var i; // iterates through s
var j; // iterates through t
var s_i; // ith character of s
var t_j; // jth character of t
var cost; // cost
// Step 1
n = s.length;
m = t.length;
if (n == 0) {
return m;
}
if (m == 0) {
return n;
}
//inicjacja tablicy dwuwymiarowej w Javascript
for(i=0; i<=n; i++)
d[i] = new Array();
// Step 2
for (i = 0; i <= n; i++) {
d[i][0] = i;
}
for (j = 0; j <= m; j++) {
d[0][j] = j;
}
// Step 3
for (i = 1; i <= n; i++) {
s_i = s.charAt(i - 1);
// Step 4
for (j = 1; j <= m; j++) {
t_j = t.charAt(j- 1);
// Step 5
if (s_i == t_j) {
cost = 0;
}
else {
cost = 1;
}
// Step 6
d[i][j] = Minimum (d[i1][
j]+1, d[i][j1]+
1, d[i1]
[j1]
+ cost);
}
}
//przepisanie do tablicy globalnej
for(i=1; i<=n; i++) {
dG[i] = new Array();
for(j=1; j<=m; j++)
dG[i][j] = d[i][j];
}
// Step 7
return d[n][m];
}
/*
** In client side javascript there is no way to load text files from disc.
** Ofcourse, Javascript is not meant for heavy duty text processing.
** But you can provide simple spellcheck with a limited corpus of words.
** Note that you can use Ajax techniques to fetch the corpus from a server.
**
** An alternative could be to use the preprocessed frequencies.
** The frequency data for Brown's corpus can be found at
http://www.mediafire.com/?sharekey=5cacc0942f2ed052d2db6fb9a8902bda
** Thanks to Dante for sharing this http://
nullpointers.wordpress.com/2008/08/28/javascriptspellchecker/#
comment43
*/
var textdump="Please put your corpus of correct words here";
function words(text){
return text.toLowerCase().match(/[az]+/g);
}
function train(features){
model = {};
for (f in features )
if (model[features[f]]) model[features[f]] = 1;
else model[features[f]] += 1;
return model;
}
NWORDS = train(words(textdump));
alphabet = 'abcdefghijklmnopqrstuvwxyz';
function edits1(word){
result ={};
var n = word.length;
for ( i=0; i<n; i++)
result[word.slice(0,i)+word.slice(i+1)] = 1; //deletion
for ( i=0; i<n-1;
i++)
result[word.slice(0,i)+word.charAt(i+1) + word.charAt(i) +word.slice(i+2)] =
1; // transposition
for ( i=0; i<n; i++)
for( c in alphabet)
result[word.slice(0,i)+ alphabet[c] + word.slice(i+1)] = 1;
//alteration
for ( i=0; i<n+1; i++)
for (c in alphabet)
result[word.slice(0,i)+alphabet[c]+word.charAt(i)+word.slice(i+1)] = 1;
//insertion
return result;
}
//there is no equivalent of this function in Peter Norvig's code.
function wordexists(word){
for ( i in NWORDS)
if ( i == word)
return true;
return false;
}
//performs very badly. use it with caution.
function known_edits2(word){
result = {};
edts1 = edits1(word);
for ( e1 in edts1)
for ( e2 in edits1(e1))
if ( wordexists(e2))
result[e2] =1;
return result;
}
function known(words){
var result = {};
for ( w in words)
if (wordexists(w))
result[w] =1;
return result;
}
function correct(word) {
candidates = {};
temp = {};
temp[word] = 1;
for(i in known(temp))
candidates[i] = 1;
for(i in known(edits1(word)))
candidates[i] = 1;
//performance takes a real hit here.
//should you really care about Edit Distance of 2 then
//comment the two lines below.
for(i in known_edits2(word))
candidates[i] = 1;
candidates[word] = 1;
max = 0;
suggest = "";
for ( i in candidates)
if ( NWORDS[i] > max)
suggest = i;
return suggest;
}
//This version uses Levenshtein Distance
function correctLD(word) {
candidates = {};
temp = {};
temp[word] = 1;
for(i in known(temp))
candidates[i] = 1;
//get all candidates with Edit Distance <= 2
//refer http://nullpointers.wordpress.com/2008/08/28/javascriptspellchecker/#
comment45
for (wrd in NWORDS){
x = wrd.length;
y = word.length;
if (Math.abs(xy)
> 2) continue; //in this case edit distance is certainly greater than 2. so why bother.
if (LD(word, wrd) > 2) continue; //consider only upto edit distance 2. this is supposed to account for 90% cases.
candidates[wrd] = 1;
}
max = 0;
suggest = "";
for ( i in candidates)
if ( NWORDS[i] > max)
suggest = i;
return suggest;
}
//Test
// 1. by generating all possible edit distancs of 1 & 2.
document.write( "Did you mean " + correct("worlb") + " ?");
// 2. using Levenshtein Distance Much more performant. Recommended.
document.write( "Did you mean " + correctLD("worlb") + " ?");