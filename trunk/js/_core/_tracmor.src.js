///////////////////////////////////////////////////
// The Qcodo Object is used for everything in Qcodo
///////////////////////////////////////////////////

	var qcodo = {
		initialize: function() {

		////////////////////////////////
		// Browser-related functionality
		////////////////////////////////

			this.isBrowser = function(intBrowserType) {
				return (intBrowserType & qcodo._intBrowserType);
			};
			this.IE = 1;
			this.IE_6_0 = 2;
			this.IE_7_0 = 4;

			this.FIREFOX = 8;
			this.FIREFOX_1_0 = 16;
			this.FIREFOX_1_5 = 32;
			this.FIREFOX_2_0 = 64;

			this.SAFARI = 128;
			this.SAFARI_2_0 = 256;
			this.SAFARI_3_0 = 512;

			this.MACINTOSH = 1024;

			this.UNSUPPORTED = 2048;

			// INTERNET EXPLORER (supporting versions 6.0 and 7.0)
			if (navigator.userAgent.toLowerCase().indexOf("msie") >= 0) {
				this._intBrowserType = this.IE;

				if (navigator.userAgent.toLowerCase().indexOf("msie 6.0") >= 0)
					this._intBrowserType = this._intBrowserType | this.IE_6_0;
				else if (navigator.userAgent.toLowerCase().indexOf("msie 7.0") >= 0)
					this._intBrowserType = this._intBrowserType | this.IE_7_0;
				else
					this._intBrowserType = this._intBrowserType | this.UNSUPPORTED;

			// FIREFOX (supporting versions 1.0, 1.5 and 2.0)
			} else if ((navigator.userAgent.toLowerCase().indexOf("firefox") >= 0) || (navigator.userAgent.toLowerCase().indexOf("iceweasel") >= 0)) {
				this._intBrowserType = this.FIREFOX;
				var strUserAgent = navigator.userAgent.toLowerCase();
				strUserAgent = strUserAgent.replace('iceweasel/', 'firefox/');

				if (strUserAgent.indexOf("firefox/1.0") >= 0)
					this._intBrowserType = this._intBrowserType | this.FIREFOX_1_0;
				else if (strUserAgent.indexOf("firefox/1.5") >= 0)
					this._intBrowserType = this._intBrowserType | this.FIREFOX_1_5;
				else if (strUserAgent.indexOf("firefox/2.0") >= 0)
					this._intBrowserType = this._intBrowserType | this.FIREFOX_2_0;
				else
					this._intBrowserType = this._intBrowserType | this.UNSUPPORTED;

			// SAFARI (supporting version 2.0 and eventually 3.0)
			} else if (navigator.userAgent.toLowerCase().indexOf("safari") >= 0) {
				this._intBrowserType = this.SAFARI;
				
				if (navigator.userAgent.toLowerCase().indexOf("safari/41") >= 0)
					this._intBrowserType = this._intBrowserType | this.SAFARI_2_0;
				else if (navigator.userAgent.toLowerCase().indexOf("safari/52") >= 0)
					this._intBrowserType = this._intBrowserType | this.SAFARI_3_0;
				else
					this._intBrowserType = this._intBrowserType | this.UNSUPPORTED;

			// COMPLETELY UNSUPPORTED
			} else
				this._intBrowserType = this.UNSUPPORTED;

			// MACINTOSH?
			if (navigator.userAgent.toLowerCase().indexOf("macintosh") >= 0)
				this._intBrowserType = this._intBrowserType | this.MACINTOSH;



		////////////////////////////////
		// Browser-related functionality
		////////////////////////////////

			this.loadJavaScriptFile = function(strScript, objCallback) {
				strScript = qc.jsAssets + "/" + strScript;
				var objNewScriptInclude = document.createElement("script");
				objNewScriptInclude.setAttribute("type", "text/javascript");
				objNewScriptInclude.setAttribute("src", strScript);
				document.getElementById(document.getElementById("Qform__FormId").value).appendChild(objNewScriptInclude);

				// IE does things differently...
				if (qc.isBrowser(qcodo.IE)) {
					objNewScriptInclude.callOnLoad = objCallback;
					objNewScriptInclude.onreadystatechange = function() {
						if ((this.readyState == "complete") || (this.readyState == "loaded"))
							if (this.callOnLoad)
								this.callOnLoad();
					};

				// ... than everyone else
				} else {
					objNewScriptInclude.onload = objCallback;
				};
			};

			this.loadStyleSheetFile = function(strStyleSheetFile, strMediaType) {
				// IE does things differently...
				if (qc.isBrowser(qcodo.IE)) {
					var objNewScriptInclude = document.createStyleSheet(strStyleSheetFile);

				// ...than everyone else
				} else {
					var objNewScriptInclude = document.createElement("style");
					objNewScriptInclude.setAttribute("type", "text/css");
					objNewScriptInclude.setAttribute("media", strMediaType);
					objNewScriptInclude.innerHTML = '@import "' + strStyleSheetFile + '";';
					document.body.appendChild(objNewScriptInclude);
				};
			};



		/////////////////////////////
		// QForm-related functionality
		/////////////////////////////

			this.registerForm = function() {
				// "Lookup" the QForm's FormId
				var strFormId = document.getElementById("Qform__FormId").value;

				// Register the Various Hidden Form Elements needed for QForms
				this.registerFormHiddenElement("Qform__FormControl", strFormId);
				this.registerFormHiddenElement("Qform__FormEvent", strFormId);
				this.registerFormHiddenElement("Qform__FormParameter", strFormId);
				this.registerFormHiddenElement("Qform__FormCallType", strFormId);
				this.registerFormHiddenElement("Qform__FormUpdates", strFormId);
				this.registerFormHiddenElement("Qform__FormCheckableControls", strFormId);
			};

			this.registerFormHiddenElement = function(strId, strFormId) {
				var objHiddenElement = document.createElement("input");
				objHiddenElement.type = "hidden";
				objHiddenElement.id = strId;
				objHiddenElement.name = strId;
				document.getElementById(strFormId).appendChild(objHiddenElement);
			};

			this.wrappers = new Array();



		////////////////////////////////////
		// Mouse Drag Handling Functionality
		////////////////////////////////////

			this.enableMouseDrag = function() {
				document.onmousedown = qcodo.handleMouseDown;
				document.onmousemove = qcodo.handleMouseMove;
				document.onmouseup = qcodo.handleMouseUp;
			};

			this.handleMouseDown = function(objEvent) {
				objEvent = qcodo.handleEvent(objEvent);

				var objHandle = qcodo.target;
				if (!objHandle) return true;

				var objWrapper = objHandle.wrapper;
				if (!objWrapper) return true;

				// Qcodo-Wide Mouse Handling Functions only operate on the Left Mouse Button
				// (Control-specific events can respond to QRightMouse-based Events)
				if (qcodo.mouse.left) {
					if (objWrapper.handleMouseDown) {
						// Specifically for Microsoft IE
						if (objHandle.setCapture)
							objHandle.setCapture();

						// Ensure the Cleanliness of Dragging
						objHandle.onmouseout = null;
						if (document.selection)
							document.selection.empty();

						qcodo.currentMouseHandleControl = objWrapper;
						return objWrapper.handleMouseDown(objEvent, objHandle);
					};
				};

				qcodo.currentMouseHandleControl = null;
				return true;
			};

			this.handleMouseMove = function(objEvent) {
				objEvent = qcodo.handleEvent(objEvent);

				if (qcodo.currentMouseHandleControl) {
					var objWrapper = qcodo.currentMouseHandleControl;
					var objHandle = objWrapper.handle;

					// In case IE accidentally marks a selection...
					if (document.selection)
						document.selection.empty();

					if (objWrapper.handleMouseMove)
						return objWrapper.handleMouseMove(objEvent, objHandle);
				};

				return true;
			};

			this.handleMouseUp = function(objEvent) {
				objEvent = qcodo.handleEvent(objEvent);

				if (qcodo.currentMouseHandleControl) {
					var objWrapper = qcodo.currentMouseHandleControl;
					var objHandle = objWrapper.handle;

					// In case IE accidentally marks a selection...
					if (document.selection)
						document.selection.empty();

					// For IE to release release/setCapture
					if (objHandle.releaseCapture) {
						objHandle.releaseCapture();
						objHandle.onmouseout = function() {this.releaseCapture()};
					};

					qcodo.currentMouseHandleControl = null;

					if (objWrapper.handleMouseUp)
						return objWrapper.handleMouseUp(objEvent, objHandle);
				};

				return true;
			};



		////////////////////////////////////
		// Window Unloading
		////////////////////////////////////

			this.unloadFlag = false;
			this.handleBeforeUnload = function() {
				qcodo.unloadFlag = true;
			};
			window.onbeforeunload = this.handleBeforeUnload;



		////////////////////////////////////
		// Color Handling Functionality
		////////////////////////////////////

			this.colorRgbValues = function(strColor) {
				strColor = strColor.replace("#", "");

				try {
					if (strColor.length == 3)
						return new Array(
							eval("0x" + strColor.substring(0, 1)),
							eval("0x" + strColor.substring(1, 2)),
							eval("0x" + strColor.substring(2, 3))
						);
					else if (strColor.length == 6)
						return new Array(
							eval("0x" + strColor.substring(0, 2)),
							eval("0x" + strColor.substring(2, 4)),
							eval("0x" + strColor.substring(4, 6))
						);
				} catch (Exception) {};

				return new Array(0, 0, 0);
			};

			this.hexFromInt = function(intNumber) {
				intNumber = (intNumber > 255) ? 255 : ((intNumber < 0) ? 0 : intNumber);
				intFirst = Math.floor(intNumber / 16);
				intSecond = intNumber % 16;
				return intFirst.toString(16) + intSecond.toString(16);
			};

			this.colorRgbString = function(intRgbArray) {
				return "#" + qcodo.hexFromInt(intRgbArray[0]) + qcodo.hexFromInt(intRgbArray[1]) + qcodo.hexFromInt(intRgbArray[2]);
			};
		}
	};



////////////////////////////////
// Qcodo Shortcut and Initialize
////////////////////////////////

	var qc = qcodo;
	qc.initialize();
////////////////////////////////
// Logging-related functionality
////////////////////////////////

	qcodo.logMessage = function(strMessage, blnReset, blnNonEscape) {
		var objLogger = qcodo.getControl("Qform_Logger");

		if (!objLogger) {
			var objLogger = document.createElement("div");
			objLogger.id = "Qform_Logger";
			objLogger.style.display = "none";
			objLogger.style.width = "400px";
			objLogger.style.backgroundColor = "#dddddd";
			objLogger.style.fontSize = "10px";
			objLogger.style.fontFamily = "lucida console, courier, monospaced";
			objLogger.style.padding = "6px";
			objLogger.style.overflow = "auto";

			if (qcodo.isBrowser(qcodo.IE))
				objLogger.style.filter = "alpha(opacity=50)";
			else
				objLogger.style.opacity = 0.5;

			document.body.appendChild(objLogger);
		};

		if (!blnNonEscape)
			if (strMessage.replace)
				strMessage = strMessage.replace(/</g, '&lt;');

		var strPosition = "fixed";
		var strTop = "0px";
		var strLeft = "0px";
		if (qcodo.isBrowser(qcodo.IE)) {
			// IE doesn't support position:fixed, so manually set positioning
			strPosition = "absolute";
			strTop = qcodo.scroll.y + "px";
			strLeft = qcodo.scroll.x + "px";
		};

		objLogger.style.position = strPosition;
		objLogger.style.top = strTop;
		objLogger.style.left = strLeft;
		objLogger.style.height = (qcodo.client.height - 100) + "px";
		objLogger.style.display = 'inline';

		var strHeader = '<a href="javascript:qcodo.logRemove()">Remove</a><br/><br/>';

		if (blnReset)
			objLogger.innerHTML = strHeader + strMessage + "<br/>";
		else if (objLogger.innerHTML == "")
			objLogger.innerHTML = strHeader + strMessage + "<br/>";
		else
			objLogger.innerHTML += strMessage + "<br/>";
	};

	qcodo.logRemove = function() {
		var objLogger = qcodo.getControl('Qform_Logger');
		if (objLogger)
			objLogger.style.display = 'none';
	};

	qcodo.logEventStats = function(objEvent) {
		objEvent = qcodo.handleEvent(objEvent);

		var strMessage = "";
		strMessage += "scroll (x, y): " + qcodo.scroll.x + ", " + qcodo.scroll.y + "<br/>";
		strMessage += "scroll (width, height): " + qcodo.scroll.width + ", " + qcodo.scroll.height + "<br/>";
		strMessage += "client (x, y): " + qcodo.client.x + ", " + qcodo.client.y + "<br/>";
		strMessage += "client (width, height): " + qcodo.client.width + ", " + qcodo.client.height + "<br/>";
		strMessage += "page (x, y): " + qcodo.page.x + ", " + qcodo.page.y + "<br/>";
		strMessage += "page (width, height): " + qcodo.page.width + ", " + qcodo.page.height + "<br/>";
		strMessage += "mouse (x, y): " + qcodo.mouse.x + ", " + qcodo.mouse.y + "<br/>";
		strMessage += "mouse (left, middle, right): " + qcodo.mouse.left + ", " + qcodo.mouse.middle + ", " + qcodo.mouse.right + "<br/>";
		strMessage += "key (alt, shift, control, code): " + qcodo.key.alt + ", " + qcodo.key.shift + ", " +
			qcodo.key.control + ", " + qcodo.key.code;

		qcodo.logMessage("Event Stats", true);
		qcodo.logMessage(strMessage, false, true);
	};

	qcodo.logObject = function(objObject) {
		var strDump = "";

		for (var strKey in objObject) {
			var strData = objObject[strKey];

			strDump += strKey + ": ";
			if (typeof strData == 'function')
				strDump += "&lt;FUNCTION&gt;";
			else if (typeof strData == 'object')
				strDump += "&lt;OBJECT&gt;";
			else if ((strKey == 'outerText') || (strKey == 'innerText') || (strKey == 'outerHTML') || (strKey == 'innerHTML'))
				strDump += "&lt;TEXT&gt;";
			else
				strDump += strData;
			strDump += "<br/>";
		};

		qcodo.logMessage("Object Stats", true);
		qcodo.logMessage(strDump, false, true);
	};///////////////////////////////
