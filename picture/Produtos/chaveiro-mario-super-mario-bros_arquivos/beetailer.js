var fb_ref_regex = /^beetailer_(.*)/

function getParam(name){
   var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
   if (results) {
     return results[1];
   } else {
     null
   }
}

/* Cookies handle */
function createCookie(name,value,days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
  }
  else var expires = "";
  /* Adding wildcard period character in order to work with Magento core/cookie set function */
  document.cookie = name+"="+value+expires+"; path=/; domain=."+window.location.hostname;
}

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  
  return "";
}

function eraseCookie(name) {
  createCookie(name,"",-1);
}

/* Check for Beetailer ref*/
function checkUrl(){
  if(getParam("fb_ref") && fb_ref_regex.test(getParam("fb_ref"))){

    /* Set Cookies */
    createCookie("beetailer_ref", getParam("fb_ref") , 720);
    createCookie("beetailer_ref_date", new Date().getTime()/1000 , 720);

    /* Populate cart */
    if(getParam("checkout")){populateCart();}
  }
}

function populateCart(){
  switch(getParam("checkout"))
  {
    case 'amazon':
      populateCartAmazon();
      break;
    case 'shopify':
      /*Not developed yet*/
      populateCartShopify();
      break;
  }
}



function hidePromoPopup(){
  var head = document.getElementsByTagName('html')[0];
  var child = document.getElementById("beetailer_promotion");
  head.removeChild(child);
  createCookie("hide_beetailer_promos", 1)
}

function addPromos(){
  if(!readCookie('hide_beetailer_promos')){
    /* Load promotions script */
    var head= document.getElementsByTagName('head')[0];
    var script= document.createElement('script');
    script.type= 'text/javascript';
    script.src= '//www.beetailer.com/out/promotions.js?domain=' + window.location.hostname + '&locale=' + getBrowserLanguage();
    head.appendChild(script);
  }
}



function addBeesocial(){
  if(typeof bt_widget_label == "undefined"){ bt_widget_label = "beesocial"};
  if(document.getElementById(bt_widget_label) && !document.getElementById("social_widget_iframe")){
    label = document.getElementById(bt_widget_label);
    var attributes = document.getElementById(bt_widget_label).attributes;
    var options = Array();

    /* Load javascript vbles embeded in html tag attributes */
    for (i=0;i<attributes.length; i++){
      options[attributes[i].nodeName] = attributes[i].nodeValue;
    }

    /* Instanciate iframe script */
    var iframe= document.createElement('iframe');
    iframe.setAttribute("frameBorder", "0");
    iframe.setAttribute("scrolling", "no");
    iframe.setAttribute("width", "100%");
    iframe.setAttribute("height", "1");
    iframe.setAttribute("id", "social_widget_iframe");
    var src= "https://www.beetailer.com/out/social_widget" + 
                "?domain=" + options["data-domain"] + 
                "&product_id=" + options["data-product-id"] + 
                "&url=" + options["data-url"] + 
                "&data_comment_width=" + options['data-comment-width'] +
                "&data_css_style=" + escape(options['data-css-style']) + 
                "&data_disable_twitter=" + options['data-disable-twitter'] + 
                "&data_disable_like=" + options['data-disable-like'] +
                "&data_disable_comment=" + options['data-disable-comment'] + 
                "&data_disable_plusone=" + options['data-disable-plusone'] + 
                "&data_twitter_text=" + options['data-twitter-text'] + 
                "&data_fb_comment_style=" + options['data-fb-comment-style']  +
                "&data_fb_comment_num_post=" + options['data-fb-comment-num-post'] + 
                "&locale=" +  getBrowserLanguage() + 
                "&platform=" + options['platform']; 

    iframe.src= src + "&hash=" + MD5(src) + "#" + window.location.href;
    label.appendChild(iframe);

    /* Resize listener */
    XD.receiveMessage(function(message){
      /* console.warn('Resizing iframe ' + message.data + 'px'); */
      document.getElementById('social_widget_iframe').style.height= message.data + 'px';
    }, 'https://www.beetailer.com');
  }
}

