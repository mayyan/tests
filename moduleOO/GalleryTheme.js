/*
function GalleryTheme() {

    var privThemeVar = 100;

    var privThemeFunc = function() {
        console.log("Running privThemeFunc().");
        return this.privThemeVar + this.pubBaseVar + this.pubSharedVar; // access base pub var
    }
}
GalleryTheme.prototype = new GalleryBase(); //inherit from BaseModule

GalleryTheme.prototype.pubThemeVar = 200;  // define new theme pub var
GalleryTheme.prototype.pubSharedVar = 300; //override base pub var
GalleryTheme.prototype.pubThemeFuncNew = function() {
    console.log("Running pubThemeFuncNew().");

    this.pubBaseVar++;    // access base pub var
    this.pubSharedVar++;  // access overriden var

    this.pubBaseFunc();   // access base pub func
    this.pubSharedFunc(); // access theme overriding func
};
GalleryTheme.prototype.pubSharedFunc = function() {
    console.log("Running pubSharedFunc() from theme.");
    this.privBaseVar++; // access base priv var, error!
    this.privBaseFunc(); // access base priv func, error!
    this.privThemeFunc();
    this.pubBaseFunc(); // access base pub func
};
APP.gallery = new GalleryTheme();
*/

(function() {
    //private
    var privThemeVar = 100;

    var privThemeFunc = function(scope) {
        console.log("Running privThemeFunc().");
        console.log(privThemeVar + scope.pubBaseVar + scope.pubSharedVar); // access base pub var
    }

    //constructor
    GalleryTheme = function() {};
    GalleryTheme.prototype = new GalleryBase(); //inherit from BaseModule

    
    GalleryTheme.prototype.pubThemeVar = 200;  // define new theme pub var
    GalleryTheme.prototype.pubSharedVar = 300; //override base pub var

    // extend from base
    GalleryTheme.prototype.pubThemeFuncNew = function() {
        console.log("Running pubThemeFuncNew().");

        console.log(this.pubBaseVar++);    // access base pub var
        console.log(this.pubSharedVar++);  // access overriden var

        this.pubBaseFunc();   // access base pub func
        this.pubSharedFunc(); // access theme overriding func
    };

    // override base
    GalleryTheme.prototype.pubSharedFunc = function() {
        console.log("Running pubSharedFunc() from theme.");
        //this.privBaseVar++; // access base priv var, error!
        //this.privBaseFunc(); // access base priv func, error!
        privThemeFunc(this);
        this.pubBaseFunc(); // access base pub func
    };
})();