// Timers-related functionality
///////////////////////////////

	qcodo._objTimers = new Object();

	qcodo.clearTimeout = function(strTimerId) {
		if (qcodo._objTimers[strTimerId]) {
			clearTimeout(qcodo._objTimers[strTimerId]);
			qcodo._objTimers[strTimerId] = null;
		};
	};

	qcodo.setTimeout = function(strTimerId, strAction, intDelay) {
		qcodo.clearTimeout(strTimerId);
		qcodo._objTimers[strTimerId] = setTimeout(strAction, intDelay);
	};



/////////////////////////////////////
// Event Object-related functionality
/////////////////////////////////////

	qcodo.handleEvent = function(objEvent) {
		objEvent = (objEvent) ? objEvent : ((typeof(event) == "object") ? event : null);

		if (objEvent) {
			if (typeof(objEvent.clientX) != "undefined") {
				if (qcodo.isBrowser(qcodo.SAFARI)) {
					qcodo.mouse.x = objEvent.clientX - window.document.body.scrollLeft;
					qcodo.mouse.y = objEvent.clientY - window.document.body.scrollTop;
					qcodo.client.x = objEvent.clientX - window.document.body.scrollLeft;
					qcodo.client.y = objEvent.clientY - window.document.body.scrollTop;
				} else {
					qcodo.mouse.x = objEvent.clientX;
					qcodo.mouse.y = objEvent.clientY;
					qcodo.client.x = objEvent.clientX;
					qcodo.client.y = objEvent.clientY;
				};
			};

			if (qcodo.isBrowser(qcodo.IE)) {
				qcodo.mouse.left = ((objEvent.button & 1) ? true : false);
				qcodo.mouse.right = ((objEvent.button & 2) ? true : false);
				qcodo.mouse.middle = ((objEvent.button & 4) ? true : false);
			} else if (qcodo.isBrowser(qcodo.SAFARI)) {
				qcodo.mouse.left = ((objEvent.button && !objEvent.ctrlKey) ? true : false);
				qcodo.mouse.right = ((objEvent.button && objEvent.ctrlKey) ? true : false);
				qcodo.mouse.middle = false;
			} else {
				qcodo.mouse.left = (objEvent.button == 0);
				qcodo.mouse.right = (objEvent.button == 2);
				qcodo.mouse.middle = (objEvent.button == 1);
			};

			qcodo.key.alt = (objEvent.altKey) ? true : false;
			qcodo.key.control = (objEvent.ctrlKey) ? true : false;
			qcodo.key.shift = (objEvent.shiftKey) ? true : false;
			qcodo.key.code = (objEvent.keyCode) ? (objEvent.keyCode) : 0;
			
			if (objEvent.originalTarget)
				qcodo.target = objEvent.originalTarget;
			else if (objEvent.srcElement)
				qcodo.target = objEvent.srcElement;
			else
				qcodo.target = null;
		};
		
		/*
			qcodo.client.width = (qcodo.isBrowser(qcodo.SAFARI)) ? window.innerWidth : window.document.body.clientWidth;
			qcodo.client.height = (qcodo.isBrowser(qcodo.SAFARI)) ? window.innerHeight: window.document.body.clientHeight;

			qcodo.page.x = qcodo.mouse.x + qcodo.scroll.x;
			qcodo.page.y = qcodo.mouse.y + qcodo.scroll.y;

			qcodo.page.width = Math.max(window.document.body.scrollWidth, qcodo.client.width);
			qcodo.page.height = Math.max(window.document.body.scrollHeight, qcodo.client.height);

			qcodo.scroll.x = window.scrollX || window.document.body.scrollLeft;
			qcodo.scroll.y = window.scrollY || window.document.body.scrollTop;

			qcodo.scroll.width = window.document.body.scrollWidth - qcodo.client.width;
			qcodo.scroll.height = window.document.body.scrollHeight - qcodo.client.height;
		*/
		if (window.document.compatMode == "BackCompat") {
			qcodo.client.width = (qcodo.isBrowser(qcodo.SAFARI)) ? window.innerWidth : window.document.body.clientWidth;
			qcodo.client.height = (qcodo.isBrowser(qcodo.SAFARI)) ? window.innerHeight: window.document.body.clientHeight;

			qcodo.page.width = Math.max(window.document.body.scrollWidth, qcodo.client.width);
			qcodo.page.height = Math.max(window.document.body.scrollHeight, qcodo.client.height);

			qcodo.scroll.x = window.scrollX || window.document.body.scrollLeft;
			qcodo.scroll.y = window.scrollY || window.document.body.scrollTop;
		} else if (qcodo.isBrowser(qcodo.SAFARI)) {
			qcodo.client.width = window.innerWidth;
			qcodo.client.height = window.innerHeight;

			qcodo.page.width = Math.max(window.document.body.scrollWidth, qcodo.client.width);
			qcodo.page.height = Math.max(window.document.body.scrollHeight, qcodo.client.height);

			qcodo.scroll.x = window.scrollX || window.document.body.scrollLeft;
			qcodo.scroll.y = window.scrollY || window.document.body.scrollTop;
		} else if (qcodo.isBrowser(qcodo.IE)) {
			qcodo.client.width = window.document.documentElement.offsetWidth;
			qcodo.client.height = window.document.documentElement.offsetHeight;

			qcodo.page.width = Math.max(window.document.documentElement.scrollWidth, qcodo.client.width);
			qcodo.page.height = Math.max(window.document.documentElement.scrollHeight, qcodo.client.height);

			qcodo.scroll.x = window.document.documentElement.scrollLeft;
			qcodo.scroll.y = window.document.documentElement.scrollTop;
		} else {
			if (window.scrollMaxY)
				// Take the Y Scroll Bar into account by subtracting 15 pixels
				qcodo.client.width = window.innerWidth - 15;
			else
				qcodo.client.width = window.innerWidth;

			if (window.scrollMaxX)
				// Take the X Scroll Bar into account by subtracting 15 pixels
				qcodo.client.height = window.innerHeight - 15;
			else
				qcodo.client.height = window.innerHeight;

			qcodo.page.width = window.scrollMaxX + qcodo.client.width;
			qcodo.page.height = window.scrollMaxY + qcodo.client.height;

			qcodo.scroll.x = window.scrollX;
			qcodo.scroll.y = window.scrollY;
		};

		// These Values are "By Definition"
		qcodo.page.x = qcodo.mouse.x + qcodo.scroll.x;
		qcodo.page.y = qcodo.mouse.y + qcodo.scroll.y;

		qcodo.scroll.width = qcodo.page.width - qcodo.client.width;
		qcodo.scroll.height = qcodo.page.height - qcodo.client.height;

		return objEvent;
	};

	qcodo.terminateEvent = function(objEvent) {
		objEvent = qcodo.handleEvent(objEvent);

		if (objEvent) {
			// Stop Propogation
			if (objEvent.preventDefault)
				objEvent.preventDefault();
			if (objEvent.stopPropagation)
				objEvent.stopPropagation();
			objEvent.cancelBubble = true;
			objEvent.returnValue = false;
		};

		return false;
	};



///////////////////////////////
// Event Stats-Releated Objects
///////////////////////////////

	qcodo.key = {
		control: false,
		alt: false,
		shift: false,
		code: null
	};

	qcodo.mouse = {
		x: 0,
		y: 0,
		left: false,
		middle: false,
		right: false
	};

	qcodo.client = {
		x: null,
		y: null,
		width: null,
		height: null
//		width: (qcodo.isBrowser(qcodo.IE)) ? window.document.body.clientWidth : window.innerWidth,
//		height: (qcodo.isBrowser(qcodo.IE)) ? window.document.body.clientHeight : window.innerHeight
	};

	qcodo.page = {
		x: null,
		y: null,
		width: null,
		height: null
//		width: window.document.body.scrollWidth,
//		height: window.document.body.scrollHeight
	};

	qcodo.scroll = {
		x: window.scrollX || (window.document.body) ? window.document.body.scrollLeft : null,
		y: window.scrollY || (window.document.body) ? window.document.body.scrollTop : null,
//		x: null,
//		y: null,
		width: (window.document.body) ? (window.document.body.scrollWidth - qcodo.client.width) : null,
		height: (window.document.body) ? (window.document.body.scrollHeight - qcodo.client.height) : null
//		width: null,
//		height: null
	};
