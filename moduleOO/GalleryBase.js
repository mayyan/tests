/*
function GalleryBase() {
    var privBaseVar = 10;

    var privBaseFunc = function() {
        console.log("Running privBaseFunc().");
    }
}
GalleryBase.prototype.constructor = GalleryBase;

GalleryBase.prototype.pubBaseVar = 20;
GalleryBase.prototype.pubSharedVar = 30;
GalleryBase.prototype.pubBaseFunc = function() {
    console.log("Running pubBaseFunc().");
};
GalleryBase.prototype.pubSharedFunc = function() {
    console.log("Running pubSharedFunc() from base.");
};
APP.gallery = new GalleryBase();
*/

(function() {
    //private
    var privBaseVar = 10;

    var privBaseFunc = function() {
        console.log("Running privBaseFunc()");
        console.log(privBaseVar++); //access base priv var
        
    };

    //constructor
    GalleryBase = function() {
        privBaseFunc(); // access base priv in contructor
    };

    GalleryBase.prototype = {
        constructor : GalleryBase,

        pubBaseVar : 20,

        pubSharedVar : 30,

        pubBaseFunc : function() {
            console.log("Running pubBaseFunc()");
            console.log(privBaseVar++); //access base priv var
            privBaseFunc(); //access base priv func
        },

        pubSharedFunc : function() {
            console.log("Running pubSharedFunc() from base.");
        }
    };
})();

