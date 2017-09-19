/*
    multiple logs
    each log is sorted by time
    print out overall sorted log entries
*/

function printMultiLogs(F) {
    const MAX = 100;
    let res = [];
    let done = 0;
    while (done < F.length) {

        let min = MAX;
        let minFile = 0;
        let j = 0;
        
        while (j < F.length) {
            if (F[j].length > 0) {
                if (F[j][0] < min) {
                    min = F[j][0];
                    minFile = j;
                }
            } else {
                done++;
                if (done == F.length) {
                    return res;
                }
            }
            j++;
        }

        F[minFile].splice(0,1);
        res.push(min);
        
        done = 0;
    }
    return res;
}

function test(F, answer) {
    let res = printMultiLogs(F);
    if (res == answer) {
        console.log(`PASS: [${F}], '${res}'.`);
    } else {
        console.log(`FAIL: [${F}], '${res}', EXPECT '${answer}'.`);
    }
}

test([[1,4, 12, 13],[2,5, 11], [3,8], [6,10,14,15,16], [7,9],[17]], '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17');