////////////////////////////////////////////
// PostBack and AjaxPostBack
////////////////////////////////////////////

	qcodo.postBack = function(strForm, strControl, strEvent, strParameter) {
		var objForm = document.getElementById(strForm);
		objForm.Qform__FormControl.value = strControl;
		objForm.Qform__FormEvent.value = strEvent;
		objForm.Qform__FormParameter.value = strParameter;
		objForm.Qform__FormCallType.value = "Server";
		objForm.Qform__FormUpdates.value = this.formUpdates();
		objForm.Qform__FormCheckableControls.value = this.formCheckableControls(strForm, "Server");
		objForm.submit();
	};

	qcodo.formUpdates = function() {
		var strToReturn = "";
		for (var strControlId in qcodo.controlModifications)
			for (var strProperty in qcodo.controlModifications[strControlId])
				strToReturn += strControlId + " " + strProperty + " " + qcodo.controlModifications[strControlId][strProperty] + "\n";
		qcodo.controlModifications = new Array();
		return strToReturn;
	};

	qcodo.formCheckableControls = function(strForm, strCallType) {
		var objForm = document.getElementById(strForm);
		var strToReturn = "";

		for (var intIndex = 0; intIndex < objForm.elements.length; intIndex++) {
			if (((objForm.elements[intIndex].type == "checkbox") ||
				 (objForm.elements[intIndex].type == "radio")) &&
				((strCallType == "Ajax") ||
				(!objForm.elements[intIndex].disabled))) {

				// CheckBoxList
				if (objForm.elements[intIndex].id.indexOf('[') >= 0) {
					if (objForm.elements[intIndex].id.indexOf('[0]') >= 0)
						strToReturn += " " + objForm.elements[intIndex].id.substring(0, objForm.elements[intIndex].id.length - 3);

				// RadioButtonList
				} else if (objForm.elements[intIndex].id.indexOf('_') >= 0) {
					if (objForm.elements[intIndex].id.indexOf('_0') >= 0)
						strToReturn += " " + objForm.elements[intIndex].id.substring(0, objForm.elements[intIndex].id.length - 2);

				// Standard Radio or Checkbox
				} else {
					strToReturn += " " + objForm.elements[intIndex].id;
				};
			};
		};

		if (strToReturn.length > 0)
			return strToReturn.substring(1);
		else
			return "";
	};

	qcodo.ajaxQueue = new Array();

	qcodo.postAjax = function(strForm, strControl, strEvent, strParameter, strWaitIconControlId) {
		// alert(strForm + " " + strControl + " " + strEvent + " " + strParameter);

		// Figure out if Queue is Empty
		var blnQueueEmpty = false;
		if (qcodo.ajaxQueue.length == 0)
			blnQueueEmpty = true;

		// Enqueue the AJAX Request
		qcodo.ajaxQueue.push(new Array(strForm, strControl, strEvent, strParameter, strWaitIconControlId));

		// If the Queue was originally empty, call the Dequeue
		if (blnQueueEmpty)
			qcodo.dequeueAjaxQueue();
	};
	
	qcodo.clearAjaxQueue = function() {
		qcodo.ajaxQueue = new Array();
	};

	qcodo.objAjaxWaitIcon = null;

	qcodo.dequeueAjaxQueue = function() {
		if (qcodo.ajaxQueue.length > 0) {
			strForm = this.ajaxQueue[0][0];
			strControl = this.ajaxQueue[0][1];
			strEvent = this.ajaxQueue[0][2];
			strParameter = this.ajaxQueue[0][3];
			strWaitIconControlId = this.ajaxQueue[0][4];

			// Display WaitIcon (if applicable)
			if (strWaitIconControlId) {
				this.objAjaxWaitIcon = this.getWrapper(strWaitIconControlId);
				if (this.objAjaxWaitIcon)
					this.objAjaxWaitIcon.style.display = 'inline';
			};

			var objForm = document.getElementById(strForm);
			objForm.Qform__FormControl.value = strControl;
			objForm.Qform__FormEvent.value = strEvent;
			objForm.Qform__FormParameter.value = strParameter;
			objForm.Qform__FormCallType.value = "Ajax";
			objForm.Qform__FormUpdates.value = qcodo.formUpdates();
			objForm.Qform__FormCheckableControls.value = this.formCheckableControls(strForm, "Ajax");

			var strPostData = "";
			for (var i = 0; i < objForm.elements.length; i++) {
				switch (objForm.elements[i].type) {
					case "checkbox":
					case "radio":
						if (objForm.elements[i].checked) {
							var strTestName = objForm.elements[i].name + "_";
							if (objForm.elements[i].id.substring(0, strTestName.length) == strTestName)
								strPostData += "&" + objForm.elements[i].name + "=" + objForm.elements[i].id.substring(strTestName.length);
							else
//								strPostData += "&" + objForm.elements[i].id + "=" + "1";
								strPostData += "&" + objForm.elements[i].id + "=" + objForm.elements[i].value;
						};
						break;

					case "select-multiple":
						var blnOneSelected = false;
						for (var intIndex = 0; intIndex < objForm.elements[i].options.length; intIndex++)
							if (objForm.elements[i].options[intIndex].selected) {
								strPostData += "&" + objForm.elements[i].name + "=";
								strPostData += objForm.elements[i].options[intIndex].value;
							};
						break;

					default:
						strPostData += "&" + objForm.elements[i].id + "=";

						// For Internationalization -- we must escape the element's value properly
						var strPostValue = objForm.elements[i].value;
						if (strPostValue) {
							strPostValue = strPostValue.replace(/\%/g, "%25");
							strPostValue = strPostValue.replace(/&/g, escape('&'));
							strPostValue = strPostValue.replace(/\+/g, "%2B");
						};
						strPostData += strPostValue;
						break;
				};
			};

			var strUri = objForm.action;

			var objRequest;
			if (window.XMLHttpRequest) {
				objRequest = new XMLHttpRequest();
			} else if (typeof ActiveXObject != "undefined") {
				objRequest = new ActiveXObject("Microsoft.XMLHTTP");
			};

			if (objRequest) {
				objRequest.open("POST", strUri, true);
				objRequest.setRequestHeader("Method", "POST " + strUri + " HTTP/1.1");
				objRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

				objRequest.onreadystatechange = function() {
					if (!qcodo.unloadFlag && objRequest.readyState == 4) {
						try {
							var objXmlDoc = objRequest.responseXML;
//								qcodo.logMessage(objRequest.responseText, true);
//								alert('AJAX Response Received');

							if (!objXmlDoc) {
								alert("An error occurred during AJAX Response parsing.\r\n\r\nThe error response will appear in a new popup.");
								var objErrorWindow = window.open('about:blank', 'qcodo_error','menubar=no,toolbar=no,location=no,status=no,scrollbars=yes,resizable=yes,width=1000,height=700,left=50,top=50');
								objErrorWindow.focus();
								objErrorWindow.document.write(objRequest.responseText);
								return;
							} else {
								var intLength = 0;

								// Go through Controls
								var objXmlControls = objXmlDoc.getElementsByTagName('control');
								intLength = objXmlControls.length;

								for (var intIndex = 0; intIndex < intLength; intIndex++) {
									var strControlId = objXmlControls[intIndex].attributes.getNamedItem('id').nodeValue;

									var strControlHtml = "";
									if (objXmlControls[intIndex].firstChild)
										strControlHtml = objXmlControls[intIndex].firstChild.nodeValue;
									if (qcodo.isBrowser(qcodo.FIREFOX))
										strControlHtml = objXmlControls[intIndex].textContent;

									// Perform Callback Responsibility
									if (strControlId == "Qform__FormState") {
										var objFormState = document.getElementById(strControlId);
										objFormState.value = strControlHtml;							
									} else {
										var objSpan = document.getElementById(strControlId + "_ctl");
										if (objSpan)
											objSpan.innerHTML = strControlHtml;
									};
								};

								// Go through Commands
								var objXmlCommands = objXmlDoc.getElementsByTagName('command');
								intLength = objXmlCommands.length;

								for (var intIndex = 0; intIndex < intLength; intIndex++) {
									if (objXmlCommands[intIndex] && objXmlCommands[intIndex].firstChild) {
										var strCommand = "";
										intChildLength = objXmlCommands[intIndex].childNodes.length;
										for (var intChildIndex = 0; intChildIndex < intChildLength; intChildIndex++)
											strCommand += objXmlCommands[intIndex].childNodes[intChildIndex].nodeValue;
										eval(strCommand);
									};
								};
							};
						} catch (objExc) {
							alert(objExc.message + "\r\non line number " + objExc.lineNumber + "\r\nin file " + objExc.fileName);
							alert("An error occurred during AJAX Response handling.\r\n\r\nThe error response will appear in a new popup.");
							var objErrorWindow = window.open('about:blank', 'qcodo_error','menubar=no,toolbar=no,location=no,status=no,scrollbars=yes,resizable=yes,width=1000,height=700,left=50,top=50');
							objErrorWindow.focus();
							objErrorWindow.document.write(objRequest.responseText);
							return;
						};

						// Perform the Dequeue
						qcodo.ajaxQueue.reverse();
						qcodo.ajaxQueue.pop();
						qcodo.ajaxQueue.reverse();
						
						// Hid the WaitIcon (if applicable)
						if (qcodo.objAjaxWaitIcon)
							qcodo.objAjaxWaitIcon.style.display = 'none';

						// If there are still AjaxEvents in the queue, go ahead and process/dequeue them
						if (qcodo.ajaxQueue.length > 0)
							qcodo.dequeueAjaxQueue();
					};
				};

				objRequest.send(strPostData);
			};
		};
	};



//////////////////
// Qcodo Shortcuts
//////////////////

	qc.pB = qcodo.postBack;
	qc.pA = qcodo.postAjax;
/////////////////////////////////
// Controls-related functionality
/////////////////////////////////

	qcodo.getControl = function(mixControl) {
		if (typeof(mixControl) == 'string')
			return document.getElementById(mixControl);
		else
			return mixControl;
	};

	qcodo.getWrapper = function(mixControl) {
		var objControl; if (!(objControl = qcodo.getControl(mixControl))) return;

		if (objControl)
			return this.getControl(objControl.id + "_ctl");			
		else
			return null;
	};



