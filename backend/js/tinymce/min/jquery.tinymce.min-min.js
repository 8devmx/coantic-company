!function(a){function b(){function b(a){"remove"===a&&this.each(function(a,b){var c=e(b);c&&c.remove()}),this.find("span.mceEditor,div.mceEditor").each(function(a,b){var c=tinymce.get(b.id.replace(/_parent$/,""));c&&c.remove()})}function d(a){var c,d=this;if(null!=a)b.call(d),d.each(function(b,c){var d;(d=tinymce.get(c.id))&&d.setContent(a)});else if(d.length>0&&(c=tinymce.get(d[0].id)))return c.getContent()}function e(a){var b=null;return a&&a.id&&f.tinymce&&(b=tinymce.get(a.id)),b}function g(a){return!!(a&&a.length&&f.tinymce&&a.is(":tinymce"))}var h={};a.each(["text","html","val"],function(b,f){var i=h[f]=a.fn[f],j="text"===f;a.fn[f]=function(b){var f=this;if(!g(f))return i.apply(f,arguments);if(b!==c)return d.call(f.filter(":tinymce"),b),i.apply(f.not(":tinymce"),arguments),f;var h="",k=arguments;return(j?f:f.eq(0)).each(function(b,c){var d=e(c);h+=d?j?d.getContent().replace(/<(?:"[^"]*"|'[^']*'|[^'">])*>/g,""):d.getContent({save:!0}):i.apply(a(c),k)}),h}}),a.each(["append","prepend"],function(b,d){var f=h[d]=a.fn[d],i="prepend"===d;a.fn[d]=function(a){var b=this;return g(b)?a!==c?("string"==typeof a&&b.filter(":tinymce").each(function(b,c){var d=e(c);d&&d.setContent(i?a+d.getContent():d.getContent()+a)}),f.apply(b.not(":tinymce"),arguments),b):void 0:f.apply(b,arguments)}}),a.each(["remove","replaceWith","replaceAll","empty"],function(c,d){var e=h[d]=a.fn[d];a.fn[d]=function(){return b.call(this,d),e.apply(this,arguments)}}),h.attr=a.fn.attr,a.fn.attr=function(b,f){var i=this,j=arguments;if(!b||"value"!==b||!g(i))return f!==c?h.attr.apply(i,j):h.attr.apply(i,j);if(f!==c)return d.call(i.filter(":tinymce"),f),h.attr.apply(i.not(":tinymce"),j),i;var k=i[0],l=e(k);return l?l.getContent({save:!0}):h.attr.apply(a(k),j)}}var c,d,e=[],f=window;a.fn.tinymce=function(c){function g(){var d=[],e=0;k||(b(),k=!0),l.each(function(a,b){var f,g=b.id,h=c.oninit;g||(b.id=g=tinymce.DOM.uniqueId()),tinymce.get(g)||(f=new tinymce.Editor(g,c,tinymce.EditorManager),d.push(f),f.on("init",function(){var a,b=h;l.css("visibility",""),h&&++e==d.length&&("string"==typeof b&&(a=-1===b.indexOf(".")?null:tinymce.resolve(b.replace(/\.\w+$/,"")),b=tinymce.resolve(b)),b.apply(a||tinymce,d))}))}),a.each(d,function(a,b){b.render()})}var h,i,j,k,l=this,m="";if(!l.length)return l;if(!c)return window.tinymce?tinymce.get(l[0].id):null;if(l.css("visibility","hidden"),f.tinymce||d||!(h=c.script_url))1===d?e.push(g):g();else{d=1,i=h.substring(0,h.lastIndexOf("/")),-1!=h.indexOf(".min")&&(m=".min"),f.tinymce=f.tinyMCEPreInit||{base:i,suffix:m},-1!=h.indexOf("gzip")&&(j=c.language||"en",h=h+(/\?/.test(h)?"&":"?")+"js=true&core=true&suffix="+escape(m)+"&themes="+escape(c.theme||"modern")+"&plugins="+escape(c.plugins||"")+"&languages="+(j||""),f.tinyMCE_GZ||(f.tinyMCE_GZ={start:function(){function b(a){tinymce.ScriptLoader.markDone(tinymce.baseURI.toAbsolute(a))}b("langs/"+j+".js"),b("themes/"+c.theme+"/theme"+m+".js"),b("themes/"+c.theme+"/langs/"+j+".js"),a.each(c.plugins.split(","),function(a,c){c&&(b("plugins/"+c+"/plugin"+m+".js"),b("plugins/"+c+"/langs/"+j+".js"))})},end:function(){}}));var n=document.createElement("script");n.type="text/javascript",n.onload=n.onreadystatechange=function(b){b=b||window.event,2===d||"load"!=b.type&&!/complete|loaded/.test(n.readyState)||(tinymce.dom.Event.domLoaded=1,d=2,c.script_loaded&&c.script_loaded(),g(),a.each(e,function(a,b){b()}))},n.src=h,document.body.appendChild(n)}return l},a.extend(a.expr[":"],{tinymce:function(a){var b;return a.id&&"tinymce"in window&&(b=tinymce.get(a.id),b&&b.editorManager===tinymce)?!0:!1}})}(jQuery);

