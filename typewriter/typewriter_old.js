function Typewriter(elem) {

	var _element = elem,
	    _span1,
		_span2,
		_span3;
	
	
	
	function _onWebkitTransitionEnd(event) {
		console.log("_onWebkitTransitionEnd()");
		
		//after animated, move the only letter in span2 to span1, and clean span2
		_span1.firstChild.nodeValue += _span2.firstChild.nodeValue;
		
		//clean span2
		_span2.firstChild.nodeValue = "";
		_span2.style.opacity = 0;
		_span2.style.webkitTransition= "";
		_span2.removeEventListener("webkitTransitionEnd");
		
		//move first letter in span3 to span2
		if (_span3.firstChild.nodeValue.length > 0) {
			//move first letter in span3 to span2
			_span2.firstChild.nodeValue = _span3.firstChild.nodeValue.substring(0, 1);
			_span3.firstChild.nodeValue = _span3.firstChild.nodeValue.substring(1);
		
			//animate span2
			_span2.style.webkitTransition= "opacity 0.2s linear";
			_span2.style.opacity = 1;
			_span2.addEventListener("webkitTransitionEnd", _onWebkitTransitionEnd, false);
		}
	}
	
	this.init = function() {
		var text = _element.innerText; //save the original text
			
		//clear text
		_element.innerText = "";
		
		//split text into 3 span.
		//span1 is the text already typed
		_span1 = document.createElement("span");
		_span1.appendChild(document.createTextNode(""));
		_element.insertBefore(_span1);
		
		//span2 is the text being typed
		_span2 = document.createElement("span");
		_span2.appendChild(document.createTextNode(""));
		_span2.style.opacity = 0;
		_element.insertBefore(_span2);
		
		//span3 is the text not typed
		_span3 = document.createElement("span");
		_span3.appendChild(document.createTextNode(text));
		_span3.style.display = "none";
		_element.insertBefore(_span3);
		
		if (_span3.firstChild.nodeValue.length > 0) {
			//move first letter in span3 to span2
			_span2.firstChild.nodeValue = _span3.firstChild.nodeValue.substring(0, 1);
			_span3.firstChild.nodeValue = _span3.firstChild.nodeValue.substring(1);
		
			//animate span2
			_span2.addEventListener("webkitTransitionEnd", _onWebkitTransitionEnd, false);
			_span2.style.webkitTransition= "opacity 0.2s linear";
			_span2.style.opacity = 1;
			
		}
	};
}

var paragraph = document.getElementById("paragraph"),
	typewriter = new Typewriter(paragraph);
	
window.onload = typewriter.init();