/////////////////////////////
// Register Control - General
/////////////////////////////
	
	qcodo.controlModifications = new Array();
	qcodo.javascriptStyleToQcodo = new Array();
	qcodo.javascriptStyleToQcodo["backgroundColor"] = "BackColor";
	qcodo.javascriptStyleToQcodo["borderColor"] = "BorderColor";
	qcodo.javascriptStyleToQcodo["borderStyle"] = "BorderStyle";
	qcodo.javascriptStyleToQcodo["border"] = "BorderWidth";
	qcodo.javascriptStyleToQcodo["height"] = "Height";
	qcodo.javascriptStyleToQcodo["width"] = "Width";
	qcodo.javascriptStyleToQcodo["text"] = "Text";

	qcodo.javascriptWrapperStyleToQcodo = new Array();
	qcodo.javascriptWrapperStyleToQcodo["position"] = "Position";
	qcodo.javascriptWrapperStyleToQcodo["top"] = "Top";
	qcodo.javascriptWrapperStyleToQcodo["left"] = "Left";

	qcodo.recordControlModification = function(strControlId, strProperty, strNewValue) {
		if (!qcodo.controlModifications[strControlId])
			qcodo.controlModifications[strControlId] = new Array();
		qcodo.controlModifications[strControlId][strProperty] = strNewValue;	
	};

	qcodo.registerControl = function(mixControl) {
		var objControl; if (!(objControl = qcodo.getControl(mixControl))) return;

		// Link the Wrapper and the Control together
		var objWrapper = this.getWrapper(objControl);
		objControl.wrapper = objWrapper;
		objWrapper.control = objControl;

		// Add the wrapper to the global qcodo wrappers array
		qcodo.wrappers[objWrapper.id] = objWrapper;


		// Create New Methods, etc.
		// Like: objWrapper.something = xyz;

		// Updating Style-related Things
		objWrapper.updateStyle = function(strStyleName, strNewValue) {
			var objControl = this.control;
			
			switch (strStyleName) {
				case "className":
					objControl.className = strNewValue;
					qcodo.recordControlModification(objControl.id, "CssClass", strNewValue);
					break;
					
				case "parent":
					if (strNewValue) {
						var objNewParentControl = qcodo.getControl(strNewValue);
						objNewParentControl.appendChild(this);
						qcodo.recordControlModification(objControl.id, "Parent", strNewValue);
					} else {
						var objParentControl = this.parentNode;
						objParentControl.removeChild(this);
						qcodo.recordControlModification(objControl.id, "Parent", "");
					};
					break;
				
				case "displayStyle":
					objControl.style.display = strNewValue;
					qcodo.recordControlModification(objControl.id, "DisplayStyle", strNewValue);
					break;

				case "display":
					if (strNewValue) {
						objWrapper.style.display = "inline";
						qcodo.recordControlModification(objControl.id, "Display", "1");
					} else {
						objWrapper.style.display = "none";
						qcodo.recordControlModification(objControl.id, "Display", "0");
					};
					break;

				case "enabled":
					if (strNewValue) {
						objWrapper.control.disabled = false;
						qcodo.recordControlModification(objControl.id, "Enabled", "1");
					} else {
						objWrapper.control.disabled = true;
						qcodo.recordControlModification(objControl.id, "Enabled", "0");
					};
					break;
					
				case "width":
				case "height":
					objControl.style[strStyleName] = strNewValue;
					if (qcodo.javascriptStyleToQcodo[strStyleName])
						qcodo.recordControlModification(objControl.id, qcodo.javascriptStyleToQcodo[strStyleName], strNewValue);
					if (objWrapper.handle)
						objWrapper.updateHandle();
					break;

				case "text":
					objControl.innerHTML = strNewValue;
					qcodo.recordControlModification(objControl.id, "Text", strNewValue);
					break;

				default:
					if (qcodo.javascriptWrapperStyleToQcodo[strStyleName]) {
						this.style[strStyleName] = strNewValue;
						qcodo.recordControlModification(objControl.id, qcodo.javascriptWrapperStyleToQcodo[strStyleName], strNewValue);
					} else {
						objControl.style[strStyleName] = strNewValue;
						if (qcodo.javascriptStyleToQcodo[strStyleName])
							qcodo.recordControlModification(objControl.id, qcodo.javascriptStyleToQcodo[strStyleName], strNewValue);
					};
					break;
			};
		};

		// Positioning-related functions

		objWrapper.getAbsolutePosition = function() {
			var intOffsetLeft = 0;
			var intOffsetTop = 0;

			var objControl = this.control;

			while (objControl) {
				// If we are IE, we don't want to include calculating
				// controls who's wrappers are position:relative
				if ((objControl.wrapper) && (objControl.wrapper.style.position == "relative")) {
					
				} else {
					intOffsetLeft += objControl.offsetLeft;
					intOffsetTop += objControl.offsetTop;
				};
				objControl = objControl.offsetParent;
			};

			return {x:intOffsetLeft, y:intOffsetTop};
		};

		objWrapper.setAbsolutePosition = function(intNewX, intNewY, blnBindToParent) {
			var objControl = this.offsetParent;

			while (objControl) {
				intNewX -= objControl.offsetLeft;
				intNewY -= objControl.offsetTop;
				objControl = objControl.offsetParent;
			};

			if (blnBindToParent) {
				if (this.parentNode.nodeName.toLowerCase() != 'form') {
					// intNewX and intNewY must be within the parent's control
					intNewX = Math.max(intNewX, 0);
					intNewY = Math.max(intNewY, 0);

					intNewX = Math.min(intNewX, this.offsetParent.offsetWidth - this.offsetWidth);
					intNewY = Math.min(intNewY, this.offsetParent.offsetHeight - this.offsetHeight);
				};
			};

			this.updateStyle("left", intNewX + "px");
			this.updateStyle("top", intNewY + "px");
		};

		objWrapper.setDropZoneMaskAbsolutePosition = function(intNewX, intNewY, blnBindToParent) {
/*
			var objControl = this.offsetParent;

			while (objControl) {
				intNewX -= objControl.offsetLeft;
				intNewY -= objControl.offsetTop;
				objControl = objControl.offsetParent;
			}

			if (blnBindToParent) {
				if (this.parentNode.nodeName.toLowerCase() != 'form') {
					// intNewX and intNewY must be within the parent's control
					intNewX = Math.max(intNewX, 0);
					intNewY = Math.max(intNewY, 0);

					intNewX = Math.min(intNewX, this.offsetParent.offsetWidth - this.offsetWidth);
					intNewY = Math.min(intNewY, this.offsetParent.offsetHeight - this.offsetHeight);
				}
			}
			
			qc.logObject(intNewX + " x " + intNewY);
*/
			this.dropZoneMask.style.left = intNewX + "px";
			this.dropZoneMask.style.top = intNewY + "px";
		};

		objWrapper.setMaskOffset = function(intDeltaX, intDeltaY) {
			var objAbsolutePosition = this.getAbsolutePosition();
			this.mask.style.left = (objAbsolutePosition.x + intDeltaX) + "px";
			this.mask.style.top = (objAbsolutePosition.y + intDeltaY) + "px";
		};

		objWrapper.containsPoint = function(intX, intY) {
			var objAbsolutePosition = this.getAbsolutePosition();
			if ((intX >= objAbsolutePosition.x) && (intX <= objAbsolutePosition.x + this.control.offsetWidth) &&
				(intY >= objAbsolutePosition.y) && (intY <= objAbsolutePosition.y + this.control.offsetHeight))
				return true;
			else
				return false;
		};

		// Toggle Display / Enabled
		objWrapper.toggleDisplay = function(strShowOrHide) {
			// Toggles the display/hiding of the entire control (including any design/wrapper HTML)
			// If ShowOrHide is blank, then we toggle
			// Otherwise, we'll execute a "show" or a "hide"
			if (strShowOrHide) {
				if (strShowOrHide == "show")
					this.updateStyle("display", true);
				else
					this.updateStyle("display", false);
			} else
				this.updateStyle("display", (this.style.display == "none") ? true : false);
		};

		objWrapper.toggleEnabled = function(strEnableOrDisable) {
			if (strEnableOrDisable) {
				if (strEnableOrDisable == "enable")
					this.updateStyle("enabled", true);
				else
					this.updateStyle("enabled", false);
			} else
				this.updateStyle("enabled", (this.control.disabled) ? true : false);
		};

		objWrapper.registerClickPosition = function(objEvent) {
			objEvent = (objEvent) ? objEvent : ((typeof(event) == "object") ? event : null);
			qcodo.handleEvent(objEvent);

			var intX = qcodo.mouse.x - this.getAbsolutePosition().x + qcodo.scroll.x;
			var intY = qcodo.mouse.y - this.getAbsolutePosition().y + qcodo.scroll.y;

			// Random IE Check
			if (qcodo.isBrowser(qcodo.IE)) {
				intX = intX - 2;
				intY = intY - 2;
			};

			document.getElementById(this.control.id + "_x").value = intX;
			document.getElementById(this.control.id + "_y").value = intY;
		};

		// Focus
		objWrapper.focus = function() {
			if (this.control.focus) {
				if (qcodo.isBrowser(qcodo.IE) && (typeof (this.control.focus) == "object"))
					this.control.focus();
				else if (typeof (this.control.focus) == "function")
					this.control.focus();
			};
		};
		
		// Blink
		objWrapper.blink = function(strFromColor, strToColor) {
			objWrapper.blinkStart = qcodo.colorRgbValues(strFromColor);
			objWrapper.blinkEnd = qcodo.colorRgbValues(strToColor);
			objWrapper.blinkStep = new Array(
				Math.round((objWrapper.blinkEnd[0] - objWrapper.blinkStart[0]) / 12.5),
				Math.round((objWrapper.blinkEnd[1] - objWrapper.blinkStart[1]) / 12.5),
				Math.round((objWrapper.blinkEnd[2] - objWrapper.blinkStart[2]) / 12.5)
			);
			objWrapper.blinkDown = new Array(
				(objWrapper.blinkStep[0] < 0) ? true : false,
				(objWrapper.blinkStep[1] < 0) ? true : false,
				(objWrapper.blinkStep[2] < 0) ? true : false
			);

			objWrapper.blinkCurrent = objWrapper.blinkStart;
			this.control.style.backgroundColor = qcodo.colorRgbString(objWrapper.blinkCurrent);
			qcodo.setTimeout(objWrapper.id, "qc.getC('" + objWrapper.id + "').blinkHelper()", 20);
		};
		
		objWrapper.blinkHelper = function() {
			objWrapper.blinkCurrent[0] += objWrapper.blinkStep[0];
			objWrapper.blinkCurrent[1] += objWrapper.blinkStep[1];
			objWrapper.blinkCurrent[2] += objWrapper.blinkStep[2];
			if (((objWrapper.blinkDown[0]) && (objWrapper.blinkCurrent[0] < objWrapper.blinkEnd[0])) ||
				((!objWrapper.blinkDown[0]) && (objWrapper.blinkCurrent[0] > objWrapper.blinkEnd[0])))
				objWrapper.blinkCurrent[0] = objWrapper.blinkEnd[0];
			if (((objWrapper.blinkDown[1]) && (objWrapper.blinkCurrent[1] < objWrapper.blinkEnd[1])) ||
				((!objWrapper.blinkDown[1]) && (objWrapper.blinkCurrent[1] > objWrapper.blinkEnd[1])))
				objWrapper.blinkCurrent[1] = objWrapper.blinkEnd[1];
			if (((objWrapper.blinkDown[2]) && (objWrapper.blinkCurrent[2] < objWrapper.blinkEnd[2])) ||
				((!objWrapper.blinkDown[2]) && (objWrapper.blinkCurrent[2] > objWrapper.blinkEnd[2])))
				objWrapper.blinkCurrent[2] = objWrapper.blinkEnd[2];

			this.control.style.backgroundColor = qcodo.colorRgbString(objWrapper.blinkCurrent);

			if ((objWrapper.blinkCurrent[0] == objWrapper.blinkEnd[0]) &&
				(objWrapper.blinkCurrent[1] == objWrapper.blinkEnd[1]) &&
				(objWrapper.blinkCurrent[2] == objWrapper.blinkEnd[2])) {
				// Done with Blink!
			} else {
				qcodo.setTimeout(objWrapper.id, "qc.getC('" + objWrapper.id + "').blinkHelper()", 20);
			};
		};
	};

	qcodo.registerControlArray = function(mixControlArray) {
		var intLength = mixControlArray.length;
		for (var intIndex = 0; intIndex < intLength; intIndex++)
			qcodo.registerControl(mixControlArray[intIndex]);
	};



//////////////////
// Qcodo Shortcuts
//////////////////

	qc.getC = qcodo.getControl;
	qc.getW = qcodo.getWrapper;
	qc.regC = qcodo.registerControl;
	qc.regCA = qcodo.registerControlArray;
/////////////////////////////////////////////
// Control: Dialog Box functionality
/////////////////////////////////////////////

	qcodo.registerDialogBox = function(mixControl, strMatteColor, intMatteOpacity, blnMatteClickable, blnAnyKeyCloses) {
		// Initialize the Event Handler
		qcodo.handleEvent();

		// Get Control/Wrapper
		var objControl; if (!(objControl = qcodo.getControl(mixControl))) return;
		var objWrapper = objControl.wrapper;

		// Setup the DialogBoxBackground (DbBg) if applicable
		var objDbBg = objWrapper.dbBg;
		if (!objDbBg) {
			var objDbBg = document.createElement("div");
			objDbBg.id = objWrapper.id + "dbbg";
			document.getElementById(document.getElementById("Qform__FormId").value).appendChild(objDbBg);

			// Setup the Object Links
			objWrapper.dbBg = objDbBg;
			objDbBg.wrapper = objWrapper;

			if (qcodo.isBrowser(qcodo.IE)) {
				var objIframe = document.createElement("iframe");
				objIframe.id = objWrapper.id + "dbbgframe";
				objIframe.style.left = "0px";
				objIframe.style.top = "0px";
				objIframe.style.position = "absolute";
				objIframe.style.filter = "alpha(opacity=0)";
				objIframe.src = "javascript: false;";
				objIframe.frameBorder = 0;
				objIframe.scrolling = "no";
				objIframe.style.zIndex = 990;
				objIframe.display = "none";
				document.getElementById(document.getElementById("Qform__FormId").value).appendChild(objIframe);
				objWrapper.dbBgFrame = objIframe;
			};
		};

		objWrapper.handleResize = function(objEvent) {
			objEvent = qcodo.handleEvent(objEvent);
			if (objEvent.target) {
				if ((objEvent.target.nodeName.toLowerCase() == 'div') || (objEvent.target.nodeName.toLowerCase() == 'span'))
					return;
			};

			// Restore from Link
			var objWrapper = qcodo.activeDialogBox;
			var objDbBg = objWrapper.dbBg;
			var objDbBgFrame = objWrapper.dbBgFrame;

			// Hide Everything
			objWrapper.style.display = "none";
			objDbBg.style.display = "none";
			if (objDbBgFrame) objDbBgFrame.style.display = "none";

			// Setup Events
			qcodo.handleEvent(objEvent);

			// Show Everything
			objWrapper.style.display = "inline";
			objDbBg.style.display = "block";
			if (objDbBgFrame) objDbBgFrame.style.display = "block";

			// DbBg Re-Setup
			objDbBg.style.width = Math.max(qcodo.page.width, qcodo.client.width) + "px";
			objDbBg.style.height = Math.max(qcodo.page.height, qcodo.client.height) + "px";
			if (objDbBgFrame) {
				objDbBgFrame.style.width = Math.max(qcodo.page.width, qcodo.client.width) + "px";
				objDbBgFrame.style.height = Math.max(qcodo.page.height, qcodo.client.height) + "px";
			};

			// Wrapper Re-Setup
			var intWidth = objWrapper.offsetWidth;
			var intHeight = objWrapper.offsetHeight;
			var intTop = Math.round((qcodo.client.height - intHeight) / 2) + qcodo.scroll.y;
			var intLeft = Math.round((qcodo.client.width - intWidth) / 2) + qcodo.scroll.x;
			objWrapper.setAbsolutePosition(intLeft, intTop);

			return true;
		};

		objWrapper.handleKeyPress = function(objEvent) {
			objEvent = qcodo.handleEvent(objEvent);
			qcodo.terminateEvent(objEvent);
			var objWrapper = qcodo.activeDialogBox;
			objWrapper.hideDialogBox();

			return false;
		};

		objWrapper.showDialogBox = function() {
			// Restore from Object Link
			var objDbBg = this.dbBg;
			var objDbBgFrame = this.dbBgFrame;

			// Hide Everything
			objWrapper.style.display = "none";
			objDbBg.style.display = "none";
			if (objDbBgFrame) objDbBgFrame.style.display = "none";

			// Setup Events
			qcodo.handleEvent();

			// Show Everything
			objDbBg.style.display = "block";
			if (objDbBgFrame) objDbBgFrame.style.display = "block";
			this.toggleDisplay("show");

			// DbBg Re-Setup
			objDbBg.style.width = Math.max(qcodo.page.width, qcodo.client.width) + "px";
			objDbBg.style.height = Math.max(qcodo.page.height, qcodo.client.height) + "px";
			if (objDbBgFrame) {
				objDbBgFrame.style.width = Math.max(qcodo.page.width, qcodo.client.width) + "px";
				objDbBgFrame.style.height = Math.max(qcodo.page.height, qcodo.client.height) + "px";
			};

			// Wrapper Re-Setup
			var intWidth = objWrapper.offsetWidth;
			var intHeight = objWrapper.offsetHeight;
			var intTop = Math.round((qcodo.client.height - intHeight) / 2) + qcodo.scroll.y;
			var intLeft = Math.round((qcodo.client.width - intWidth) / 2) + qcodo.scroll.x;
			objWrapper.setAbsolutePosition(intLeft, intTop);

			// Set Window OnResize Handling
			window.onresize = this.handleResize;
			window.onscroll = this.handleResize;
			qcodo.activeDialogBox = this;

			// If we have blnMatteClickable and blnAnyKeyCloses
			if (objWrapper.anyKeyCloses) {
				document.body.onkeypress = this.handleKeyPress;
				objWrapper.control.focus();
			};
		};

		objWrapper.hideDialogBox = function() {
			var objWrapper = this;
			if (this.id.indexOf("_ctldbbg") > 0)
				objWrapper = this.wrapper;
			objWrapper.dbBg.style.display = "none";
			if (objWrapper.dbBgFrame) objWrapper.dbBgFrame.style.display = "none";
			objWrapper.toggleDisplay("hide");

			// Unsetup OnResize Handling
			window.onresize = null;
			window.onscroll = null;

			// Unsetup KeyPress Closing
			document.body.onkeypress = null;

			// Unsetup ActiveDialogBox
			qcodo.activeDialogBox = null;
		};

		// Initial Wrapper Setup
		objWrapper.style.zIndex = 999;
		objWrapper.position = "absolute";
		objWrapper.anyKeyCloses = blnAnyKeyCloses;

		// Initial DbBg Setup
		objDbBg.style.position = "absolute";
		objDbBg.style.zIndex = 998;
		objDbBg.style.top = "0px";
		objDbBg.style.left = "0px";
		if (qcodo.isBrowser(qcodo.IE))
			objDbBg.style.overflow = "auto";
		else
			objDbBg.style.overflow = "hide";

		if (blnMatteClickable) {
			objDbBg.style.cursor = "pointer";
			objDbBg.onclick = objWrapper.hideDialogBox;
		} else {
			objDbBg.style.cursor = "url(" + qc.imageAssets + "/_core/move_nodrop.cur), auto";
			objDbBg.onclick = null;
		};

		// Background Color and Opacity
		objDbBg.style.backgroundColor = strMatteColor;
		if (qcodo.isBrowser(qcodo.IE))
			objDbBg.style.filter = "alpha(opacity=" + intMatteOpacity + ")";
		else
			objDbBg.style.opacity = intMatteOpacity / 100.0;

		// Other Random Stuff
		objDbBg.style.fontSize = "1px";
		objDbBg.innerHTML = "&nbsp;";

		// Perform a Show or Hide (depending on state)
		if (objWrapper.style.display == 'none')
			objWrapper.hideDialogBox();
		else
			objWrapper.showDialogBox();
	};


