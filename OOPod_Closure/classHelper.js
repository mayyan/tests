/**
 * Helper: closure-based. The constructor of a class directly is the common closure for private variables and methods.
 * CClass stands for Closure-Class
 * you can use this._super(...); to call the base class implementation of a function.
 *
 * http://www.ruzee.com/blog/2008/12/javascript-inheritance-via-prototypes-and-closures
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
