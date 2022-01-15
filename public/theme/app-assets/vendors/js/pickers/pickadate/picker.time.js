!function(e){"function"==typeof define&&define.amd?define(["./picker","jquery"],e):"object"==typeof exports?module.exports=e(require("./picker.js"),require("jquery")):e(Picker,jQuery)}((function(e,t){var i,r=60,n=1440,a=e._;function s(e,t){var i,r=this,n=e.$node[0].value,a=e.$node.data("value"),s=a||n,o=a?t.formatSubmit:t.format;r.settings=t,r.$node=e.$node,r.queue={interval:"i",min:"measure create",max:"measure create",now:"now create",select:"parse create validate",highlight:"parse create validate",view:"parse create validate",disable:"deactivate",enable:"activate"},r.item={},r.item.clear=null,r.item.interval=t.interval||30,r.item.disable=(t.disable||[]).slice(0),r.item.enable=-(!0===(i=r.item.disable)[0]?i.shift():-1),r.set("min",t.min).set("max",t.max).set("now"),s?r.set("select",s,{format:o}):r.set("select",null).set("highlight",r.item.now),r.key={40:1,38:-1,39:1,37:-1,go:function(e){r.set("highlight",r.item.highlight.pick+e*r.item.interval,{interval:e*r.item.interval}),this.render()}},e.on("render",(function(){var i=e.$root.children(),r=i.find("."+t.klass.viewset),n=function(e){return["webkit","moz","ms","o",""].map((function(t){return(t?"-"+t+"-":"")+e}))},a=function(e,t){n("transform").map((function(i){e.css(i,t)})),n("transition").map((function(i){e.css(i,t)}))};r.length&&(a(i,"none"),i[0].scrollTop=~~r.position().top-2*r[0].clientHeight,a(i,""))}),1).on("open",(function(){e.$root.find("button").attr("disabled",!1)}),1).on("close",(function(){e.$root.find("button").attr("disabled",!0)}),1)}s.prototype.set=function(e,t,i){var r=this,n=r.item;return null===t?("clear"==e&&(e="select"),n[e]=t,r):(n["enable"==e?"disable":"flip"==e?"enable":e]=r.queue[e].split(" ").map((function(n){return t=r[n](e,t,i)})).pop(),"select"==e?r.set("highlight",n.select,i):"highlight"==e?r.set("view",n.highlight,i):"interval"==e?r.set("min",n.min,i).set("max",n.max,i):e.match(/^(flip|min|max|disable|enable)$/)&&(n.select&&r.disabled(n.select)&&r.set("select",t,i),n.highlight&&r.disabled(n.highlight)&&r.set("highlight",t,i),"min"==e&&r.set("max",n.max,i)),r)},s.prototype.get=function(e){return this.item[e]},s.prototype.create=function(e,i,s){var o=this;return i=void 0===i?e:i,a.isDate(i)&&(i=[i.getHours(),i.getMinutes()]),t.isPlainObject(i)&&a.isInteger(i.pick)?i=i.pick:t.isArray(i)?i=+i[0]*r+ +i[1]:a.isInteger(i)||(i=o.now(e,i,s)),"max"==e&&i<o.item.min.pick&&(i+=n),"min"!=e&&"max"!=e&&(i-o.item.min.pick)%o.item.interval!=0&&(i+=o.item.interval),{hour:~~(24+(i=o.normalize(e,i,s))/r)%24,mins:(r+i%r)%r,time:(n+i)%n,pick:i%n}},s.prototype.createRange=function(e,i){var r=this,n=function(e){return!0===e||t.isArray(e)||a.isDate(e)?r.create(e):e};return a.isInteger(e)||(e=n(e)),a.isInteger(i)||(i=n(i)),a.isInteger(e)&&t.isPlainObject(i)?e=[i.hour,i.mins+e*r.settings.interval]:a.isInteger(i)&&t.isPlainObject(e)&&(i=[e.hour,e.mins+i*r.settings.interval]),{from:n(e),to:n(i)}},s.prototype.withinRange=function(e,t){return e=this.createRange(e.from,e.to),t.pick>=e.from.pick&&t.pick<=e.to.pick},s.prototype.overlapRanges=function(e,t){var i=this;return e=i.createRange(e.from,e.to),t=i.createRange(t.from,t.to),i.withinRange(e,t.from)||i.withinRange(e,t.to)||i.withinRange(t,e.from)||i.withinRange(t,e.to)},s.prototype.now=function(e,t){var i,n=this.item.interval,s=new Date,o=s.getHours()*r+s.getMinutes();return o-=o%n,i=t<0&&n*t+o<=-n,o+="min"==e&&i?0:n,a.isInteger(t)&&(o+=n*(i&&"max"!=e?t+1:t)),o},s.prototype.normalize=function(e,t){var i=this.item.interval,r=this.item.min&&this.item.min.pick||0;return t-="min"==e?0:(t-r)%i},s.prototype.measure=function(e,i,r){var n=this;return i||(i="min"==e?[0,0]:[23,59]),"string"==typeof i?i=n.parse(e,i):!0===i||a.isInteger(i)?i=n.now(e,i,r):t.isPlainObject(i)&&a.isInteger(i.pick)&&(i=n.normalize(e,i.pick,r)),i},s.prototype.validate=function(e,t,i){var r=this,n=i&&i.interval?i.interval:r.item.interval;return r.disabled(t)&&(t=r.shift(t,n)),t=r.scope(t),r.disabled(t)&&(t=r.shift(t,-1*n)),t},s.prototype.disabled=function(e){var i=this,r=i.item.disable.filter((function(r){return a.isInteger(r)?e.hour==r:t.isArray(r)||a.isDate(r)?e.pick==i.create(r).pick:t.isPlainObject(r)?i.withinRange(r,e):void 0}));return r=r.length&&!r.filter((function(e){return t.isArray(e)&&"inverted"==e[2]||t.isPlainObject(e)&&e.inverted})).length,-1===i.item.enable?!r:r||e.pick<i.item.min.pick||e.pick>i.item.max.pick},s.prototype.shift=function(e,t){var i=this,r=i.item.min.pick,n=i.item.max.pick;for(t=t||i.item.interval;i.disabled(e)&&!((e=i.create(e.pick+=t)).pick<=r||e.pick>=n););return e},s.prototype.scope=function(e){var t=this.item.min.pick,i=this.item.max.pick;return this.create(e.pick>i?i:e.pick<t?t:e)},s.prototype.parse=function(e,t,i){var n,s,o,l,c,m=this,u={};if(!t||"string"!=typeof t)return t;for(l in i&&i.format||((i=i||{}).format=m.settings.format),m.formats.toArray(i.format).map((function(e){var i,r=m.formats[e],n=r?a.trigger(r,m,[t,u]):e.replace(/^!/,"").length;r&&(i=t.substr(0,n),u[e]=i.match(/^\d+$/)?+i:i),t=t.substr(n)})),u)c=u[l],a.isInteger(c)?l.match(/^(h|hh)$/i)?(n=c,"h"!=l&&"hh"!=l||(n%=12)):"i"==l&&(s=c):l.match(/^a$/i)&&c.match(/^p/i)&&("h"in u||"hh"in u)&&(o=!0);return(o?n+12:n)*r+s},s.prototype.formats={h:function(e,t){return e?a.digits(e):t.hour%12||12},hh:function(e,t){return e?2:a.lead(t.hour%12||12)},H:function(e,t){return e?a.digits(e):""+t.hour%24},HH:function(e,t){return e?a.digits(e):a.lead(t.hour%24)},i:function(e,t){return e?2:a.lead(t.mins)},a:function(e,t){return e?4:720>t.time%n?"a.m.":"p.m."},A:function(e,t){return e?2:720>t.time%n?"AM":"PM"},toArray:function(e){return e.split(/(h{1,2}|H{1,2}|i|a|A|!.)/g)},toString:function(e,t){var i=this;return i.formats.toArray(e).map((function(e){return a.trigger(i.formats[e],i,[0,t])||e.replace(/^!/,"")})).join("")}},s.prototype.isTimeExact=function(e,i){var r=this;return a.isInteger(e)&&a.isInteger(i)||"boolean"==typeof e&&"boolean"==typeof i?e===i:(a.isDate(e)||t.isArray(e))&&(a.isDate(i)||t.isArray(i))?r.create(e).pick===r.create(i).pick:!(!t.isPlainObject(e)||!t.isPlainObject(i))&&(r.isTimeExact(e.from,i.from)&&r.isTimeExact(e.to,i.to))},s.prototype.isTimeOverlap=function(e,i){var r=this;return a.isInteger(e)&&(a.isDate(i)||t.isArray(i))?e===r.create(i).hour:a.isInteger(i)&&(a.isDate(e)||t.isArray(e))?i===r.create(e).hour:!(!t.isPlainObject(e)||!t.isPlainObject(i))&&r.overlapRanges(e,i)},s.prototype.flipEnable=function(e){var t=this.item;t.enable=e||(-1==t.enable?1:-1)},s.prototype.deactivate=function(e,i){var r=this,n=r.item.disable.slice(0);return"flip"==i?r.flipEnable():!1===i?(r.flipEnable(1),n=[]):!0===i?(r.flipEnable(-1),n=[]):i.map((function(e){for(var i,s=0;s<n.length;s+=1)if(r.isTimeExact(e,n[s])){i=!0;break}i||(a.isInteger(e)||a.isDate(e)||t.isArray(e)||t.isPlainObject(e)&&e.from&&e.to)&&n.push(e)})),n},s.prototype.activate=function(e,i){var r=this,n=r.item.disable,s=n.length;return"flip"==i?r.flipEnable():!0===i?(r.flipEnable(1),n=[]):!1===i?(r.flipEnable(-1),n=[]):i.map((function(e){var i,o,l,c;for(l=0;l<s;l+=1){if(o=n[l],r.isTimeExact(o,e)){i=n[l]=null,c=!0;break}if(r.isTimeOverlap(o,e)){t.isPlainObject(e)?(e.inverted=!0,i=e):t.isArray(e)?(i=e)[2]||i.push("inverted"):a.isDate(e)&&(i=[e.getFullYear(),e.getMonth(),e.getDate(),"inverted"]);break}}if(i)for(l=0;l<s;l+=1)if(r.isTimeExact(n[l],e)){n[l]=null;break}if(c)for(l=0;l<s;l+=1)if(r.isTimeOverlap(n[l],e)){n[l]=null;break}i&&n.push(i)})),n.filter((function(e){return null!=e}))},s.prototype.i=function(e,t){return a.isInteger(t)&&t>0?t:this.item.interval},s.prototype.nodes=function(e){var t=this,i=t.settings,r=t.item.select,n=t.item.highlight,s=t.item.view,o=t.item.disable;return a.node("ul",a.group({min:t.item.min.pick,max:t.item.max.pick,i:t.item.interval,node:"li",item:function(e){var l,c=(e=t.create(e)).pick,m=r&&r.pick==c,u=n&&n.pick==c,p=o&&t.disabled(e),f=a.trigger(t.formats.toString,t,[i.format,e]);return[a.trigger(t.formats.toString,t,[a.trigger(i.formatLabel,t,[e])||i.format,e]),(l=[i.klass.listItem],m&&l.push(i.klass.selected),u&&l.push(i.klass.highlighted),s&&s.pick==c&&l.push(i.klass.viewset),p&&l.push(i.klass.disabled),l.join(" ")),"data-pick="+e.pick+" "+a.ariaAttr({role:"option",label:f,selected:!(!m||t.$node.val()!==f)||null,activedescendant:!!u||null,disabled:!!p||null})]}})+a.node("li",a.node("button",i.clear,i.klass.buttonClear,"type=button data-clear=1"+(e?"":" disabled")+" "+a.ariaAttr({controls:t.$node[0].id})),"",a.ariaAttr({role:"presentation"})),i.klass.list,a.ariaAttr({role:"listbox",controls:t.$node[0].id}))},s.defaults={clear:"Clear",format:"h:i A",interval:30,closeOnSelect:!0,closeOnClear:!0,updateInput:!0,klass:{picker:(i=e.klasses().picker)+" "+i+"--time",holder:i+"__holder",list:i+"__list",listItem:i+"__list-item",disabled:i+"__list-item--disabled",selected:i+"__list-item--selected",highlighted:i+"__list-item--highlighted",viewset:i+"__list-item--viewset",now:i+"__list-item--now",buttonClear:i+"__button--clear"}},e.extend("pickatime",s)}));