//////////////////
// Qcodo Shortcuts
//////////////////

	qc.regDB = qcodo.registerDialogBox;///////////////////////////////
// Control Handle Functionality
///////////////////////////////

	qcodo.registerControlHandle = function(mixControl, strCursor) {
		var objControl; if (!(objControl = qcodo.getControl(mixControl))) return;
		var objWrapper = objControl.wrapper;

		if (!objWrapper.handle) {
			var objHandle = document.createElement("span");
			objHandle.id = objWrapper.id + "handle";
			objWrapper.parentNode.appendChild(objHandle);

			objWrapper.handle = objHandle;
			objHandle.wrapper = objWrapper;

			if (!objWrapper.style.position) {
				// The Wrapper is not defined as Positioned Relatively or Absolutely
				// Therefore, no offsetTop/Left/Width/Height values are available on the wrapper itself
				objHandle.style.width = objWrapper.control.style.width;
				objHandle.style.height = objWrapper.control.style.height;
				objHandle.style.top = objWrapper.control.offsetTop + "px";
				objHandle.style.left = objWrapper.control.offsetLeft + "px";
			} else {
				objHandle.style.width = objWrapper.offsetWidth + "px";
				objHandle.style.height = objWrapper.offsetHeight + "px";
				objHandle.style.top = objWrapper.offsetTop + "px";
				objHandle.style.left = objWrapper.offsetLeft + "px";
			};

			objHandle.style.cursor = strCursor;
			objHandle.style.zIndex = 999;
			objHandle.style.backgroundColor = "white";
			if (qcodo.isBrowser(qcodo.IE))
				objHandle.style.filter = "alpha(opacity=0)";
			else
				objHandle.style.opacity = 0.0;
			objHandle.style.position = "absolute";
			objHandle.style.fontSize = "1px";
			objHandle.innerHTML = ".";
		};

		objWrapper.updateHandle = function(blnUpdateParent, strCursor) {
			var objHandle = this.handle;

			// Make Sure the Wrapper's Parent owns this Handle
			if (blnUpdateParent)
				this.parentNode.appendChild(objHandle);

			// Fixup Size and Positioning
			objHandle.style.top = this.offsetTop + "px";
			objHandle.style.left = this.offsetLeft + "px";
			objHandle.style.width = this.offsetWidth + "px";
			objHandle.style.height = this.offsetHeight + "px";
			
			// Update the Cursor
			if (strCursor)
				objHandle.style.cursor = strCursor;
		};
	};



//////////////////
// Qcodo Shortcuts
//////////////////

	qc.regCH = qcodo.registerControlHandle;
/////////////////////////////////////////////
// Control: Moveable functionality
/////////////////////////////////////////////

	qcodo.registerControlMoveable = function(mixControl) {
		var objControl; if (!(objControl = qcodo.getControl(mixControl))) return;
		var objWrapper = objControl.wrapper;

		objWrapper.moveable = true;
		
		// Control Handle and Mask
		objWrapper.mask = qcodo.getControl(objWrapper.id + "mask");
		if (!objWrapper.mask) {
			var objSpanElement = document.createElement('span');
			objSpanElement.id = objWrapper.id + "mask";
			objSpanElement.style.position = "absolute";
			document.getElementById(document.getElementById("Qform__FormId").value).appendChild(objSpanElement);
			objWrapper.mask = objSpanElement;
		};
		objWrapper.mask.wrapper = objWrapper;

		// Setup Mask
		objMask = objWrapper.mask;
		objMask.style.position = "absolute";
		objMask.style.zIndex = 998;
		if (qcodo.isBrowser(qcodo.IE))
			objMask.style.filter = "alpha(opacity=50)";
		else
			objMask.style.opacity = 0.5;
		objMask.style.display = "none";
		objMask.innerHTML = "";

		objMask.handleAnimateComplete = function(mixControl) {
			this.style.display = "none";
		};
	};

		// Update Absolutely-positioned children on Scroller (if applicable)
		// to fix Firefox b/c firefox uses position:absolute incorrectly
/*			if (qcodo.isBrowser(qcodo.FIREFOX) && (objControl.style.overflow == "auto"))
			objControl.onscroll = function(objEvent) {
				objEvent = qcodo.handleEvent(objEvent);
				for (var intIndex = 0; intIndex < this.childNodes.length; intIndex++) {
					if ((this.childNodes[intIndex].style) && (this.childNodes[intIndex].style.position == "absolute")) {
						if (!this.childNodes[intIndex].originalX) {
							this.childNodes[intIndex].originalX = this.childNodes[intIndex].offsetLeft;
							this.childNodes[intIndex].originalY = this.childNodes[intIndex].offsetTop;
						}

						this.childNodes[intIndex].style.left = this.childNodes[intIndex].originalX - this.scrollLeft + "px";
						this.childNodes[intIndex].style.top = this.childNodes[intIndex].originalY - this.scrollTop + "px";
					}
				}
			}*/



///////////////////////////////////////////////
// Block Control: DropZone Target Functionality
///////////////////////////////////////////////

	qcodo.registerControlDropZoneTarget = function(mixControl) {
		var objControl; if (!(objControl = qcodo.getControl(mixControl))) return;
		var objWrapper = objControl.wrapper;

		// Control Handle and Mask
		objWrapper.dropZoneMask = qcodo.getControl(objWrapper.id + "dzmask");
		if (!objWrapper.dropZoneMask) {
			//<span id="%s_ctldzmask" style="position:absolute;"><span style="font-size: 1px">&nbsp;</span></span>
			var objSpanElement = document.createElement("span");
			objSpanElement.id = objWrapper.id + "dzmask";
			objSpanElement.style.position = "absolute";

			var objInnerSpanElement = document.createElement("span");
			objInnerSpanElement.style.fontSize = "1px";
			objInnerSpanElement.innerHTML = "&nbsp;";

			objSpanElement.appendChild(objInnerSpanElement);
			
			document.getElementById(document.getElementById("Qform__FormId").value).appendChild(objSpanElement);
			objWrapper.dropZoneMask = objSpanElement;

			objWrapper.dropZoneMask.wrapper = objWrapper;

			// Setup Mask
			objMask = objWrapper.dropZoneMask;
			objMask.style.position = "absolute";
			objMask.style.top = "0px";
			objMask.style.left = "0px";
			objMask.style.borderColor = "#bb3399";
			objMask.style.borderStyle = "solid";
			objMask.style.borderWidth = "3px";
			objMask.style.display = "none";
		};
		
		objWrapper.addToDropZoneGrouping = function(strGroupingId, blnAllowSelf, blnAllowSelfParent) {
			if (!qcodo.dropZoneGrouping[strGroupingId])
				qcodo.dropZoneGrouping[strGroupingId] = new Array();
			qcodo.dropZoneGrouping[strGroupingId][this.control.id] = this;
			qcodo.dropZoneGrouping[strGroupingId]["__allowSelf"] = (blnAllowSelf) ? true : false;
			qcodo.dropZoneGrouping[strGroupingId]["__allowSelfParent"] = (blnAllowSelfParent) ? true : false;

			qcodo.registerControlDropZoneTarget(this.control);
		};

		objWrapper.removeFromDropZoneGrouping = function(strGroupingId) {
			if (!qcodo.dropZoneGrouping[strGroupingId])
				qcodo.dropZoneGrouping[strGroupingId] = new Array();
			else
				qcodo.dropZoneGrouping[strGroupingId][this.control.id] = false;
		};

		// Qcodo Shortcuts
		objWrapper.a2DZG = objWrapper.addToDropZoneGrouping;
		objWrapper.rfDZG = objWrapper.removeFromDropZoneGrouping;
	};



///////////////////////////////////
// Block Control: DropZone Grouping
///////////////////////////////////

	qcodo.dropZoneGrouping = new Array();



