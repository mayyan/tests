/**
 * Helper: closure-based. The constructor of a class directly is the common closure for private variables and methods.
 * CClass stands for Closure-Class
 * you can use this._super(...); to call the base class implementation of a function.
 *
 * http://www.ruzee.com/blog/2008/12/javascript-inheritance-via-prototypes-and-closures
 * On that page, two machanisms were introduced: prototype-based and closure-based.
 * "The advantages of using the prototype approach is speed and a low memory usage.
 * The disadvantage is that private variables and functions cannot be shared between public methods since there's no way to create a common closure."
 * The disadvantage is bad enough for us not to choose prototype-based machanism.
 */
(function(){
  CClass = function(){};
  CClass.create = function(constructor) {
    var k = this;
    c = function() {
      this._super = k;
      var pubs = constructor.apply(this, arguments), self = this;
      for (key in pubs) (function(fn, sfn) {
        self[key] = typeof fn != "function" || typeof sfn != "function" ? fn :
          function() { this._super = sfn; return fn.apply(this, arguments); };
      })(pubs[key], self[key]);
    };
    c.prototype = new this;
    c.prototype.constructor = c;
    c.extend = this.extend || this.create;
    return c;
  };
})();