function populateCartAmazon(){
  /* Amazon store cookie */
  var sessionid = readCookie('session-id');

  if(sessionid == ""){
    return;
  }

  /* Set parameters */
  var data = amazonParseProducts();
  var url = "/api/cart/" + sessionid + "/items";
  doAjax(url, 'PUT', true, redirectToCart, data); 
}

/*
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<c:cartItems xmlns:c="http://webstore.amazon.com/API">
  <c:cartItem>
    <c:product>
      <c:identifiers>
        <c:asin>'+asin+'</c:asin>
      </c:identifiers>
    </c:product>
    <c:quantity>1</c:quantity>
  </c:cartItem>
</c:cartItems>
*/

function amazonParseProducts(){
  var data='<?xml version="1.0" encoding="UTF-8" standalone="yes"?><c:cartItems xmlns:c="http://webstore.amazon.com/API">';

  /* Getting parameters product[x][asin]=xx&product[x][qty]=yy */
  /* It requires that the parameters comes in order */
  regexp = new RegExp('[\\?&]' + 'products\\[[0-9]*\\]\\[(asin|qty)\\]' + '=([^&#]*)', 'g');
  var i = 0;
  while(match = regexp.exec(window.location.href)){
    if(i%2==0){
        asin = match[2];
        data = data + "<c:cartItem> <c:product> <c:identifiers> <c:asin>"+asin+"</c:asin> </c:identifiers> </c:product>";
      }else{
          data = data + "<c:quantity>" + match[2] + "</c:quantity> </c:cartItem>"
          console.info("ASIN " + asin + " qty " + match[2]) ;
        }
    i++;
  }
  return data + "</c:cartItems>";
}

function redirectToCart(){
  if (this.readyState == 4){
    if(this.status == 200) {
      window.location.href = "/cart";
    }
  }
}

function getBrowserLanguage(){
  var locale = window.navigator.userLanguage || window.navigator.language;
  lang = locale.split("-")[0];
  /* We just return the available locales */
  return include(['en', 'es', 'pt', 'nl', 'ja', 'hu', 'fr', 'pl', 'nb', 'de', 'tr', 'it'], lang) ? lang : "en";
}

function include(arr, obj) {
  for(var i=0; i<arr.length; i++) {
    if (arr[i] == obj) return true;
  }
}