///////////////////////////////////////////
// Block Control: Move Handle Functionality
///////////////////////////////////////////

	qcodo.registerControlMoveHandle = function(mixControl) {				
		var objControl; if (!(objControl = qcodo.getControl(mixControl))) return;
		var objWrapper = objControl.wrapper;

		if (!objWrapper.handle) {
			qcodo.registerControlHandle(objControl, 'move');

			// Assign Event Handlers
			qcodo.enableMouseDrag();

			objWrapper.handleMouseDown = function(objEvent, objHandle) {
				// Set the Handle's MoveControls Bounding Box
				this.setupBoundingBox();

				// Calculate the offset (the top-left page coordinates of the bounding box vs. where the mouse is on the page)
				this.offsetX = qcodo.page.x - this.boundingBox.x;
				this.offsetY = qcodo.page.y - this.boundingBox.y;
				this.startDragX = qcodo.page.x;
				this.startDragY = qcodo.page.y;

				// Clear MaskReturn Timeout (if applicable)
				if (qcodo.moveHandleReset)
					qcodo.moveHandleReset.resetMasksCancel();

				// Make the Masks appear (if applicable)
				for (var strKey in this.moveControls) {
					var objMoveControl = this.moveControls[strKey];
					var objMask = objMoveControl.mask;

					var objAbsolutePosition = objMoveControl.getAbsolutePosition();

					objMask.style.display = "block";
					objMask.style.top = objAbsolutePosition.y + "px";
					objMask.style.left = objAbsolutePosition.x + "px";
					objMask.innerHTML = "";
				};

				return qcodo.terminateEvent(objEvent);
			};


			objWrapper.handleMouseMove = function(objEvent, objHandle) {
				// Do We Scroll?
				if ((qcodo.client.x <= 30) || (qcodo.client.y >= (qcodo.client.height - 30)) ||
					(qcodo.client.y <= 30) || (qcodo.client.x >= (qcodo.client.width - 30))) {
					qcodo.scrollMoveHandle = this;
					qcodo.handleScroll();
				} else {
					// Clear Handle Timeout
					qcodo.clearTimeout(objWrapper.id);

					this.moveMasks();
				};

				return qcodo.terminateEvent(objEvent);
			};


			objWrapper.handleMouseUp = function(objEvent, objHandle) {
				// Calculate Move Delta
				var objMoveDelta = this.calculateMoveDelta();
				var intDeltaX = objMoveDelta.x;
				var intDeltaY = objMoveDelta.y;

				// Stop Scrolling
				qcodo.clearTimeout(this.id);

				// Validate Drop Zone
				var objDropControl;

				if ((intDeltaX == 0) && (intDeltaY == 0)) {
					// Nothing Moved!
					objDropControl = null;
				} else {
					objDropControl = this.getDropTarget();
				};

				if (objDropControl) {
					// Update everything that's moving (e.g. all controls in qcodo.moveControls)
					for (var strKey in this.moveControls) {
						var objWrapper = this.moveControls[strKey];
						var objMask = objWrapper.mask;

						objMask.style.display = "none";
						objMask.style.cursor = null;
//						qcodo.moveControls[strKey] = null;

						objWrapper.updateStyle("position", "absolute");

						// Get Control's Position
						var objAbsolutePosition = objWrapper.getAbsolutePosition();

						// Update Parent -- Wrapper now belongs to a new DropControl
						if (objDropControl.nodeName.toLowerCase() == 'form') {
							if (objWrapper.parentNode != objDropControl)
								objWrapper.updateStyle("parent", objDropControl.id);
						} else {
							if (objDropControl.id != objWrapper.parentNode.parentNode.id)
								objWrapper.updateStyle("parent", objDropControl.control.id);
						};

						// Update Control's Position
						objWrapper.setAbsolutePosition(objAbsolutePosition.x + intDeltaX, objAbsolutePosition.y + intDeltaY, true);

						if (objWrapper.updateHandle)
							objWrapper.updateHandle(true, "move");

						// Setup OnMove (if applicable)
						if (objWrapper.control.getAttribute("onqcodomove")) {
							objWrapper.control.qcodomove = function(strOnMoveCommand) {
								eval(strOnMoveCommand);
							};
							objWrapper.control.qcodomove(objWrapper.control.getAttribute("onqcodomove"));
						};
					};
				} else {
					// Rejected
					for (var strKey in this.moveControls) {
						var objWrapper = this.moveControls[strKey];
						var objMask = objWrapper.mask;

						objMask.style.cursor = null;
					};

					if (objWrapper.updateHandle)
						objWrapper.updateHandle(false, "move");

					if (qcodo.isBrowser(this.IE))
						this.resetMasks(intDeltaX, intDeltaY, 25);
					else
						this.resetMasks(intDeltaX, intDeltaY, 50);
				};

				// If we haven't moved at all, go ahead and run the control's onclick method
				// (if applicable) or just propogate the click up
				if ((intDeltaX == 0) && (intDeltaY == 0)) {
					if (this.control.onclick)
						return this.control.onclick(objEvent);
					else
						return true;
				} else {
					return qcodo.terminateEvent(objEvent);
				};
			};

			// Setup Move Targets
			objWrapper.moveControls = new Object();

			objWrapper.registerMoveTarget = function(mixControl) {
				// If they pass in null, then register itself as the move target
				if (mixControl == null) mixControl = this.control;

				var objControl; if (!(objControl = qcodo.getControl(mixControl))) return;
				var objTargetWrapper = objControl.wrapper;

				if (objTargetWrapper)
					this.moveControls[objControl.id] = objTargetWrapper;
//				this.registerDropZone(objTargetWrapper.parentNode);
			};

			objWrapper.unregisterMoveTarget = function(mixControl) {
				var objControl; if (!(objControl = qcodo.getControl(mixControl))) return;

				if (objControl.id)
					this.moveControls[objControl.id] = null;
			};

			objWrapper.clearMoveTargets = function() {
				this.moveControls = new Object();
			};

			// Setup Drop Zones
			objWrapper.registerDropZone = function(mixControl) {
				var objControl; if (!(objControl = qcodo.getControl(mixControl))) return;

				if (objControl.wrapper) {
					qcodo.registerControlDropZoneTarget(objControl);
					this.dropControls[objControl.id] = objControl.wrapper;
				} else
					this.dropControls[objControl.id] = objControl;
			};

			objWrapper.unregisterDropZone = function(mixControl) {
				var objControl; if (!(objControl = qcodo.getControl(mixControl))) return;

				this.dropControls[objControl.id] = null;
			};

			objWrapper.clearDropZones = function() {
				this.dropControls = new Object();
			};

			objWrapper.clearDropZones();
			
			objWrapper.registerDropZoneGrouping = function(strGroupingId) {
				if (!qcodo.dropZoneGrouping[strGroupingId])
					qcodo.dropZoneGrouping[strGroupingId] = new Array();
				this.dropGroupings[strGroupingId] = true;
			};

			objWrapper.clearDropZoneGroupings = function() {
				this.dropGroupings = new Object();
			};
			objWrapper.clearDropZoneGroupings();

			// Mouse Delta Calculator
			objWrapper.calculateMoveDelta = function() {
				// Calculate Move Delta
				var intDeltaX = qcodo.page.x - this.startDragX;
				var intDeltaY = qcodo.page.y - this.startDragY;

				intDeltaX = Math.min(Math.max(intDeltaX, -1 * this.boundingBox.x), qcodo.page.width - this.boundingBox.boundX);
				intDeltaY = Math.min(Math.max(intDeltaY, -1 * this.boundingBox.y), qcodo.page.height - this.boundingBox.boundY);

				return {x: intDeltaX, y: intDeltaY};
			};

			objWrapper.setupBoundingBox = function() {
				// Calculate moveControls aggregate bounding box (x,y,width,height,boundX,boundY)
				// Note that boundX is just (x + width), and boundY is just (y + height)
				var intMinX = null;
				var intMinY = null;
				var intMaxX = null;
				var intMaxY = null;
				for (var strKey in this.moveControls) {
					var objMoveControl = this.moveControls[strKey];
					var objAbsolutePosition = objMoveControl.getAbsolutePosition();
					if (intMinX == null) {
						intMinX = objAbsolutePosition.x;
						intMinY = objAbsolutePosition.y;
						intMaxX = objAbsolutePosition.x + objMoveControl.offsetWidth;
						intMaxY = objAbsolutePosition.y + objMoveControl.offsetHeight;
					} else {
						intMinX = Math.min(intMinX, objAbsolutePosition.x);
						intMinY = Math.min(intMinY, objAbsolutePosition.y);
						intMaxX = Math.max(intMaxX, objAbsolutePosition.x + objMoveControl.offsetWidth);
						intMaxY = Math.max(intMaxY, objAbsolutePosition.y + objMoveControl.offsetHeight);
					};
				};

				if (!this.boundingBox)
					this.boundingBox = new Object();

				this.boundingBox.x = intMinX;
				this.boundingBox.y = intMinY;
				this.boundingBox.boundX = intMaxX;
				this.boundingBox.boundY = intMaxY;
				this.boundingBox.width = intMaxX - intMinX;
				this.boundingBox.height = intMaxY - intMinY;
			};

			objWrapper.updateBoundingBox = function() {
				// Just like SETUP BoundingBox, except now we're using the MASKS instead of the Controls
				// (in case, becuase of hte move, the size of the control may have changed/been altered)
				var intMinX = null;
				var intMinY = null;
				var intMaxX = null;
				var intMaxY = null;
				for (var strKey in this.moveControls) {
					var objMoveControl = this.moveControls[strKey];
					var objAbsolutePosition = objMoveControl.getAbsolutePosition();
					if (intMinX == null) {
						intMinX = objAbsolutePosition.x;
						intMinY = objAbsolutePosition.y;
						intMaxX = objAbsolutePosition.x + objMoveControl.mask.offsetWidth;
						intMaxY = objAbsolutePosition.y + objMoveControl.mask.offsetHeight;
					} else {
						intMinX = Math.min(intMinX, objAbsolutePosition.x);
						intMinY = Math.min(intMinY, objAbsolutePosition.y);
						intMaxX = Math.max(intMaxX, objAbsolutePosition.x + objMoveControl.mask.offsetWidth);
						intMaxY = Math.max(intMaxY, objAbsolutePosition.y + objMoveControl.mask.offsetHeight);
					};
				};

				this.boundingBox.x = intMinX;
				this.boundingBox.y = intMinY;
				this.boundingBox.boundX = intMaxX;
				this.boundingBox.boundY = intMaxY;
				this.boundingBox.width = intMaxX - intMinX;
				this.boundingBox.height = intMaxY - intMinY;
			};

			objWrapper.moveMasks = function() {
				// Calculate Move Delta
				var objMoveDelta = this.calculateMoveDelta();
				var intDeltaX = objMoveDelta.x;
				var intDeltaY = objMoveDelta.y;

				var blnValidDropZone = this.validateDropZone();
				if (blnValidDropZone)
					this.handle.style.cursor = "url(" + qc.imageAssets + "/_core/move_drop.cur), auto";
				else
					this.handle.style.cursor = "url(" + qc.imageAssets + "/_core/move_nodrop.cur), auto";

				// Update Everything that's Moving (e.g. all controls in qcodo.moveControls)
				for (var strKey in this.moveControls) {
					var objWrapper = this.moveControls[strKey];
					var objMask = objWrapper.mask;

					// Fixes a weird Firefox bug
					if (objMask.innerHTML == "")
						objMask.innerHTML = ".";
					if (objMask.innerHTML == ".")
						objMask.innerHTML = objWrapper.innerHTML.replace(' id="', ' id="invalid_mask_');

					// Recalculate Widths
					this.updateBoundingBox();

					// Move this control's mask
					objWrapper.setMaskOffset(intDeltaX, intDeltaY);

					if (blnValidDropZone) {
						objMask.style.cursor = "url(" + qc.imageAssets + "/_core/move_drop.cur), auto";
					} else {
						objMask.style.cursor = "url(" + qc.imageAssets + "/_core/move_nodrop.cur), auto";
					};
				};
			};

			objWrapper.getDropZoneControlWrappers = function() {
				var arrayToReturn = new Array();
				
				for (var strDropKey in this.dropControls) {
					var objDropWrapper = this.dropControls[strDropKey];
					if (objDropWrapper)
						arrayToReturn[strDropKey] = objDropWrapper;
				};
				
				for (var strGroupingId in this.dropGroupings) {
					if (this.dropGroupings[strGroupingId]) for (var strControlId in qcodo.dropZoneGrouping[strGroupingId]) {
						if (strControlId.substring(0, 1) != "_") {
							var objDropWrapper = qcodo.dropZoneGrouping[strGroupingId][strControlId];
							if (objDropWrapper) {
								if (objDropWrapper.control.id == objWrapper.control.id) {
									if (qcodo.dropZoneGrouping[strGroupingId]["__allowSelf"])
										arrayToReturn[strControlId] = objDropWrapper;
								} else if (objDropWrapper.control.id == objWrapper.parentNode.id) {
									if (qcodo.dropZoneGrouping[strGroupingId]["__allowSelfParent"])
										arrayToReturn[strControlId] = objDropWrapper;
								} else {
									arrayToReturn[strControlId] = objDropWrapper;
								};
							};
						};
					};
				};
				return arrayToReturn;
			};

			objWrapper.validateDropZone = function() {
				var blnFoundTarget = false;
				var blnFormOkay = false;
				var dropControls = this.getDropZoneControlWrappers();

				for (var strDropKey in dropControls) {
					var objDropWrapper = dropControls[strDropKey];
					if (objDropWrapper) {
						if (objDropWrapper.nodeName.toLowerCase() == 'form') {
							blnFormOkay = true;
						} else if (objDropWrapper.containsPoint(qcodo.page.x, qcodo.page.y)) {
							if (blnFoundTarget) {
								objDropWrapper.dropZoneMask.style.display = "none";
							} else {
								objDropWrapper.dropZoneMask.style.display = "block";
								var objAbsolutePosition = objDropWrapper.getAbsolutePosition();
								if (qcodo.isBrowser(qcodo.IE) && (window.document.compatMode == "BackCompat")) {
									objDropWrapper.dropZoneMask.style.width = Math.max(7, objDropWrapper.control.offsetWidth) + "px";
									objDropWrapper.dropZoneMask.style.height = Math.max(7, objDropWrapper.control.offsetHeight) + "px";

//										if (objDropWrapper.style.position == 'absolute') {
										var objAbsolutePosition = objDropWrapper.getAbsolutePosition();
//											objDropWrapper.setDropZoneMaskAbsolutePosition(objAbsolutePosition.x + 10, objAbsolutePosition.y + 10);
										objDropWrapper.setDropZoneMaskAbsolutePosition(objAbsolutePosition.x, objAbsolutePosition.y);
//										};
								} else {
									objDropWrapper.dropZoneMask.style.width = Math.max(1, objDropWrapper.control.offsetWidth - 6) + "px";
									objDropWrapper.dropZoneMask.style.height = Math.max(1, objDropWrapper.control.offsetHeight - 6) + "px";

//										if (objDropWrapper.style.position != 'absolute') {
										var objAbsolutePosition = objDropWrapper.getAbsolutePosition();
										objDropWrapper.setDropZoneMaskAbsolutePosition(objAbsolutePosition.x, objAbsolutePosition.y);
//										}
								};
								blnFoundTarget = true;
							};
						} else {
							objDropWrapper.dropZoneMask.style.display = "none";
						};
					};
				};

				return (blnFoundTarget || blnFormOkay);
			};

			// Will return "NULL" if there was no target found
			// Could also return the Form if not dropped on any valid target BUT tbe Form is still a drop zone
			objWrapper.getDropTarget = function() {
				var objForm = null;
				var objToReturn = null;
				
				var dropControls = this.getDropZoneControlWrappers();
				
				for (var strDropKey in dropControls) {
					var objDropWrapper = dropControls[strDropKey];
					if (objDropWrapper) {
						if (objDropWrapper.nodeName.toLowerCase() == 'form')
							objForm = objDropWrapper;
						else if (objDropWrapper.containsPoint(qcodo.page.x, qcodo.page.y)) {
							objDropWrapper.dropZoneMask.style.display = "none";
							if (!objToReturn)
								objToReturn = objDropWrapper;
						};
					};
				};

				if (objToReturn)
					return objToReturn;

				if (objForm)
					return objForm;

				return null;
			};

			objWrapper.resetMasks = function(intDeltaX, intDeltaY, intSpeed) {
				qcodo.moveHandleReset = this;

				if (intDeltaX || intDeltaY) {
					this.resetCurrentOffsetX = intDeltaX * 1.0;
					this.resetCurrentOffsetY = intDeltaY * 1.0;

					var fltTotalMove = Math.sqrt(Math.pow(intDeltaX, 2) + Math.pow(intDeltaY, 2));
					var fltRatio = (intSpeed * 1.0) / fltTotalMove;
					this.resetStepX = fltRatio * intDeltaX;
					this.resetStepY = fltRatio * intDeltaY;
					
					qcodo.setTimeout("move_mask_return", "qcodo.wrappers['" + this.id + "'].resetMaskHelper()", 10);
				};
			};

			objWrapper.resetMaskHelper = function() {
				if (this.resetCurrentOffsetX < 0)
					this.resetCurrentOffsetX = Math.min(this.resetCurrentOffsetX - this.resetStepX, 0);
				else
					this.resetCurrentOffsetX = Math.max(this.resetCurrentOffsetX - this.resetStepX, 0);

				if (this.resetCurrentOffsetY < 0)
					this.resetCurrentOffsetY = Math.min(this.resetCurrentOffsetY - this.resetStepY, 0);
				else
					this.resetCurrentOffsetY = Math.max(this.resetCurrentOffsetY - this.resetStepY, 0);

				for (var strKey in this.moveControls) {
					var objWrapper = this.moveControls[strKey];
					objWrapper.setMaskOffset(this.resetCurrentOffsetX, this.resetCurrentOffsetY);

					if ((this.resetCurrentOffsetX == 0) && (this.resetCurrentOffsetY == 0)) {
						objWrapper.mask.style.display = "none";
					};
				};

				if ((this.resetCurrentOffsetX != 0) || (this.resetCurrentOffsetY != 0))
					qcodo.setTimeout("move_mask_return", "qcodo.wrappers['" + this.id + "'].resetMaskHelper()", 10);
				else
					qcodo.moveHandleReset = null;
			};

			objWrapper.resetMasksCancel = function() {
				qcodo.clearTimeout("move_mask_return");
				qcodo.moveHandleReset = null;
				for (var strKey in this.moveControls) {
					var objWrapper = this.moveControls[strKey];
					objWrapper.mask.style.display = "none";
				};
			};
			
			// Wrapper Shortcuts
			objWrapper.regMT = objWrapper.registerMoveTarget;
			objWrapper.regDZ = objWrapper.registerDropZone;			
			objWrapper.regDZG = objWrapper.registerDropZoneGrouping;
		} else {
			objWrapper.updateHandle();
		};
	};

	qcodo.animateMove = function(mixControl, intDestinationX, intDestinationY, intSpeed) {
		var objControl; if (!(objControl = qcodo.getControl(mixControl))) return;

		// Record Destination Coordinates
		objControl.destinationX = intDestinationX;
		objControl.destinationY = intDestinationY;

		// Get Starting Coordinates
		var objAbsolutePosition = qcodo.getAbsolutePosition(objControl);
		objControl.currentX = objAbsolutePosition.x * 1.0;
		objControl.currentY = objAbsolutePosition.y * 1.0;

		// Calculate the amount to move in the X- and Y- direction per step
		var fltTotalMove = Math.sqrt(Math.pow(objControl.destinationY - objControl.currentY, 2) + Math.pow(objControl.destinationX - objControl.currentX, 2));
		var fltTotalMoveX = (objControl.destinationX * 1.0) - objControl.currentX;
		var fltTotalMoveY = (objControl.destinationY * 1.0) - objControl.currentY;
		objControl.stepMoveX = ((intSpeed * 1.0) / fltTotalMove) * fltTotalMoveX;
		objControl.stepMoveY = ((intSpeed * 1.0) / fltTotalMove) * fltTotalMoveY;

		qcodo.setTimeout(objControl, "qcodo.handleAnimateMove('" + objControl.id + "');", 10);
	};

	qcodo.handleAnimateMove = function(mixControl) {
		var objControl; if (!(objControl = qcodo.getControl(mixControl))) return;

		// Update Current Coordinates
		if (objControl.stepMoveX < 0)
			objControl.currentX = Math.max(objControl.destinationX, objControl.currentX + objControl.stepMoveX);
		else
			objControl.currentX = Math.min(objControl.destinationX, objControl.currentX + objControl.stepMoveX);

		if (objControl.stepMoveY < 0)
			objControl.currentY = Math.max(objControl.destinationY, objControl.currentY + objControl.stepMoveY);
		else
			objControl.currentY = Math.min(objControl.destinationY, objControl.currentY + objControl.stepMoveY);

		qcodo.setAbsolutePosition(objControl, Math.round(objControl.currentX), Math.round(objControl.currentY));
		
		if ((Math.round(objControl.currentX) == objControl.destinationX) &&
			(Math.round(objControl.currentY) == objControl.destinationY)) {
			// We are done
			
			if (objControl.handleAnimateComplete)
				objControl.handleAnimateComplete(objControl);
		} else {
			// Do it again
			qcodo.setTimeout(objControl, "qcodo.handleAnimateMove('" + objControl.id + "');", 10);
		};
	};

	qcodo.handleScroll = function() {
		var objHandle = qcodo.scrollMoveHandle;

		// Clear Timeout
		qcodo.clearTimeout(objHandle.id);

		// How much to scroll by
		var intScrollByX = 0;
		var intScrollByY = 0;

		// Calculate our ScrollByY amount
		if (qcodo.client.y <= 30) {
			var intDivisor = (qcodo.isBrowser(qcodo.IE)) ? 1.5 : 3;
			intScrollByY = Math.round((qcodo.client.y - 30) / intDivisor);
		} else if (qcodo.client.y >= (qcodo.client.height - 30)) {
			var intDivisor = (qcodo.isBrowser(qcodo.IE)) ? 1.5 : 3;
			intScrollByY = Math.round((qcodo.client.y - (qcodo.client.height - 30)) / intDivisor);
		};

		// Calculate our ScrollByX amount
		if (qcodo.client.x <= 30) {
			var intDivisor = (qcodo.isBrowser(qcodo.IE)) ? 1 : 2;
			intScrollByX = Math.round((qcodo.client.x - 30) / intDivisor);
		} else if (qcodo.client.x >= (qcodo.client.width - 30)) {
			var intDivisor = (qcodo.isBrowser(qcodo.IE)) ? 1 : 2;
			intScrollByX = Math.round((qcodo.client.x - (qcodo.client.width - 30)) / intDivisor);
		};

		// Limit ScrollBy amounts (dependent on current scroll and scroll.max's)
		if (intScrollByX < 0) {
			// Scroll to Left
			intScrollByX = Math.max(intScrollByX, 0 - qcodo.scroll.x);
		} else if (intScrollByX > 0) {
			// Scroll to Right
			intScrollByX = Math.min(intScrollByX, qcodo.scroll.width - qcodo.scroll.x);
		};
		if (intScrollByY < 0) {
			// Scroll to Left
			intScrollByY = Math.max(intScrollByY, 0 - qcodo.scroll.y);
		} else if (intScrollByY > 0) {
			// Scroll to Right
			intScrollByY = Math.min(intScrollByY, qcodo.scroll.height - qcodo.scroll.y);
		};

		// Perform the Scroll
		window.scrollBy(intScrollByX, intScrollByY);

		// Update Event Stats
		qcodo.handleEvent(null);

		// Update Handle Offset
		objHandle.offsetX -= intScrollByX;
		objHandle.offsetY -= intScrollByY;

		objHandle.moveMasks();
		if (intScrollByX || intScrollByY)
			qcodo.setTimeout(objHandle.id, "qcodo.handleScroll()", 25);
	};



