var gapi=window.gapi=window.gapi||{};(function(){var k=void 0,n=!0,s=null,t=!1,aa=encodeURIComponent,u=window,ba=parseInt,v=document,w="push",x="test",z="replace",A="indexOf",B="createElement",C="setAttribute",ca="getElementsByTagName",D="length",da="size",ea="split",E="location",F="call",H="getAttribute",I="href",fa="action",J="apply",K="join",L="toLowerCase";var M=u,N=v,O=M[E],ga=function(){},ha=/\[native code\]/,P=function(a,b,c){return a[b]=a[b]||c},ia=function(a){for(var b=0;b<this[D];b++)if(this[b]===a)return b;return-1},ka=/&/g,la=/</g,ma=/>/g,na=/"/g,oa=/'/g,pa=function(a){return(""+a)[z](ka,"&amp;")[z](la,"&lt;")[z](ma,"&gt;")[z](na,"&quot;")[z](oa,"&#39;")},Q=function(){var a;if((a=Object.create)&&ha[x](a))a=a(s);else{a={};for(var b in a)a[b]=k}return a},R=function(a,b){return Object.prototype.hasOwnProperty[F](a,b)},S=function(a,b){var a=a||
{},c;for(c in a)R(a,c)&&(b[c]=a[c])},T=P(M,"gapi",{});var qa=function(a,b,c){b=RegExp("([?#].*&|[?#])"+b+"=([^&#]*)","g");if(a=a&&b.exec(a))try{c=decodeURIComponent(a[2])}catch(d){}return c},ra=/^([^?#]*)(\?([^#]*))?(\#(.*))?$/,sa=function(a){var b=[];if(a)for(var c in a)R(a,c)&&a[c]!=s&&b[w](aa(c)+"="+aa(a[c]));return b},ta=function(a,b,c){var a=a.match(ra),d=Q();d.n=a[1];d.d=a[3]?[a[3]]:[];d.c=a[5]?[a[5]]:[];d.d[w][J](d.d,sa(b));d.c[w][J](d.c,sa(c));return d.n+(0<d.d[D]?"?"+d.d[K]("&"):"")+(0<d.c[D]?"#"+d.c[K]("&"):"")};var ua=function(a,b,c){if(M[b+"EventListener"])M[b+"EventListener"]("message",a,t);else if(M[c+"tachEvent"])M[c+"tachEvent"]("onmessage",a)};var U;U=P(M,"___jsl",Q());P(U,"I",0);var va=function(a){return qa(a,"jsh",U.h)},wa=function(a){return P(P(U,"H",Q()),a,Q())};var xa=Q(),V=[],W;W={a:"callback",l:"sync",k:"config",b:"_c",g:"h",e:"platform",i:"ds",j:"jsl"};V[w]([W.j,function(a){for(var b in a)if(R(a,b)){var c=a[b];"object"==typeof c?U[b]=P(U,b,[]).concat(c):P(U,b,c)}if(a=a.u)b=P(U,"us",[]),b[w](a),(c=/^https:(.*)$/.exec(a))&&b[w]("http:"+c[1]),P(U,"u",a)}]);xa.m=function(a){var b=U.ms||"https://apis.google.com",a=a[0];if(!a||0<=a[A](".."))throw"Bad hint";return b+a};
var ya=function(a){return a[K](",")[z](/\./g,"_")[z](/-/g,"_")},za=function(a,b){for(var c=[],d=0;d<a[D];++d){var e=a[d];e&&0>ia[F](b,e)&&c[w](e)}return c},Aa=function(a){var b=N[B]("script");b[C]("src",a);b.async="true";a=N[ca]("script")[0];a.parentNode.insertBefore(b,a)},Ba=function(a,b){var c=b||{};"function"==typeof b&&(c={},c[W.a]=b);var d=c,e=d&&d[W.b];if(e)for(var f=0;f<V[D];f++){var l=V[f][0],h=V[f][1];h&&R(e,l)&&h(e[l],a,d)}if(!(d=c[W.g]))if(d=va(O[I]),!d)throw"Bad hint";var i=d,m=c[W.a],
j=c[W.k],d=P(wa(i),"r",[]).sort(),o=P(wa(i),"L",[]).sort(),g=function(a){o[w][J](o,q);var b=((T||{}).config||{}).update;b?b(j):j&&P(U,"cu",[])[w](j);if(a){b=i===va(O[I])?P(T,"_",Q()):Q();b=P(wa(i),"_",b);a(b)}m&&m();return 1};if(a){e=a[ea](":").sort();f=[];l=k;for(h=0;h<e[D];h++){var r=e[h];r!=l&&f[w](r);l=r}e=f}else e=[];var q=za(e,o);if(!q[D])return g();var q=za(e,d),y=U.I++,p="loaded_"+y;T[p]=function(a){if(!a)return 0;var b=function(){T[p]=s;return g(a)};if(T["loaded_"+(y-1)])T[p]=b;else for(b();b=
T["loaded_"+ ++y];)if(!b())break};if(!q[D])return T[p](ga);e=i[ea](";");e=(f=xa[e.shift()])&&f(e);if(!e)throw"Bad hint:"+i;e=e[z]("__features__",ya(q))[z](/\/$/,"")+(d[D]?"/ed=1/exm="+ya(d):"")+("/cb=gapi."+p);d[w][J](d,q);c[W.l]||M.___gapisync?(c=e,"loading"!=N.readyState?Aa(c):N.write(['<script src="',c,'"><\/script>'][K](""))):Aa(e)};T.load=Ba;var Ca=function(){return u.___jsl=u.___jsl||{}},Da=function(a){var b=Ca();b[a]=b[a]||[];return b[a]},X=function(a){var b=Ca();b.cfg=!a&&b.cfg||{};return b.cfg},Ea=function(a){return"object"===typeof a&&/\[native code\]/[x](a[w])},Y=function(a,b){if(b)for(var c in b)b.hasOwnProperty(c)&&(a[c]&&b[c]&&"object"===typeof a[c]&&"object"===typeof b[c]&&!Ea(a[c])&&!Ea(b[c])?Y(a[c],b[c]):b[c]&&"object"===typeof b[c]?(a[c]=Ea(b[c])?[]:{},Y(a[c],b[c])):a[c]=b[c])},Fa=function(a){if(a){var b="",c=a.nodeType;
if(3==c||4==c)b=a.nodeValue;else if(a.innerText)b=a.innerText;else if(a.innerHTML)b=a.innerHTML;else if(a.firstChild){b=[];for(a=a.firstChild;a;a=a.nextSibling)b[w](Fa(a));b=b[K]("")}return b}},Z=function(a){if(!a)return X();for(var a=a[ea]("/"),b=X(),c=0,d=a[D];b&&"object"===typeof b&&c<d;++c)b=b[a[c]];return c===a[D]&&b!==k?b:k};var $=u,Ga=v;var Ha,Ia=Q(),Ja=P(U,"FW",[]),Ka=function(){},La=function(a,b){for(var c=Q(),d=N[ca]("*"),e=0;e<d[D];++e){var f=d[e],l=f.nodeName[L](),h=k;if(!f[H]("data-gapiscan")&&(0==l[A]("g:")?h=l.substr(2):(l=""+(f.className||f[H]("class")))&&0==l[A]("g-")&&(h=l.substr(2)),h&&Ia[h]))f[C]("data-gapiscan",n),P(c,h,[])[w](f)}var i=[],d="explicit"==Z("parsetags");if(b)for(var m in c){e=c[m];for(f=0;f<e[D];f++)e[f][C]("data-onload",n)}for(var j in c)Ja[w](j),(T[j]&&T[j].go||d)&&i[w](j);m={};if(0<i[D])var o=a,a=function(){for(var a=
0;a<i[D];a++)T[i[a]].go();o&&o()};m[W.a]=a;j=Ja[K](":");Ba(j,m);Ka(j,c,Ha)};
V[w]([W.e,function(a,b,c){Ha=c;b&&Ja[w](b);for(b=0;b<a[D];b++)Ia[a[b]]=1;if(c)for(var b=P(c[W.b],W.i,[]),d=0;d<a[D];d++)b[w](["gapi",a[d],"go"][K](".")),b[w](["gapi",a[d],"render"][K]("."));if(a=u.__GOOGLEAPIS)P(U,"ci",[])[w](a),u.__GOOGLEAPIS=k;X(n);b=u.___gcfg;a=Da("cu");b&&b!==u.___gu&&(d={},Y(d,b),a[w](d),u.___gu=b);var b=Da("cu"),e=v.scripts||v[ca]("script")||[],d=[],f=[],l=Ca().u;l&&f[w](l);Ca().us&&f[w][J](f,Ca().us);for(l=0;l<e[D];++l)for(var h=e[l],i=0;i<f[D];++i)h.src&&0==h.src[A](f[i])&&
d[w](h);0==d[D]&&e[e[D]-1].src&&d[w](e[e[D]-1]);for(e=0;e<d[D];++e)if(!d[e][H]("gapi_processed")){d[e][C]("gapi_processed",n);if(f=Fa(d[e])){for(;0==f.charCodeAt(f[D]-1);)f=f.substring(0,f[D]-1);l=k;try{l=(new Function("return ("+f+"\n)"))()}catch(m){}if("object"===typeof l)f=l;else{try{l=(new Function("return ({"+f+"\n})"))()}catch(j){}f="object"===typeof l?l:{}}}else f=k;f&&b[w](f)}e=Da("cd");b=0;for(d=e[D];b<d;++b)Y(X(),e[b]);e=Da("ci");b=0;for(d=e[D];b<d;++b)Y(X(),e[b]);b=0;for(d=a[D];b<d;++b)Y(X(),
a[b]);if("explicit"!=Z("parsetags")){var o;if(c){var g=c[W.a];g&&(o=function(){M.setTimeout(g,0)},c[W.a]=k)}var r=function(){La(o,n)};if("complete"===Ga.readyState)r();else{var q=t,y=function(){if(!q){q=n;return r[J](this,arguments)}};$.addEventListener?($.addEventListener("load",y,t),$.addEventListener("DOMContentLoaded",y,t)):$.attachEvent&&($.attachEvent("onreadystatechange",function(){Ga.readyState==="complete"&&y[J](this,arguments)}),$.attachEvent("onload",y))}La(k,n)}}]);P(T,W.e,{}).go=function(a){La(a,t)};V[w]([W.i,function(a,b,c){for(var d=[].slice,b=0,e;e=a[b];++b){for(var f=M,l=e[ea]("."),h=0;h<l[D]-1;++h)f=P(f,l[h],{});h=l[h];f[h]||(f[h]=function(){var a=3==l[D]?l[l[D]-2]:"",b=c[W.b][W.e],f="gapi"==l[0]&&b&&0<=ia[F](b,a),h=[],b=e;P(U,"df",Q())[b]=function(a){for(var b=0;h[b];++b)a[J](M,h[b])};return function(){h[w](d[F](arguments,0));f&&Ba(a)}}())}}]);var Ma=/^\{h\:'/,Na=/^!_/,Oa=function(a,b){a=""+a;if(Ma[x](a))return n;a=a[z](Na,"");if(!/^\{/[x](a))return t;try{var c=u.JSON.parse(a)}catch(d){return t}if(!c)return t;var e=c.f;return c.s&&e&&-1!=ia[F](b,e)?n:t};var Pa=["left","right"],Qa="inline bubble none only pp vertical-bubble".split(" "),Ra=function(a){var b=v[B]("div"),c=v[B]("a");c.href=a;b.appendChild(c);b.innerHTML=b.innerHTML;return b.firstChild[I]},Sa=function(){return u[E].origin||u[E].protocol+"//"+u[E].host},Ta=function(a,b,c,d){if(a)a=Ra(a);else a:{a=d||"canonical";b=v[ca]("link");c=0;for(d=b[D];c<d;c++){var e=b[c],f=e[H]("rel");if(f&&f[L]()==a&&(e=e[H]("href")))if(e=Ra(e)){a=e;break a}}a=u[E][I]}return a},Wa=function(a,b){if("string"==typeof a){var c;
for(c=0;c<b[D];c++)if(b[c]==a[L]())return a[L]()}},Xa=function(a){return Wa(a,Pa)},Ya=function(a){return Wa(a,Qa)},Za={tall:{"true":{width:50,height:60},"false":{width:50,height:24}},small:{"false":{width:24,height:15},"true":{width:70,height:15}},medium:{"false":{width:32,height:20},"true":{width:90,height:20}},standard:{"false":{width:38,height:24},"true":{width:106,height:24}}},$a=function(a){return"string"==typeof a?""!=a&&"0"!=a&&"false"!=a[L]():!!a},ab=function(a){var b=ba(a,10);if(b==a)return""+
b},bb=function(a){if($a(a))return"true"},cb=function(a){return"string"==typeof a&&Za[a[L]()]?a[L]():"standard"},db={href:[Ta,"url"],width:[ab],size:[cb],resize:[bb],autosize:[bb],count:[function(a,b){return"tall"==cb(b[da])?"true":b.count==s||$a(b.count)?"true":"false"}],db:[function(a,b,c){a==s&&c&&(a=c.db,a==s&&(a=c.gwidget&&c.gwidget.db));return $a(a)?1:k}],ecp:[function(a,b,c){a==s&&c&&(a=c.ecp,a==s&&(a=c.gwidget&&c.gwidget.ecp));if($a(a))return"true"}],textcolor:[function(a){if("string"==typeof a&&
a.match(/^[0-9A-F]{6}$/i))return a}],drm:[bb],ad:[bb],cr:[ab],ag:[ab],"fr-ai":[],"fr-sigh":[]};var eb={badge:{width:300,height:131},smallbadge:{width:300,height:69}},fb=function(a){return"string"==typeof a&&eb[a[L]()]?a[L]():"badge"};var gb={allowtransparency:"true",frameborder:0,hspace:0,marginheight:0,marginwidth:0,scrolling:"no",style:"",tabindex:"0",vspace:0,width:"100%"},hb=0;var ib=/:([a-zA-Z_]+):/g,jb=["onPlusOne","_ready","_close,_open","_resizeMe","_renderstart"],kb={},lb=s,mb=P(U,"WI",Q()),nb=function(){var a=Z("googleapis.config/sessionIndex");a==s&&(a=u.__X_GOOG_AUTHUSER);if(a==s){var b=u.google;b&&(a=b.authuser)}a==s&&(a=k,a==s&&(a=u[E][I]),a=a?qa(a,"authuser"):s);return a==s?s:""+a},ob=function(a,b){if(!lb){var c=Z("iframes/:socialhost:"),d=nb()||"0",e=nb();lb={socialhost:c,session_index:d,session_prefix:e!==k&&e!==s&&""!==e?"u/"+e+"/":""}}return lb[b]||""},pb=
function(a,b){var c={};S(b,c);var d;d=Ta(c[I],0,0,b[fa]?s:"publisher");c.url=d;delete c[I];c.hl=Z("lang")||"en-US";c.size=fb(b[da]);d=b.width;c.width=!d?b[fa]?k:eb[fb(b[da])].width:ba(d);d=b.height;c.height=!d?b[fa]?k:eb[fb(b[da])].height:ba(d);c.origin=Sa();return c},qb=["style","data-gapiscan"],rb=function(a){var b=k;"number"===typeof a?b=a:"string"===typeof a&&(b=ba(a,10));return b};kb.plusone=[function(a,b){var c={};S(db,c);c.source=[s,"source"];c.expandTo=[s,"expandTo"];c.align=[Xa];c.annotation=[Ya];c.origin=[Sa];var d={},e=Z(),f;for(f in c)c.hasOwnProperty(f)&&(d[c[f][1]||f]=(c[f]&&c[f][0]||function(a){return a})(b[f[L]()],b,e));return d}];Ka=function(a,b,c){for(var d=[W.b,W.j,W.g],e=0;e<d[D]&&c;e++)c=c[d[e]];if(c&&!(0==c[A]("n;")&&c!=va(O[I]))){var f=[],l;for(l in b){c=b[l];d=0;for(e=c[D];d<e;d++){var h;var i=l;h=c[d];var m=e;if(h.parentNode){var j;j=h;for(var o=Q(),g=0!=j.nodeName[L]()[A]("g:"),r=0,q=j.attributes[D];r<q;r++){var y=j.attributes[r],p=y.name,y=y.value;0<=ia[F](qb,p)||(g&&0!=p[A]("data-")||"null"===y)||(g&&(p=p.substr(5)),o[p[L]()]=y)}g=o;j=j.style;(r=rb(j&&j.height))&&(g.height=""+r);(j=rb(j&&j.width))&&(g.width=""+
j);j=o;o=i;g=k;g=o;"plus"==o&&j[fa]&&(g=o+"_"+j[fa]);(g=Z("iframes/"+g+"/url"))||(g=":socialhost:/_/widget/render/"+o);o=g[z](ib,ob);g=((kb[i]||[])[0]||pb)(i,j);g.hl=Z("lang")||"en-US";U.ILI&&(g.iloader=1);delete g["data-onload"];r=Z("inline/css");"undefined"!==typeof r&&r>=m&&(g.ic=1);g=m=g;r=/^#|^fr-/;q={};p=k;for(p in g)R(g,p)&&r[x](p)&&(q[p[z](r,"")]=g[p],delete g[p]);var r=g=q,q=i,p=j,y=m,ja=[].concat(jb),G=Z("iframes/"+q+"/methods");"object"===typeof G&&ha[x](G[w])&&(ja=ja.concat(G));G=k;for(G in p)if(R(p,
G)&&/^on/[x](G)&&("plus"!=q||"onconnect"!=G))ja[w](G),delete y[G];r._methods=ja[K](",");o=ta(o,m,g);m=i;i=v[B]("div");h[C]("data-gapistub",n);g=i;P(mb,m,0);m="___"+m+"_"+mb[m]++;g.id=m;i.style.cssText="position:absolute;width:100px;left:-10000px;";i[C]("data-gwattr",sa(j)[K](":"));h.parentNode.insertBefore(i,h);j=o;o=i;h=i={};m=k;g=0;do m=h.id||["I",hb++,"_",(new Date).getTime()][K]("");while(N.getElementById(m)&&5>++g);if(!(5>g))throw Error("Error creating iframe id");h=m;o="string"===typeof o?N.getElementById(o):
o;g=h;m=i;q=O[I];r=Q();(p=qa(q,"_bsh",U.bsh))&&(r._bsh=p);(q=va(q))&&(r.jsh=q);q=k;p=Q();p.id=g;p.parent=O.protocol+"//"+O.host;g=p;m.hintInFragment?S(r,g):q=r;j=ta(j,q,g);m=h;g=i;i=Q();S(gb,i);i.name=i.id=m;S(g.attributes,i);i.src=j;j=k;try{j=N[B]('<iframe frameborder="'+pa(i.frameborder)+'" scrolling="'+pa(i.scrolling)+'" name="'+pa(i.name)+'"/>')}catch(sb){j=N[B]("iframe")}m=k;for(m in i)g=i[m],"style"==m&&"object"===typeof g?S(g,j.style):j[C](m,i[m]);o.innerHTML="";o.appendChild(j);i.allowtransparency&&
(j.allowTransparency=n)}else h=s;h&&f[w](h)}}var Va=function(){ua(Ua,"remove","de")},Ua=function(b){var c=b.data,d=b.origin;Oa(c,f)&&Ba(a,function(){Va();for(var a=P(U,"RPMQ",[]),b=0;b<a[D];b++)a[b]({data:c,origin:d})})};0===f[D]||(!u.JSON||!u.JSON.parse)||(ua(Ua,"add","at"),Ba(a,Va))}};})();
gapi.load("plusone",{callback:window["gapi_onload"],_c:{"platform":["plusone","plus","additnow","card","localreview"],"jsl":{"u":"https://apis.google.com/js/plusone.js","ci":{"inline":{"css":0},"lexps":[34,38,65,36,40,44,15,45,17,48,52,61,60,30],"oauth-flow":{},"report":{},"iframes":{"additnow":{"url":"https://apis.google.com/additnow/additnow.html?bsv=pr"},"plus":{"methods":["onauth"],"url":":socialhost:/u/:session_index:/_/pages/badge?bsv=pr"},":socialhost:":"https://plusone.google.com","configurator":{"url":":socialhost:/:session_prefix:_/plusbuttonconfigurator"},"localreview":{"params":{"url":""},"url":":socialhost:/:session_prefix:_/local/review?bsv=pr"},"plus_circle":{"params":{"url":""},"url":":socialhost:/:session_prefix:_/widget/plus/circle?bsv=pr"},":signuphost:":"https://plus.google.com","plusone":{"preloadUrl":["https://ssl.gstatic.com/s2/oz/images/stars/po/Publisher/sprite4-a67f741843ffc4220554c34bd01bb0bb.png"],"params":{"count":"","url":"","size":""},"url":":socialhost:/:session_prefix:_/+1/fastbutton?bsv=pr"},"plus_share":{"params":{"url":""},"url":":socialhost:/:session_prefix:_/+1/sharebutton?plusShare=true&bsv=pr"}},"isPlusUser":false,"googleapis.config":{"mobilesignupurl":"https://m.google.com/app/plus/oob?"}},"h":"m;/_/apps-static/_/js/gapi/__features__/rt=j/ver=T1mcnm4G0xs.pt_BR./sv=1/am=!rFmBCPi40VqIDfp2cA/d=1/rs=AItRSTNqTb8RA8pdZspymp8lFT3oL-TP7A","fp":"8850c868b7dac9da4dccb71c9b0589be91cc182b"},"ds":["gapi.plusone.go","gapi.plusone.render","gapi.plus.go","gapi.plus.render"],"fp":"8850c868b7dac9da4dccb71c9b0589be91cc182b"}});