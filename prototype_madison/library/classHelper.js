/**
 * Helper: prototypal-based. init is the constructor of a PClass (which stands for "Prototype-Class").
 * The parameters you pass to a new Xxx(...); call will be passed on to this init method.
 * PClass stands for Prototype-Class
 * you can use this._super(...); to call the base class implementation of a function.
 *
 * http://www.ruzee.com/blog/2008/12/javascript-inheritance-via-prototypes-and-closures
 */
(function(){
  var isFn = function(fn) { return typeof fn == "function"; };
  PClass = function(){};
  PClass.create = function(proto) {
    var k = function(magic) { // call init only if there's no magic cookie
      if (magic != isFn && isFn(this.init)) this.init.apply(this, arguments);
    };
    k.prototype = new this(isFn); // use our private method as magic cookie
    for (key in proto) (function(fn, sfn){ // create a closure
      k.prototype[key] = !isFn(fn) || !isFn(sfn) ? fn : // add _super method
        function() { this._super = sfn; return fn.apply(this, arguments); };
    })(proto[key], k.prototype[key]);
    k.prototype.constructor = k;
    k.extend = this.extend || this.create;
    return k;
  };
})();