//////////////////
// Qcodo Shortcuts
//////////////////

	qc.regCM = qcodo.registerControlMoveable;
	qc.regCMH = qcodo.registerControlMoveHandle;
/////////////////////////////////////////////
// Block Control: Resize Handle functionality
/////////////////////////////////////////////

	qcodo.registerControlResizeHandle = function(mixControl, blnVertical) {
		var objControl; if (!(objControl = qcodo.getControl(mixControl))) return;
		var objWrapper = objControl.wrapper;

		objWrapper.resizeHandle = true;
		objWrapper.resizeDirectionVertical = blnVertical;
		objWrapper.resizeUpperControls = new Array();
		objWrapper.resizeLowerControls = new Array();

		if (!objWrapper.handle) {
			if (qcodo.isBrowser(qcodo.SAFARI))
				qcodo.registerControlHandle(objControl, 'move');
			else if (qcodo.isBrowser(qcodo.IE)) {
				if (objWrapper.resizeDirectionVertical)
					qcodo.registerControlHandle(objControl, 'row-resize');
				else
					qcodo.registerControlHandle(objControl, 'col-resize');
			} else {
				if (objWrapper.resizeDirectionVertical)
					qcodo.registerControlHandle(objControl, 'ns-resize');
				else
					qcodo.registerControlHandle(objControl, 'ew-resize');
			};

			// Assign Event Handlers
			qcodo.enableMouseDrag();

			objWrapper.handleMouseDown = function(objEvent, objHandle) {
				this.startUpperSizes = new Array();
				this.startLowerSizes = new Array();
				this.startLowerPositions = new Array();
	
				if (this.resizeDirectionVertical) {
					this.offsetY = qcodo.page.y - this.getAbsolutePosition().y;
					this.startDragY = qcodo.page.y;
	
					for (var intIndex = 0; intIndex < this.resizeUpperControls.length; intIndex++) {
						var objUpperControl = this.resizeUpperControls[intIndex];
						this.startUpperSizes[intIndex] = eval(objUpperControl.control.style.height.replace(/px/, ""));
					};
	
					for (var intIndex = 0; intIndex < this.resizeLowerControls.length; intIndex++) {
						var objLowerControl = this.resizeLowerControls[intIndex];
						this.startLowerPositions[intIndex] = objLowerControl.getAbsolutePosition().y;
						this.startLowerSizes[intIndex] = eval(objLowerControl.control.style.height.replace(/px/, ""));
					};
	
					if (this.resizeMinimum != null)
						this.resizeMinimumY = this.getAbsolutePosition().y - (this.offsetTop - this.resizeMinimum);
					else
						this.resizeMinimumY = null;

					if (this.resizeMaximum != null)
						this.resizeMaximumY = this.getAbsolutePosition().y - (this.offsetTop - this.resizeMaximum);
					else
						this.resizeMaximumY = null;
				} else {
					this.offsetX = qcodo.page.x - this.getAbsolutePosition().x;
					this.startDragX = qcodo.page.x;
	
					for (var intIndex = 0; intIndex < this.resizeUpperControls.length; intIndex++) {
						var objUpperControl = this.resizeUpperControls[intIndex];
						this.startUpperSizes[intIndex] = eval(objUpperControl.control.style.width.replace(/px/, ""));
					};

					for (var intIndex = 0; intIndex < this.resizeLowerControls.length; intIndex++) {
						var objLowerControl = this.resizeLowerControls[intIndex];
						this.startLowerPositions[intIndex] = objLowerControl.getAbsolutePosition().x;
						this.startLowerSizes[intIndex] = eval(objLowerControl.control.style.width.replace(/px/, ""));
					};

					if (this.resizeMinimum != null)
						this.resizeMinimumX = this.getAbsolutePosition().x - (this.offsetLeft - this.resizeMinimum);
					else
						this.resizeMinimumX = null;

					if (this.resizeMaximum != null)
						this.resizeMaximumX = this.getAbsolutePosition().x - (this.offsetLeft - this.resizeMaximum);
					else
						this.resizeMaximumX = null;
				};

				return qcodo.terminateEvent(objEvent);
			};
	
			objWrapper.handleMouseMove = function(objEvent, objHandle) {
				if (this.resizeDirectionVertical) {
					var intNewY = qcodo.page.y - this.offsetY;
	
					if (this.resizeMinimumY != null)
						intNewY = Math.max(intNewY, this.resizeMinimumY);
					if (this.resizeMaximumY != null)
						intNewY = Math.min(intNewY, this.resizeMaximumY);
					var intDeltaY = intNewY - this.startDragY + this.offsetY;
	
					// Update ResizeHandle's Position
					this.setAbsolutePosition(this.getAbsolutePosition().x, intNewY);
	
					// Resize Upper Controls
					for (var intIndex = 0; intIndex < this.resizeUpperControls.length; intIndex++) {
						var objUpperControl = this.resizeUpperControls[intIndex];
						objUpperControl.updateStyle("height", this.startUpperSizes[intIndex] + intDeltaY + "px");
					};
	
					// Reposition Lower Controls
					for (var intIndex = 0; intIndex < this.resizeLowerControls.length; intIndex++) {
						var objLowerControl = this.resizeLowerControls[intIndex];
						objLowerControl.setAbsolutePosition(
							objLowerControl.getAbsolutePosition().x,
							this.startLowerPositions[intIndex] + intDeltaY);
						objLowerControl.updateStyle("height", this.startLowerSizes[intIndex] - intDeltaY + "px");
					};
				} else {
					var intNewX = qcodo.page.x - this.offsetX;
	
					if (this.resizeMinimumX != null)
						intNewX = Math.max(intNewX, this.resizeMinimumX);
					if (this.resizeMaximumX != null)
						intNewX = Math.min(intNewX, this.resizeMaximumX);
					var intDeltaX = intNewX - this.startDragX + this.offsetX;
	
					// Update ResizeHandle's Position
					this.setAbsolutePosition(intNewX, this.getAbsolutePosition().y);
	
					// Resize Upper Controls
					for (var intIndex = 0; intIndex < this.resizeUpperControls.length; intIndex++) {
						var objUpperControl = this.resizeUpperControls[intIndex];
						objUpperControl.updateStyle("width", this.startUpperSizes[intIndex] + intDeltaX + "px");
					};
	
					// Reposition Lower Controls
					for (var intIndex = 0; intIndex < this.resizeLowerControls.length; intIndex++) {
						var objLowerControl = this.resizeLowerControls[intIndex];
						objLowerControl.setAbsolutePosition(
							this.startLowerPositions[intIndex] + intDeltaX,
							objLowerControl.getAbsolutePosition().y);
						objLowerControl.updateStyle("width", this.startLowerSizes[intIndex] - intDeltaX + "px");
					};
				};
	
				// Update Handle Position
				this.updateHandle(false);
	
				return qcodo.terminateEvent(objEvent);
			};
	
			objWrapper.handleMouseUp = function(objEvent, objHandle) {
				// See if we've even resized at all
				var blnResized = true;
				if (this.resizeDirectionVertical) {
					if (this.startDragY == qcodo.page.y)
						blnResized = false;
				} else {
					if (this.startDragX == qcodo.page.x)
						blnResized = false;
				};

				if (blnResized) {
					this.updateHandle(true);

					// Setup OnResize (if applicable)
					if (this.control.getAttribute("onqcodoresize")) {
							this.control.qcodoresize = function(strOnResizeCommand) {
								eval(strOnResizeCommand);
							};

							this.control.qcodoresize(this.control.getAttribute("onqcodoresize"));
					};

					return qcodo.terminateEvent(objEvent);
				} else {
					// If we haven't resized at all, go ahead and run the control's onclick method
					// (if applicable) or just propogate the click up
					if (this.control.onclick)
						return this.control.onclick(objEvent);
					else
						return true;
				};
			};

			objWrapper.setUpperControl = function(mixControl) {
				var objControl; if (!(objControl = qcodo.getControl(mixControl))) return;
				var objWrapper = objControl.wrapper;
	
				this.resizeUpperControls[this.resizeUpperControls.length] = objWrapper;
			};
	
			objWrapper.setLowerControl = function(mixControl) {
				var objControl; if (!(objControl = qcodo.getControl(mixControl))) return;
				var objWrapper = objControl.wrapper;
	
				this.resizeLowerControls[this.resizeLowerControls.length] = objWrapper;
			};
	
			objWrapper.resizeMinimum = null;
			objWrapper.resizeMaximum = null;
	
			objWrapper.setResizeMinimum = function(intMinimum) {
				this.resizeMinimum = intMinimum;
			};
	
			objWrapper.setResizeMaximum = function(intMaximum) {
				this.resizeMaximum = intMaximum;
			};
	
			// Wrapper Shortcuts
			objWrapper.setUC = objWrapper.setUpperControl;
			objWrapper.setLC = objWrapper.setLowerControl;
			objWrapper.setReMi = objWrapper.setResizeMinimum;
			objWrapper.setReMa = objWrapper.setResizeMaximum;
		} else {
			objWrapper.updateHandle();
		};
	};