// Resize post_message
//
var XD = function(){
    var interval_id,
    last_hash,
    cache_bust = 1,
    attached_callback,
    window = this;

    return {
        postMessage : function(message, target_url, target) {
            if (!target_url) {
                return;
            }
            target = target || parent;  // default to parent
            if (window['postMessage']) {
                // the browser supports window.postMessage, so call it with a targetOrigin
                // set appropriately, based on the target_url parameter.
                target['postMessage'](message, target_url.replace( /([^:]+:\/\/[^\/]+).*/, '$1'));
            } else if (target_url) {
                // the browser does not support window.postMessage, so use the window.location.hash fragment hack
                target.location = target_url.replace(/#.*$/, '') + '#' + (+new Date) + (cache_bust++) + '&' + message;
            }
        },
        receiveMessage : function(callback, source_origin) {
            // browser supports window.postMessage
            if (window['postMessage']) {
                // bind the callback to the actual event associated with window.postMessage
                if (callback) {
                    attached_callback = function(e) {
                        if ((typeof source_origin === 'string' && typeof e.origin === 'string' && e.origin.replace(/http(s*):\/\//, "") !== source_origin.replace(/http(s*):\/\//, ""))
                        || (Object.prototype.toString.call(source_origin) === "[object Function]" && source_origin(e.origin) === !1)) {
                             return !1;
                         }
                         callback(e);
                     };
                 }
                 if (window['addEventListener']) {
                     window[callback ? 'addEventListener' : 'removeEventListener']('message', attached_callback, !1);
                 } else {
                     window[callback ? 'attachEvent' : 'detachEvent']('onmessage', attached_callback);
                 }
             } else {
                 // a polling loop is started & callback is called whenever the location.hash changes
                 interval_id && clearInterval(interval_id);
                 interval_id = null;
                 if (callback) {
                     interval_id = setInterval(function() {
                         var hash = document.location.hash,
                         re = /^#?\d+&/;
                         if (hash !== last_hash && re.test(hash)) {
                             last_hash = hash;
                             callback({data: hash.replace(re, '')});
                         }
                     }, 100);
                 }
             }
         }
    };
}();

/**
*
*  MD5 (Message-Digest Algorithm)
*  http://www.webtoolkit.info/
*
**/
 
var MD5 = function (string) {
 
	function RotateLeft(lValue, iShiftBits) {
		return (lValue<<iShiftBits) | (lValue>>>(32-iShiftBits));
	}
 
	function AddUnsigned(lX,lY) {
		var lX4,lY4,lX8,lY8,lResult;
		lX8 = (lX & 0x80000000);
		lY8 = (lY & 0x80000000);
		lX4 = (lX & 0x40000000);
		lY4 = (lY & 0x40000000);
		lResult = (lX & 0x3FFFFFFF)+(lY & 0x3FFFFFFF);
		if (lX4 & lY4) {
			return (lResult ^ 0x80000000 ^ lX8 ^ lY8);
		}
		if (lX4 | lY4) {
			if (lResult & 0x40000000) {
				return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);
			} else {
				return (lResult ^ 0x40000000 ^ lX8 ^ lY8);
			}
		} else {
			return (lResult ^ lX8 ^ lY8);
		}
 	}
 
 	function F(x,y,z) { return (x & y) | ((~x) & z); }
 	function G(x,y,z) { return (x & z) | (y & (~z)); }
 	function H(x,y,z) { return (x ^ y ^ z); }
	function I(x,y,z) { return (y ^ (x | (~z))); }
 
	function FF(a,b,c,d,x,s,ac) {
		a = AddUnsigned(a, AddUnsigned(AddUnsigned(F(b, c, d), x), ac));
		return AddUnsigned(RotateLeft(a, s), b);
	};
 
	function GG(a,b,c,d,x,s,ac) {
		a = AddUnsigned(a, AddUnsigned(AddUnsigned(G(b, c, d), x), ac));
		return AddUnsigned(RotateLeft(a, s), b);
	};
 
	function HH(a,b,c,d,x,s,ac) {
		a = AddUnsigned(a, AddUnsigned(AddUnsigned(H(b, c, d), x), ac));
		return AddUnsigned(RotateLeft(a, s), b);
	};
 
	function II(a,b,c,d,x,s,ac) {
		a = AddUnsigned(a, AddUnsigned(AddUnsigned(I(b, c, d), x), ac));
		return AddUnsigned(RotateLeft(a, s), b);
	};
 
	function ConvertToWordArray(string) {
		var lWordCount;
		var lMessageLength = string.length;
		var lNumberOfWords_temp1=lMessageLength + 8;
		var lNumberOfWords_temp2=(lNumberOfWords_temp1-(lNumberOfWords_temp1 % 64))/64;
		var lNumberOfWords = (lNumberOfWords_temp2+1)*16;
		var lWordArray=Array(lNumberOfWords-1);
		var lBytePosition = 0;
		var lByteCount = 0;
		while ( lByteCount < lMessageLength ) {
			lWordCount = (lByteCount-(lByteCount % 4))/4;
			lBytePosition = (lByteCount % 4)*8;
			lWordArray[lWordCount] = (lWordArray[lWordCount] | (string.charCodeAt(lByteCount)<<lBytePosition));
			lByteCount++;
		}
		lWordCount = (lByteCount-(lByteCount % 4))/4;
		lBytePosition = (lByteCount % 4)*8;
		lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80<<lBytePosition);
		lWordArray[lNumberOfWords-2] = lMessageLength<<3;
		lWordArray[lNumberOfWords-1] = lMessageLength>>>29;
		return lWordArray;
	};
 
	function WordToHex(lValue) {
		var WordToHexValue="",WordToHexValue_temp="",lByte,lCount;
		for (lCount = 0;lCount<=3;lCount++) {
			lByte = (lValue>>>(lCount*8)) & 255;
			WordToHexValue_temp = "0" + lByte.toString(16);
			WordToHexValue = WordToHexValue + WordToHexValue_temp.substr(WordToHexValue_temp.length-2,2);
		}
		return WordToHexValue;
	};
 
	function Utf8Encode(string) {
		string = string.replace(/\r\n/g,"\n");
		var utftext = "";
 
		for (var n = 0; n < string.length; n++) {
 
			var c = string.charCodeAt(n);
 
			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
 
		}
 
		return utftext;
	};
 
	var x=Array();
	var k,AA,BB,CC,DD,a,b,c,d;
	var S11=7, S12=12, S13=17, S14=22;
	var S21=5, S22=9 , S23=14, S24=20;
	var S31=4, S32=11, S33=16, S34=23;
	var S41=6, S42=10, S43=15, S44=21;
 
	string = Utf8Encode(string);
 
	x = ConvertToWordArray(string);
 
	a = 0x67452301; b = 0xEFCDAB89; c = 0x98BADCFE; d = 0x10325476;
 
	for (k=0;k<x.length;k+=16) {
		AA=a; BB=b; CC=c; DD=d;
		a=FF(a,b,c,d,x[k+0], S11,0xD76AA478);
		d=FF(d,a,b,c,x[k+1], S12,0xE8C7B756);
		c=FF(c,d,a,b,x[k+2], S13,0x242070DB);
		b=FF(b,c,d,a,x[k+3], S14,0xC1BDCEEE);
		a=FF(a,b,c,d,x[k+4], S11,0xF57C0FAF);
		d=FF(d,a,b,c,x[k+5], S12,0x4787C62A);
		c=FF(c,d,a,b,x[k+6], S13,0xA8304613);
		b=FF(b,c,d,a,x[k+7], S14,0xFD469501);
		a=FF(a,b,c,d,x[k+8], S11,0x698098D8);
		d=FF(d,a,b,c,x[k+9], S12,0x8B44F7AF);
		c=FF(c,d,a,b,x[k+10],S13,0xFFFF5BB1);
		b=FF(b,c,d,a,x[k+11],S14,0x895CD7BE);
		a=FF(a,b,c,d,x[k+12],S11,0x6B901122);
		d=FF(d,a,b,c,x[k+13],S12,0xFD987193);
		c=FF(c,d,a,b,x[k+14],S13,0xA679438E);
		b=FF(b,c,d,a,x[k+15],S14,0x49B40821);
		a=GG(a,b,c,d,x[k+1], S21,0xF61E2562);
		d=GG(d,a,b,c,x[k+6], S22,0xC040B340);
		c=GG(c,d,a,b,x[k+11],S23,0x265E5A51);
		b=GG(b,c,d,a,x[k+0], S24,0xE9B6C7AA);
		a=GG(a,b,c,d,x[k+5], S21,0xD62F105D);
		d=GG(d,a,b,c,x[k+10],S22,0x2441453);
		c=GG(c,d,a,b,x[k+15],S23,0xD8A1E681);
		b=GG(b,c,d,a,x[k+4], S24,0xE7D3FBC8);
		a=GG(a,b,c,d,x[k+9], S21,0x21E1CDE6);
		d=GG(d,a,b,c,x[k+14],S22,0xC33707D6);
		c=GG(c,d,a,b,x[k+3], S23,0xF4D50D87);
		b=GG(b,c,d,a,x[k+8], S24,0x455A14ED);
		a=GG(a,b,c,d,x[k+13],S21,0xA9E3E905);
		d=GG(d,a,b,c,x[k+2], S22,0xFCEFA3F8);
		c=GG(c,d,a,b,x[k+7], S23,0x676F02D9);
		b=GG(b,c,d,a,x[k+12],S24,0x8D2A4C8A);
		a=HH(a,b,c,d,x[k+5], S31,0xFFFA3942);
		d=HH(d,a,b,c,x[k+8], S32,0x8771F681);
		c=HH(c,d,a,b,x[k+11],S33,0x6D9D6122);
		b=HH(b,c,d,a,x[k+14],S34,0xFDE5380C);
		a=HH(a,b,c,d,x[k+1], S31,0xA4BEEA44);
		d=HH(d,a,b,c,x[k+4], S32,0x4BDECFA9);
		c=HH(c,d,a,b,x[k+7], S33,0xF6BB4B60);
		b=HH(b,c,d,a,x[k+10],S34,0xBEBFBC70);
		a=HH(a,b,c,d,x[k+13],S31,0x289B7EC6);
		d=HH(d,a,b,c,x[k+0], S32,0xEAA127FA);
		c=HH(c,d,a,b,x[k+3], S33,0xD4EF3085);
		b=HH(b,c,d,a,x[k+6], S34,0x4881D05);
		a=HH(a,b,c,d,x[k+9], S31,0xD9D4D039);
		d=HH(d,a,b,c,x[k+12],S32,0xE6DB99E5);
		c=HH(c,d,a,b,x[k+15],S33,0x1FA27CF8);
		b=HH(b,c,d,a,x[k+2], S34,0xC4AC5665);
		a=II(a,b,c,d,x[k+0], S41,0xF4292244);
		d=II(d,a,b,c,x[k+7], S42,0x432AFF97);
		c=II(c,d,a,b,x[k+14],S43,0xAB9423A7);
		b=II(b,c,d,a,x[k+5], S44,0xFC93A039);
		a=II(a,b,c,d,x[k+12],S41,0x655B59C3);
		d=II(d,a,b,c,x[k+3], S42,0x8F0CCC92);
		c=II(c,d,a,b,x[k+10],S43,0xFFEFF47D);
		b=II(b,c,d,a,x[k+1], S44,0x85845DD1);
		a=II(a,b,c,d,x[k+8], S41,0x6FA87E4F);
		d=II(d,a,b,c,x[k+15],S42,0xFE2CE6E0);
		c=II(c,d,a,b,x[k+6], S43,0xA3014314);
		b=II(b,c,d,a,x[k+13],S44,0x4E0811A1);
		a=II(a,b,c,d,x[k+4], S41,0xF7537E82);
		d=II(d,a,b,c,x[k+11],S42,0xBD3AF235);
		c=II(c,d,a,b,x[k+2], S43,0x2AD7D2BB);
		b=II(b,c,d,a,x[k+9], S44,0xEB86D391);
		a=AddUnsigned(a,AA);
		b=AddUnsigned(b,BB);
		c=AddUnsigned(c,CC);
		d=AddUnsigned(d,DD);
	}
 
	var temp = WordToHex(a)+WordToHex(b)+WordToHex(c)+WordToHex(d);
 
	return temp.toLowerCase();
}


/* Generic AJAX functions */
// Common function to initialize XML Http Request object
function getHttpRequestObject()
{
  // Define and initialize as false
  var xmlHttpRequst = false;
 
  // Mozilla/Safari/Non-IE
    if (window.XMLHttpRequest){
        xmlHttpRequst = new XMLHttpRequest();
    } // IE
    else if (window.ActiveXObject)
  {
        xmlHttpRequst = new ActiveXObject("Microsoft.XMLHTTP");
    }
  return xmlHttpRequst;
}
 
// Does the AJAX call to URL specific with rest of the parameters
function doAjax(url, method, async, responseHandler, data)
{
  // Set the variables
  url = url || "";
  method = method || "GET";
  async = async || true;
  data = data || null;
 
  if(url == "")
  {
    alert("URL can not be null/blank");
    return false;
  }
  var xmlHttpRequst = getHttpRequestObject();
 
  // If AJAX supported
  if(xmlHttpRequst != false)
  {
    // Open Http Request connection
    if(method == "GET")
    {
      url = url + "?" + data;
      data = null;
    }
    xmlHttpRequst.open(method, url, async);
    // Set request header (optional if GET method is used)
    if(method == "POST")
    {
      xmlHttpRequst.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    }
    // Assign (or define) response-handler/callback when ReadyState is changed.
    xmlHttpRequst.onreadystatechange = responseHandler;
    // Send data
    xmlHttpRequst.send(data);
  }
  else
  {
    alert("Please use browser with Ajax support.!");
  }
}
window.onload=function(){ checkUrl(); addBeesocial(); addPromos(); };
