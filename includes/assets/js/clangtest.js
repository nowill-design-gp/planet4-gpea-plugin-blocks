var clang=function(){var t={};function e(){this.buffer=[]}function n(t){this._input=t,this._index=-1,this._buffer=[]}function r(t){this._input=t,this._index=-1,this._buffer=[]}e.prototype.append=function(t){return this.buffer.push(t),this},e.prototype.toString=function(){return this.buffer.join("")};var i,o,c={codex:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(t){for(var r=new e,i=new n(t);i.moveNext();){var o=i.current;i.moveNext();var c=i.current;i.moveNext();var u=i.current,a=o>>2,s=(3&o)<<4|c>>4,h=(15&c)<<2|u>>6,f=63&u;isNaN(c)?h=f=64:isNaN(u)&&(f=64),r.append(this.codex.charAt(a)+this.codex.charAt(s)+this.codex.charAt(h)+this.codex.charAt(f))}return r.toString()},decode:function(t){for(var n=new e,i=new r(t);i.moveNext();){var o=i.current;if(o<128)n.append(String.fromCharCode(o));else if(o>191&&o<224){i.moveNext();var c=i.current;n.append(String.fromCharCode((31&o)<<6|63&c))}else{i.moveNext();c=i.current;i.moveNext();var u=i.current;n.append(String.fromCharCode((15&o)<<12|(63&c)<<6|63&u))}}return n.toString()}};return n.prototype={current:Number.NaN,moveNext:function(){if(this._buffer.length>0)return this.current=this._buffer.shift(),!0;if(this._index>=this._input.length-1)return this.current=Number.NaN,!1;var t=this._input.charCodeAt(++this._index);return 13==t&&10==this._input.charCodeAt(this._index+1)&&(t=10,this._index+=2),t<128?this.current=t:t>127&&t<2048?(this.current=t>>6|192,this._buffer.push(63&t|128)):(this.current=t>>12|224,this._buffer.push(t>>6&63|128),this._buffer.push(63&t|128)),!0}},r.prototype={current:64,moveNext:function(){if(this._buffer.length>0)return this.current=this._buffer.shift(),!0;if(this._index>=this._input.length-1)return this.current=64,!1;var t=c.codex.indexOf(this._input.charAt(++this._index)),e=c.codex.indexOf(this._input.charAt(++this._index)),n=c.codex.indexOf(this._input.charAt(++this._index)),r=c.codex.indexOf(this._input.charAt(++this._index)),i=t<<2|e>>4,o=(15&e)<<4|n>>2,u=(3&n)<<6|r;return this.current=i,64!=n&&this._buffer.push(o),64!=r&&this._buffer.push(u),!0}},t.conversion=(i="",o=function(){var t=window.location.search;"?"==window.location.search[0]&&(t=t.substr(1));for(var e={},n=t.split("&"),r=0;r<n.length;r++){var i=n[r].split("=");2==i.length?e[i[0]]=decodeURIComponent(i[1]):e[i[0]]=!0}if(e.clangct){console.log(e.clangct);arguments.callee.name}},{track:function(t,e){void 0===t&&(t=function(){var t=o();if(t){for(var e=t.split(".");e[1].length%4;)e[1]+="=";var n=c.decode(e[1].replace(/-/g,"+").replace(/_/g,"/")).split(","),r={};for(var i in n)r[n[i]]=1;return r}}()),e=void 0===e?function(){var t=o();if(t)return t.split(".")[0]}():e.split(".")[0];var n="//secure.myclang.com/14/"+i+"."+e+"."+function(t){var e=[];for(var n in t)e.push(n+"="+t[n]);return c.encode(e.join("&")).replace(/\+/g,"-").replace(/\//g,"_").replace(/=/g,"")}(t);try{if(document.getElementsByTagName("body")[0]){var r=document.createElement("img");return r.src=n,void document.getElementsByTagName("body")[0].appendChild(r)}}catch(t){}document.write('<img src="'+n+'" />')},init:function(t){i=t},initLinks:function(){var t=function(){for(var t=document.getElementsByTagName("a"),e=0;e<t.length;e++){var n=t[e],r=n.getAttribute("href");if(r&&!r.match(/(&|\?)clangct=/)&&!r.match(/^#/)&&!r.match(/^mailto:/i)){var i=o();if(i){var c="";-1!=r.indexOf("#")&&(c=r.substr(r.indexOf("#")),r=r.substring(0,r.indexOf("#"))),r=r.match(/\?/)?r+"&clangct="+encodeURIComponent(i):r+"?clangct="+encodeURIComponent(i),""!=c&&(r+=c),n.setAttribute("href",r)}}}};document.getElementsByTagName("body")[0]?t():window.onload=function(t,e){return function(){t&&t(),e()}}(window.onload,t)},formatNumber:function(t,e,n){if(void 0===t)return"";void 0===e&&(e=","),void 0===n&&(n=".");var r=function(t){return arguments.callee.sRE||(arguments.callee.sRE=new RegExp("(\\"+["/",".","*","+","?","|","(",")","[","]","{","}","\\"].join("|\\")+")","g")),t.replace(arguments.callee.sRE,"\\$1")},i=new RegExp("("+r(e)+"|"+r(n)+")","g");return parseFloat(t.replace(i,function(t){return t==e?"":t==n?".":void 0}))}}),t}();
//# sourceMappingURL=maps/clangtest.js.map