//////////////////
// Qcodo Shortcuts
//////////////////

	qc.regCRH = qcodo.registerControlResizeHandle;
// This function hides the toggle menu if it is being displayed
function clickWindow(toggleMenuId) {
	var objToggleMenu = document.getElementById(toggleMenuId);
	if (objToggleMenu.parentNode.style.display != 'none') {
		qc.getW(toggleMenuId).toggleDisplay('hide');
	}
}

// This function repositions the toggle menu when the window is resized
function resizeWindow(toggleMenuId, toggleButtonId) {
	var objToggleMenu = document.getElementById(toggleMenuId);
	if (objToggleMenu.parentNode.style.display != 'none') {
		setPosition(toggleButtonId, toggleMenuId);
	}
}

// This function is run when the ColumnToggleButton is clicked
// Positions and Displays the column toggle menu
function toggleColumnToggleDisplay(e, toggleMenuId, toggleButtonId) {
	
	// Set the position of the toggle menu based on the location of the menu button
	setPosition(toggleButtonId, toggleMenuId);
	
	// Display/Hide the column toggle menu
	qc.getW(toggleMenuId).toggleDisplay();
	
	var objToggleMenu = document.getElementById(toggleMenuId);
	// Set the onresize and onclick event handlers only when the menu is being displayed to avoid unnecessarily running the function
	if (objToggleMenu.parentNode.style.display != 'none') {
		function r() {
			resizeWindow(toggleMenuId, toggleButtonId);
		}
		window.onresize = r;
		
		function c() {
			clickWindow(toggleMenuId);
		}
		window.document.onclick = c;
	}
	// Set event handlers to null when menu is not being displayed
	else {
		window.onresize = null;
		window.document.onclick = null;
	}
	
	// Stop bubbling up and propagation down in events so that functions don't get run more than once
	// This was specifically because setPosition was getting run from the window.onClick() event and from clicking on the button
	if (!e) { var e = window.event; }
  	e.cancelBubble = true;
  	if (e.stopPropagation) { e.stopPropagation(); }
}

// Based on the position of the button (strLabelControlId), this positions the column toggle menu (strPanelControlId)
function setPosition(strLabelControlId, strPanelControlId) {
	
	 var objLabel = document.getElementById(strLabelControlId);
	 var arrCurrentLabelPosition = findPosition(objLabel.offsetParent);
	 
	 var objToggleMenu = document.getElementById(strPanelControlId);
	 var strMenuWidth = objToggleMenu.offsetWidth;
	 // The menu width will be 0 when it is first rendered as display: none. This uses it's style parameters to calculate what it's width will be
	 // This was necessary in order to be able to set the position of the menu before it was displayed, to avoid a scrollbar flicker.
	 if (strMenuWidth==0) {
	 	strMenuWidth = getWidth(objToggleMenu);
	 }
	 objToggleMenu.style.position = 'absolute';
	 objToggleMenu.style.left = (arrCurrentLabelPosition[0] + objLabel.offsetParent.offsetWidth - strMenuWidth) + 'px';
	 objToggleMenu.style.top = (arrCurrentLabelPosition[1] + objLabel.offsetParent.offsetHeight) + 'px';

}

// This function finds the absolute position of and element in pixels by drilling down through all parent elements and summing all left and top offsets.
function findPosition(obj) {
	var current_top = 0;
	var current_left = 0;
	if (obj.offsetParent) {
		current_left = obj.offsetLeft;
		current_top = obj.offsetTop;
		while (obj = obj.offsetParent) {
			current_left += obj.offsetLeft;
			current_top += obj.offsetTop;
		}
	}
	return [current_left,current_top];
}

function getWidth(obj) {

	var strWidth = 0;
	
	var intWidth = parseInt(obj.style.width);
	var intPaddingLeft = parseInt(obj.style.paddingLeft);
	var intPaddingRight = parseInt(obj.style.paddingRight);
	var intBorderLeftWidth = parseInt(obj.style.borderLeftWidth);
	var intBorderRightWidth = parseInt(obj.style.borderRightWidth);
	strWidth += (!isNaN(intWidth)) ? intWidth : 0;
	strWidth += (!isNaN(intPaddingLeft)) ? intPaddingLeft : 0;
	strWidth += (!isNaN(intPaddingRight)) ? intPaddingRight : 0;
	strWidth += (!isNaN(intBorderLeftWidth)) ? intBorderLeftWidth : 0;
	strWidth += (!isNaN(intBorderRightWidth)) ? intBorderRightWidth : 0;
	
	return strWidth;
}




function __resetListBox(strFormId, strControlId) {
	var objListBox = document.forms[strFormId].elements[strControlId];
	objListBox.selectedIndex = -1;
	if (objListBox.onchange)
		objListBox.onchange();
};	function Qcodo__DateTimePicker_Change(strControlId, objListbox) {
		var objMonth = document.getElementById(strControlId + "_lstMonth");
		var objDay = document.getElementById(strControlId + "_lstDay");
		var objYear = document.getElementById(strControlId + "_lstYear");

		if (objListbox.options[objListbox.selectedIndex].value == "") {
			objMonth.selectedIndex = 0;
			objYear.selectedIndex = 0;
			while(objDay.options.length)
				objDay.options[objDay.options.length - 1] = null;
			objDay.options[0] = new Option("--", "");
			objDay.selectedIndex = 0;
		} else {
			if ((objListbox == objMonth) || ((objListbox == objYear) && (objMonth.options[objMonth.selectedIndex].value == 2))) {
				var intCurrentDay = objDay.options[objDay.selectedIndex].value;
				var intCurrentMaxDay = objDay.options[objDay.options.length - 1].value;
				
				// Calculate new Max Day
				var intNewMaxDay = 0;
				var intSelectedMonth = objMonth.options[objMonth.selectedIndex].value;
				var intSelectedYear = new Number(objYear.options[objYear.selectedIndex].value);

				if (!intSelectedYear)
					intSelectedYear = 2000;

				switch (intSelectedMonth) {
					case "1":
					case "3":
					case "5":
					case "7":
					case "8":
					case "10":
					case "12":
						intNewMaxDay = 31;
						break;
					case "4":
					case "6":
					case "9":
					case "11":
						intNewMaxDay = 30;
						break;
					case "2":
						if ((intSelectedYear % 4) != 0)
							intNewMaxDay = 28;
						else if ((intSelectedYear % 1000) == 0)
							intNewMaxDay = 29;
						else if ((intSelectedYear % 100) == 0)
							intNewMaxDay = 28;
						else
							intNewMaxDay = 29;
						break;
				};

				if (intNewMaxDay != intCurrentMaxDay) {
					// Redo the Days Dropdown
					var blnRequired = true;
					if (objDay.options[0].value == "")
						blnRequired = false;

					while (objDay.options.length)
						objDay.options[objDay.options.length - 1] = null;
					if (!blnRequired)
						objDay.options[0] = new Option("--", "");
					for (var intDay = 1; intDay <= intNewMaxDay; intDay++) {
						objDay.options[objDay.options.length] = new Option(intDay, intDay);
					};
					
					intCurrentDay = Math.min(intCurrentDay, intNewMaxDay);
					
					if (blnRequired)
						objDay.options[intCurrentDay - 1].selected = true;
					else
						objDay.options[intCurrentDay].selected = true;
				};
			};
		};
	};