var param=document.getElementById("getSelo").src.split("?");var numEmp=param[1];var obj=document.getElementById("seloEbit");var objBanner=document.getElementById("bannerEbit");var objParametros=document.getElementById("ebitParam");var anchor=obj.innerHTML;var span=document.createElement("span");var x=1;var y=1;var flagGenerate=false;var flagGenerateBanner=false;var imgBanner;var urlMi;obj.innerHTML="";imgSelo=new Image();imgBanner=new Image();imgSelo.src="https://a248.e.akamai.net/f/248/52872/0s/img.ebit.com.br/ebitBR/selo/img_"+numEmp+".png";var verifyImage=window.setInterval(generate,1000);var verifyImageBanner=window.setInterval(generateBanner,1000);function generate(){if(imgSelo.complete==true){obj.style.backgroundImage="url(https://a248.e.akamai.net/f/248/52872/0s/img.ebit.com.br/ebitBR/selo/img_"+numEmp+".png)";obj.style.backgroundRepeat="no-repeat";obj.style.width=imgSelo.width+"px";obj.style.height=imgSelo.height+"px";obj.style.display="block";obj.style.overflow="hidden";obj.style.position="relative";obj.title="Avaliado pelos consumidores";if(obj.href.indexOf("/selo")==-1){urlMi=obj.href.substr(obj.href.indexOf("#")+1,obj.href.length);urlMi=isNumericEbit(urlMi);obj.href=obj.href+"/selo"}obj.innerHTML="";span.style.top="-105px";span.style.position="absolute";span.innerHTML=anchor;obj.appendChild(span);flagGenerate=true;killInterval(verifyImage)}if(x==10){killInterval(verifyImage)}x=x+1}function generateBanner(){if(objBanner){var c=objBanner.innerHTML;var b=document.createElement("span");var a=false;imgBanner.src="https://www.ebitempresa.com.br/bitrate/banners/b1"+numEmp+"5.gif";if(imgBanner.complete==true){objBanner.style.backgroundImage="url(https://www.ebitempresa.com.br/bitrate/banners/b1"+numEmp+"5.gif)";if(objParametros){objBanner.href="http://www.ebitempresa.com.br/bitrate/pesquisa1.asp?empresa=16485&"+objParametros.value}else{objBanner.href="http://www.ebitempresa.com.br/bitrate/pesquisa1.asp?empresa=1"+numEmp+"5"}objBanner.style.backgroundRepeat="no-repeat";objBanner.style.width=imgBanner.width+"px";objBanner.style.height=imgBanner.height+"px";objBanner.style.display="block";objBanner.style.overflow="hidden";objBanner.style.position="relative";objBanner.target="_blank";objBanner.innerHTML="";b.style.top="-105px";b.style.position="absolute";b.innerHTML=c;objBanner.appendChild(b);a=true;killInterval(verifyImageBanner)}if(y==10){killInterval(verifyImageBanner)}y=y+1}else{killInterval(verifyImageBanner)}}function killInterval(a){clearInterval(a)}function isNumericEbit(b){validChar="0123456789.,-";for(var a=0;a<b.length;a++){if(validChar.indexOf(b.substr(a,1))<0){return false}}return true}function redir(b){if(urlMi==true){var a=document.getElementById("seloEbit").href;document.getElementById("seloEbit").href="http://www.ebit.com.br/rateloja.asp?PnumNumEmpresa="+numEmp}else{var b=b.replace("#","");document.getElementById("seloEbit").href=b}}generate();generateBanner();try{var h1=document.getElementsByTagName("h1");var h2=document.getElementsByTagName("h2");var referrer=document.referrer;var urlPag=window.location;var titPag=document.title;var aTag=document.getElementsByTagName("a");var ckLoja;var t1=new Date();var t2=new Date();if(flagGenerateBanner=true){ckLoja="S"}else{for(x=0;x<=aTag.length;x++){if(aTag[x]){if(aTag[x].href.indexOf("www.ebitempresa.com.br/bitrate/pesquisa1.asp")>=0){ckLoja="S";break}else{ckLoja="N"}}}if(ckLoja==""){ckLoja="N"}}h1=(h1.length>0?h1[0].innerHTML:"");h2=(h2.length>0?h2[0].innerHTML:"");var __$loc_domain_cookie=".ebit.com.br";var __$loc_data={propriedade:"EB",url_pag:window.location,tit_pag:document.title,ck_pag:ckLoja,h1_pag:h1,h2_pag:h2,referer_pag:referrer};(function(){var b=document.createElement("script");b.type="text/javascript";b.src=("https:"==document.location.protocol?"https://s":"http://c")+".lomadee.com/loc/write.js";var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(b,a)})()}catch(e){};