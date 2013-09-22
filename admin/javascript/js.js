/**
 * /javascript/admin.common.js (2009-09-17 14:18:38)
 */
var iwp={lang:{vars:{},get:function(name){return iwp.util.defaultVal(iwp.lang.vars[name],'[Undefined JS Variable '+name+']');},set:function(name,val){if(typeof(name)=='object'){for(i in name){iwp.lang.vars[i]=name[i];}}else{iwp.lang.vars[name]=val;}}},config:{vars:{},get:function(name){return iwp.util.defaultVal(iwp.config.vars[name],'[Undefined JS Config Variable '+name+']');},set:function(name,val){if(typeof(name)=='object'){for(i in name){iwp.config.vars[i]=name[i];}}else{iwp.config.vars[name]=val;}}},util:{isDefined:function(obj){return(typeof(obj)!='undefined');},defaultVal:function(x,val){if(!iwp.util.isDefined(x)){return val;}
return x;},inArray:function(needle,array){for(i=0;i<array.length;i++){if(array[i]==needle){return true;}}
return false;},clone:function(oldObj){var newObj=(oldObj instanceof Array)?[]:{};for(i in oldObj){if(i=='clone')continue;if(oldObj[i]&&typeof oldObj[i]=="object"){newObj[i]=iwp.util.clone(oldObj[i]);}else newObj[i]=oldObj[i]}return newObj;},randomString:function(length){var chars="0123456789abcdefghiklmnopqrstuvwxyz";var string_length=iwp.util.defaultVal(length,8);var randomstring='';for(var i=0;i<string_length;i++){var rnum=Math.floor(Math.random()*chars.length);randomstring+=chars.substring(rnum,rnum+1);}
return randomstring;},htmlEscape:function(str){str=str.replace(/</g,'&lt;');str=str.replace(/>/g,'&gt;');return str;},BindOnCheckShow:function(checkbox,displayItem){ $(checkbox).bind('click',function(){if($(checkbox).attr('checked')==true){ $(displayItem).show();}else{ $(displayItem).hide();}});if($(checkbox).attr('checked')==true){ $(displayItem).show();}else{ $(displayItem).hide();}},BindOnCheckHide:function(checkbox,displayItem){ $(checkbox).bind('click',function(){if($(checkbox).attr('checked')==true){ $(displayItem).hide();}else{ $(displayItem).show();}});if($(checkbox).attr('checked')==true){ $(displayItem).hide();}else{ $(displayItem).show();}}},form:{BindNumbersOnly:function(fieldId){ $('#'+fieldId).bind('keyup',function(){var value=$(this).val();value=value.replace(/[^0-9]/g,'');$(this).val(value);});}},loadingIndiciatorTimeout:false,showLoadingIndicator:function(){iwp.loadingIndiciatorTimeout=window.setTimeout(iwp._showLoadingIndicator,150);},_showLoadingIndicator:function(){ $('#statusdiv').removeClass('statusOff').addClass('statusOn');iwp._positionLoadingIndicator();},_positionLoadingIndicator:function(){iwp.loadingIndiciatorTimeout=window.setTimeout(iwp._positionLoadingIndicator,16);},hideLoadingIndicator:function(){if(iwp.loadingIndiciatorTimeout){window.clearTimeout(iwp.loadingIndiciatorTimeout);iwp.loadingIndiciatorTimeout=false;}
$('#statusdiv').removeClass('statusOn').addClass('statusOff');},clearCache:function(){if(!confirm("Are you sure you want to clear your web site\'s cache? If you have a large amount of content your web site may take longer to load. Click OK to clear cache.")){return;}
$.getJSON('remote.php?section=settings&action=clearcache',function(response){if(response.success){alert('Your web site\'s cache has been cleared.');}else{alert('An error occurred while trying to clear your web site\'s cache.');}});}}
var callbacks={};function RegisterCallback(section,callFunction){if(typeof(callbacks[section])=='undefined'){callbacks[section]=Array();}
callbacks[section].push(callFunction);}
function RunCallbacks(section){if(typeof(callbacks[section])=='undefined'){return;}
for(i=0;i<callbacks[section].length;i++){callbacks[section][i]();}}
if(typeof Array.prototype.unshift==='undefined'){Array.prototype.unshift=function(){this.reverse();var a=arguments,i=a.length;while(i--){this.push(a[i]);}
this.reverse();return this.length;};}
if(typeof Array.prototype.splice==='undefined'){Array.prototype.splice=function(start,deleteCount){if(deleteCount==null||deleteCount=='')deleteCount=this.length-start;var tempArray=this.copy();for(var i=start;i<start+arguments.length-2;i++){this[i]=arguments[i-start+2];}
for(var i=start+arguments.length-2;i<this.length-deleteCount+arguments.length-2;i++){this[i]=tempArray[i+deleteCount-arguments.length+2];}
this.length=this.length-deleteCount+(arguments.length-2);return tempArray.slice(start,start+deleteCount);};}
function DisableField(disabler,toDisable){var tmp=$('#'+disabler).attr('checked');if(tmp!=true){tmp=false;}
$('#'+toDisable).attr('disabled',tmp);if(tmp==true){ $('#'+toDisable).hide();}else{ $('#'+toDisable).show();}}
function EnableField(enabler,toEnable){var tmp=$('#'+enabler).attr('checked');if(tmp!=true){tmp=false;}
$('#'+toEnable).attr('disabled',!tmp);if(tmp==false){ $('#'+toEnable).hide();}else{ $('#'+toEnable).show();}}
function ShowField(enabler,toEnable,reverse){if(reverse===undefined){var reverse=false;}
var tmp=$('#'+enabler).attr('checked');if(tmp!=true){tmp=false;}
if(reverse){tmp=!tmp;}
if(tmp==false){ $('#'+toEnable).hide();}else{ $('#'+toEnable).show();}}
var xml='';function clearFont()
{code=wysiwyg.getHTMLContent();code=code.replace(/<font([^>])*face="([^"]*)"/gi,"<font $1");code=code.replace(/<([\w]+) style="([^"]*)font-family:[^;"]*[;]?([^"]*)"/gi,"<$1 style=\"$2 $3\"");code=code.replace(/<([\w]+) style=" "/gi,"<$1 ");wysiwyg.writeHTMLContent(code);}
function isdefined(variable){return(typeof('+variable+')!="undefined");}
function getXMLData(name){if(isdefined('xml')){return xml.getElementsByTagName(name)[0].firstChild.data;}else{return'';}}
function getNextXMLData(name,i){if(isdefined('xml')){return xml.getElementsByTagName(name)[i].firstChild.data;}else{return'';}}
function toggleCheckboxes(master,formName){if(formName==''){formName='ListForm';}
if(master.checked==true){checkAll(formName);}else{uncheckAll(formName);}}
function checkAll(formName){formObj=document.getElementById(formName);for(var i=0;i<formObj.length;i++){fldObj=formObj.elements[i];if(fldObj.type=='checkbox'&&!fldObj.disabled){fldObj.checked=true;}}}
function uncheckAll(formName){formObj=document.getElementById(formName);for(var i=0;i<formObj.length;i++){fldObj=formObj.elements[i];if(fldObj.type=='checkbox'&&!fldObj.disabled){fldObj.checked=false;}}}
function checkSelectedBoxes(formName){formObj=document.getElementById(formName);for(var i=0;i<formObj.length;i++){fldObj=formObj.elements[i];if(fldObj.type=='checkbox'&&fldObj.checked==true){return true;}}
return false;}
function BulkAction(ContentType,formName){var bulkaction='';if(!document.getElementById("bulkaction")&&document.getElementById(ContentType+"bulkaction")){bulkaction=document.getElementById(ContentType+"bulkaction").value;}
if(document.getElementById("bulkaction")){bulkaction=document.getElementById("bulkaction").value;}
if(bulkaction=="none"){alert('Please choose an action.');$('#bulkaction').focus();return false;}else{if(checkSelectedBoxes(formName)){var ConfirmDeleteBulk='Are you sure you want to delete the selected items? Click OK to confirm.';switch(ContentType){case'categories':var ConfirmDeleteBulk="Are you sure you want to delete the selected category and all of its sub categories? Click OK to confirm.";break;}
if(bulkaction=="delete"){if(!confirm(ConfirmDeleteBulk)){return false;}
document.getElementById(formName).action='index.php?section='+ContentType+'&action=deletemulti';document.getElementById(formName).submit();}
if(bulkaction=="approve"){if(!confirm("Are you sure you want to approve these items?")){return false;}
document.getElementById(formName).action='index.php?ToDo=approve'+ContentType+'s';document.getElementById(formName).submit();}
if(bulkaction=="disapprove"){if(!confirm("Are you sure you want to disapprove these items?")){return false;}
document.getElementById(formName).action='index.php?ToDo=disapprove'+ContentType+'s';document.getElementById(formName).submit();}
if(bulkaction=="movetocat"){if($('#masscats').selectedValues()=="_loading"){return false;}else{document.getElementById(formName).action='index.php?ToDo=moveArticlesCat&catId='+$('#masscats').selectedValues();document.getElementById(formName).submit();}}
if(bulkaction=="addtocat"){if($('#masscats').selectedValues()=="_loading"){return false;}else{document.getElementById(formName).action='index.php?ToDo=addArticlesCat&catId='+$('#masscats').selectedValues();document.getElementById(formName).submit();}}
if(bulkaction=="removecat"){if($('#masscats').selectedValues()=="_loading"){return false;}else{document.getElementById(formName).action='index.php?ToDo=removeArticlesCat&catId='+$('#masscats').selectedValues();document.getElementById(formName).submit();}}
if(bulkaction=="activate"){if(!confirm("Are you sure you want to activate these modules?")){return false;}
adminModules.bulkAction('activate');}
if(bulkaction=="deactivate"){if(!confirm("Are you sure you want to deactivate these modules?")){return false;}
adminModules.bulkAction('deactivate');}}else{var SelectcategoriesBulk='Please choose at least one category to delete first.';var SelectmodulesBulk='Please choose at least one module first.';var SelectcontenttypesBulk='Please choose at least one content type first.';var SelectlistsBulk='Please choose at least one list first.';var SelectcontentBulk='Please choose at least one item first.';eval("var AlertMsg = Select"+ContentType+"Bulk;")
alert(AlertMsg);}}}
function SetCookie(cookieName,cookieValue,nDays)
{var today=new Date();var expire=new Date();if(nDays==null||nDays==0){nDays=1;}
expire.setTime(today.getTime()+3600000*24*nDays);document.cookie=cookieName+"="+escape(cookieValue)+";expires="+expire.toGMTString();}
function ReadCookie(n){var cookiecontent=new String();if(document.cookie.length>0){var cookiename=n+'=';var cookiebegin=document.cookie.indexOf(cookiename);var cookieend=0;if(cookiebegin>-1){cookiebegin+=cookiename.length;cookieend=document.cookie.indexOf(";",cookiebegin);if(cookieend<cookiebegin){cookieend=document.cookie.length;}
cookiecontent=document.cookie.substring(cookiebegin,cookieend);}}
return unescape(cookiecontent);}
function UpdateWindow(){var w=screen.availWidth;var h=screen.availHeight;var l=(w/2)-250;var t=(h/2)-250;var win=window.open("index.php?ToDo=databaseUpgrade&ForceStep1=true","DatabaseUpgrade","top="+t+",left="+l+",width=500,height=500,status=yes");win.focus();}
function OptionInSelect(id,select)
{for(var i=0;i<document.getElementById(select).options.length;i++){if(document.getElementById(select).options[i].value==id){return true;}}
return false;}
function animate_color(id,color){var htmlColor='';var duration=100;if(color=='green'){htmlColor='#99FF66';}else if(color=='orange'){htmlColor='#FFCC66';}else if(color=='red'){htmlColor='#FC7575';duration=300;}else if(color=='default'){htmlColor='#F9F9F9';duration=300;}
$("#"+id).animate({backgroundColor:htmlColor},{queue:true,duration:duration});}
function ChangePaging(object,todo,pagenumber){pagingId=object.selectedIndex;pagingamount=object[pagingId].value;document.location='index.php?ToDo='+todo+'&page='+pagenumber+'&perpage='+pagingamount;}
function CheckValidDate(day,month,year){year=parseInt(year,10);month=parseInt(month,10);day=parseInt(day,10);if(year<1900||year>2100){return false;}
if(month<1||month>12){return false;}
if(month==2){days=daysInFebruary(year);if(day>days){return false;}}else{var daysInMonth=DaysArray(12);if(day>daysInMonth[month]){return false;}}
return true;}
function daysInFebruary(year){return(((year%4==0)&&((!(year%100==0))||(year%400==0)))?29:28);}
function DaysArray(n){for(var i=1;i<=n;i++){this[i]=31
if(i==4||i==6||i==9||i==11){this[i]=30}
if(i==2){this[i]=29}}
return this}
$(function(){ $(document).ajaxStart(iwp.showLoadingIndicator);$(document).ajaxStop(iwp.hideLoadingIndicator);$('.ClearCacheLink').bind('click',function(){iwp.clearCache();return false;});});function LaunchHelpCategory(categoryid){var help_win=window.open("http://www.viewkb.com/inlinehelp.php?searchOverride="+parseInt(categoryid)+"&tplHeader="+escape("Interspire Website Publisher"),"help","width=650, height=550, left="+(screen.availWidth-700)+", top=100");}
function LaunchHelp(articleid){var help_win=window.open("http://www.viewkb.com/inlinehelp.php?searchOverride="+escape('142')+"&tplHeader="+escape("Interspire Website Publisher")+"&helpid="+parseInt(articleid,10),"help","width=650, height=550, left="+(screen.availWidth-700)+", top=100");}
function CurrentStyle(element,prop){if(element.currentStyle){return element.currentStyle[prop];}
else if(document.defaultView&&document.defaultView.getComputedStyle){prop=prop.replace(/([A-Z])/g,"-$1");prop=prop.toLowerCase();return document.defaultView.getComputedStyle(element,"").getPropertyValue(prop);}}
$(document).ready(function(){ $('.PopDownMenu').each(function(){ $(this).click(function(e){closeMenu();if(document.topCurrentMenu){ $(document.topCurrentMenu).hide();$(document.topCurrentButton).removeClass('ActiveButton');$('.ControlPanelSearchBar').show();}
var id=this.id.replace(/Button$/,'');if(!('#'+id))
return false;var menu=$('#'+id);var obj=this;offsetTop=0;offsetLeft=0;while(obj)
{offsetLeft+=obj.offsetLeft;offsetTop+=obj.offsetTop;obj=obj.offsetParent;if(obj&&CurrentStyle(obj,'position')){var pos=CurrentStyle(obj,'position');if(pos=="absolute"||pos=="relateive"){break;}}}
var tagName=$(this).attr('tagName').toLowerCase();var customOffsetTop=1;var customOffsetLeft=2;switch(tagName){case'button':if($.browser.safari){var customOffsetTop=4;var customOffsetLeft=10;}else{var customOffsetTop=4;var customOffsetLeft=4;}
break;}
$(this).addClass('ActiveButton');$('embed').css('visibility','hidden');$('object').css('visibility','hidden');$(menu).css('position','absolute');$(menu).addClass('PopDownMenuContainer');$(menu).css('top',(offsetTop+this.offsetHeight+customOffsetTop)+"px");this.blur();$(menu).css('left',(offsetLeft+customOffsetLeft)+"px");$(menu).show();e.stopPropagation();$(document).click(function(){ $(menu).hide();$(document.topCurrentButton).removeClass('ActiveButton');document.topCurrentMenu='';$('embed').css('visibility','visible');$('object').css('visibility','visible');});document.topCurrentMenu=menu;document.topCurrentButton=this;return false;});});});$().ajaxSuccess(doAjaxLogin);$().ajaxError(doAjaxLogin);var __lastAjaxRequestParams={};function doAjaxLogin(event,request,params){if(typeof params.dataType!='undefined'&&params.dataType.toLowerCase()=='xml'&&$('status',request.responseXML).text()=='fail'&&$('error',request.responseXML).text()=='login_fail'){if($('errOverlay').exists()){ $('errOverlay').remove();}
if($('loginAjaxBox').exists()){ $('loginAjaxBox').remove();}
__lastAjaxRequestParams=params;$("body").append("<div style='height:100%;left:0px;position:fixed;top:0px;width:100%;z-index:100;background-color:#000000;opacity:0.75;' id='errOverlay'></div>");$("body").append("<div id='loginAjaxBox' style='z-index:102;opacity:1;'>"+$('loginbox',request.responseXML).text()+"</div>");}
return true;}
function in_array(needle,array){for(i=0;i<array.length;i++){if(array[i]==needle){return true;}}
return false;}
IWPUrlBrowser=function(clickElement,urlElement,textElement){var self=this;self.clickElement=clickElement;self.urlElement=urlElement;self.textElement=textElement;self.onBeforeBrowserClose=function(){var url=$('#urlbrowser-selected-url').val();if(!url){return;}
$(self.urlElement).val(url);if(!self.textElement){return;}
var text=$('#urlbrowser-selected-text').val();if(!text){return}
$(self.textElement).val(text);};self.openBrowser=function(){IWPUrlBrowserWindow=$.iModal({type:'ajax',url:'remote.php?section=content&action=urlbrowser&type=file&mode=text',title:"URL Browser",buttons:'<div id="urlbrowser-buttons"><div class="urlbrowser-insertbuttons urlbrowser-insertbuttons--default" style="display:none;"><button disabled="disabled" class="urlbrowser-insert" id="urlbrowser-insert">'+"Insert Link"+'</button></div>'+'<button id="urlbrowser-cancel">'+"Cancel"+'</button></div><br style="clear: both;" />',width:700,onBeforeClose:self.onBeforeBrowserClose});};self.onClick=function(event){event.preventDefault();self.openBrowser();};self.bindClick=function(){ $(self.clickElement).click(self.onClick);};self.unbindClick=function(){ $(self.clickElement).unbind('click',self.onClick);};self.bindEvents=function(){self.bindClick();};self.unbindEvents=function(){self.unbindClick();};self.bindEvents();};var IWPUrlBrowserWindow={};
/**
 * /admin/javascript/menudrop.js (2009-09-16 08:57:23)
 */
$(document).ready(function(){ $('.DropShadow').each(function(){var offsetHeight=this.offsetHeight;var offsetWidth=this.offsetWidth;if(offsetHeight==0){var clone=this.cloneNode(true);clone.style.position='absolute';clone.style.left='-10000px';clone.style.top='-10000px';clone.style.display='block';document.body.appendChild(clone);offsetHeight=clone.offsetHeight;offsetWidth=clone.offsetWidth;document.body.removeChild(clone);}
$(this).wrap('<div class="DropShadowContainer"><div class="Shadow1"><div class="Shadow2"><div class="Shadow3"><div class="ItemContainer"></div></div></div></div></div>');var container=this.parentNode.parentNode.parentNode.parentNode.parentNode;$(container).css('height',offsetHeight+"px");$(container).css('position',this.style.position);$(container).css('top',this.style.top);$(container).css('left',this.style.left);$(container).css('display',this.style.display);$(container).attr('id',this.id);$(this).css('position','static');$(this).css('display','');$(this).removeClass('DropShadow');this.id='';});$('.PopDownMenu').each(function(){ $(this).click(function(e){closeMenu();if(document.topCurrentMenu){ $(document.topCurrentMenu).hide();$(document.topCurrentButton).removeClass('ActiveButton');$('.ControlPanelSearchBar').show();}
$('.ControlPanelSearchBar').hide();var id=this.id.replace(/Button$/,'');if(!('#'+id))
return false;var obj=this;offsetTop=0;offsetLeft=0;while(obj)
{offsetLeft+=obj.offsetLeft;offsetTop+=obj.offsetTop;obj=obj.offsetParent;if(obj&&CurrentStyle(obj,'position')){var pos=CurrentStyle(obj,'position');if(pos=="absolute"||pos=="relateive"){break;}}}
$(this).addClass('ActiveButton');var menu=$('#'+id);$(menu).css('position','absolute');$(menu).addClass('PopDownMenuContainer');$(menu).css('top',offsetTop+this.offsetHeight+1+"px");this.blur();$(menu).css('left',offsetLeft+2+"px");$(menu).show();e.stopPropagation();$(document).click(function(){ $(menu).hide();$(document.topCurrentButton).removeClass('ActiveButton');document.topCurrentMenu='';$('.ControlPanelSearchBar').show();});document.topCurrentMenu=menu;document.topCurrentButton=this;return false;});});$('.SortableList li .DragMouseDown').mousedown(function(){ $(this).parent().addClass('RowDown');});$('.SortableList li .DragMouseDown').mouseup(function(){ $(this).parent().removeClass('RowDown');});$('#headerMenu ul li.dropdown > a').dblclick(function(e)
{e.stopPropagation();window.location=this.href;return false;});$('#headerMenu ul li.dropdown > a').click(function(e)
{var elem=this;if($(elem).parent().is('.over'))
{ $(elem.parentNode).removeClass('over');$(elem).parent().find('ul').css('display','none');$('embed').css('visibility','visible');return false;}
if(document.topCurrentMenu){ $(document.topCurrentMenu).hide();$(document.topCurrentButton).removeClass('ActiveButton');$('.ControlPanelSearchBar').show();}
if(document.currentMenu){ $(document.currentMenu.parentNode).removeClass('over');$(document.currentMenu).parent().find('ul').css('display','none');$('embed').css('visibility','visible');}
document.currentMenu=this;offsetTop=offsetLeft=0;var element=elem;do
{offsetTop+=element.offsetTop||0;offsetLeft+=element.offsetLeft||0;element=element.offsetParent;}while(element);$(elem).parent().find('ul').css('visibility','hidden');if(navigator.userAgent.indexOf('MSIE')!=-1){ $(elem).parent().find('ul').css('display','block');}
else{ $(elem).parent().find('ul').css('display','table');}
var menuWidth=elem.parentNode.getElementsByTagName('ul')[0].offsetWidth;$(elem).parent().find('ul').css('width',menuWidth-2+'px');if(offsetLeft+menuWidth>$(window).width()){ $(elem).parent().find('ul').css('position','absolute');$(elem).parent().find('ul').css('left',(offsetLeft-menuWidth+elem.offsetWidth-3)+'px');}
else if(offsetLeft-menuWidth<$(window).width()){ $(elem).parent().find('ul').css('position','absolute');$(elem).parent().find('ul').css('left',offsetLeft+'px');}
$('embed').css('visibility','hidden');$('object').css('visibility','hidden');$(elem).parent().find('ul').css('visibility','visible');$(elem).parent().addClass('over');$(elem).blur(function(event){if(elem.parentNode.overmenu!=true)
{ $(elem.parentNode).removeClass('over');$(elem).parent().find('ul').css('display','none');$('embed').css('visibility','visible');$('object').css('visibility','visible');}});$(document).click(function(event){if(elem.parentNode.overmenu!=true)
{ $(elem.parentNode).removeClass('over');$(elem).parent().find('ul').css('display','none');$('embed').css('visibility','visible');$('object').css('visibility','visible');}});return false;});$('#headerMenu ul li ul li').mouseover(function(){this.parentNode.parentNode.overmenu=true;this.onmouseout=function(e){this.parentNode.parentNode.overmenu=false;}});$('#headerMenu ul li ul li').click(function(){ $(this.parentNode).hide();$(this.parentNode).parent().removeClass('over');});});function closeMenu(){if(document.currentMenu){ $(document.currentMenu.parentNode).removeClass('over');$(document.currentMenu).parent().find('ul').css('display','none');$('embed').css('visibility','visible');$('object').css('visibility','visible');}}
/**
 * /javascript/helptips.js (2009-09-16 08:57:55)
 */
function ShowQuickHelp(container,title,desc)
{div=document.createElement("div");div.style.display='block';div.style.position='absolute';div.style.width='185px';div.style.backgroundColor='#FEFCD5';div.style.border='solid 1px #E7E3BE';div.style.padding='10px';div.className="helpHover";var offset=$(container).offset();div.style.top=(offset.top+35)+'px';div.style.left=offset.left+'px';if(title!=''){div.innerHTML='<div class="helpTip"><strong>'+title+'</strong></div><br />';}
div.innerHTML+='<div style="width:185px; padding-left:0px" class="helpTip">'+desc+'</div>';document.body.appendChild(div);}
function HideQuickHelp(p)
{ $('.helpHover').remove();}
function ShowHelp(divid,title,desc,left)
{var windowHeight=$(window).height();var div=document.getElementById(divid);div.style.display='block';div.style.position='absolute';div.style.width='190px';div.style.backgroundColor='#FEFCD5';div.style.color='#000000';div.style.border='solid 1px #E7E3BE';div.style.padding='10px';var offset=$('#'+divid).siblings('img').offset();div.style.top=offset.top+'px';if(typeof left!='undefined'){div.style.left=left+'px';}else{div.style.left=(offset.left+20)+'px';}
div.innerHTML='<span class="helpTip"><b>'+title+'<\/b><\/span><br><img src="images/blank.gif" width="1" height="5" alt=""><br><div style="padding-left:5px; padding-right:5px" class="helpTip">'+desc+'<\/div>';var divOffset=$('#'+divid).offset();var divBottom=divOffset.top+$('#'+divid).height();if(divBottom>windowHeight){var difference=parseInt(divBottom-windowHeight);$('#'+divid).css('top',(parseInt(divOffset.top-difference)-15)+'px');}}
function HideHelp(divid)
{var div=document.getElementById(divid);div.style.display='none';}
/**
 * /lib/iselector/iselector.js (2009-09-16 08:58:15)
 */
(function($)
{function ReplaceSelect(select,settings)
{settings=$.extend({minimumHeight:0,width:0,height:0,autoHeightAfter:false},settings);if($(select).hasClass('ISelectorAlreadyReplaced')){return;}
var replacement=$('<div class="ISelector ISelectorAlreadyReplaced '+select.className+'"></div>');var hideSelectReplacement=false;if(select.offsetHeight==0){var clone=select.cloneNode(true);$(clone).css({position:'absolute',left:'-10000px',top:'-10000px',display:'block'});$('body').append(clone);var offsetHeight=$(clone).height();var offsetWidth=$(clone).width();$(clone).remove();if($(select).css('display')=='none'){hideSelectReplacement=true;}}
else{var offsetHeight=$(select).height();var offsetWidth=$(select).width();}
if(settings.width){offsetWidth=settings.width;}
if(settings.height){offsetHeight=settings.height;}
if(offsetWidth<200){offsetWidth=200;}
if(offsetHeight<settings.minimumHeight){offsetHeight=settings.minimumHeight;}
$(replacement).css({height:offsetHeight+'px',width:offsetWidth+'px'});if(select.id){ $(replacement).attr('id',select.id);select.id+='_old';}
if(hideSelectReplacement){ $(select).hide();}
replacement.get(0).select=select;replacement.get(0).options=select.options;replacement.get(0).selectedIndex=select.selectedIndex;$(replacement).click(function(){ $(this.select).trigger('click');});$(replacement).dblclick(function(){ $(this.select).trigger('dblclick');});$(replacement).append('<ul></ul>');var list=$(replacement).find('ul');$(select).children().each(function(i){if($(this).is('optgroup')){ $(list).append(AddOptionGroup(select,this));}
else if($(this).is('option')){ $(list).append(AddOption(select,this));}});$(select).hide();$(replacement).insertBefore($(select));if(settings.autoHeightAfter){ $(replacement).height($('ul',replacement).outerHeight());}
if(settings.height&&$(replacement).height()>settings.height){ $(replacement).height(settings.height);}}
function AddOptionGroup(select,group)
{var extraClass='';if(group.className){extraClass=group.className;}
var html=$('<li class="ISelectorGroup '+extraClass+'"><div>'+$(group).attr('label')+'</div></li>');var list=$(html).append('<ul></ul>');$(group).find('option').each(function(i){ $(list).append(AddOption(select,this));});return html;}
function AddOption(select,option)
{var value,elementClass,checked='';if($(option).attr('selected')){elementClass='SelectedRow';checked='checked="checked"';}
var label=$(option).html();var whitespace=label.match(/^\s*(&nbsp;)*/);if(whitespace[0])
{label=label.replace(/^\s*(&nbsp;)*/,'');}
var disabled='';if($(select).attr('disabled')){var disabled=' disabled="disabled"';}
var extraKey='';var extra='';if(option.className&option.className.indexOf('forceKey')!=-1){var start=option.className.indexOf('forceKey');var end=option.className.indexOf(' ',start+1);if(end==-1){var end=option.className.length;}
var extraKey=option.className.substring(start+8,end);var extra='[]';}
var iOption=$('<li id="ISelector'+$(select).attr('name').replace('[]','')+'_'+$(option).val()+'">');$(iOption).addClass(elementClass);$(iOption).bind('selectstart',function(){return false;});if(!$(select).attr('disabled')){ $(iOption).mouseover(function(){OptionHover(this,'over');});$(iOption).mouseout(function(){OptionHover(this,'out');})
$(iOption).click(function(e){if(this.dblClickTimeout){return false;}
if(e.target.tagName!='INPUT'){var checkbox=$(this).find('input');checkbox.attr('checked',!checkbox.attr('checked'));}
OptionClick(this);});$(iOption).dblclick(function(e){var option=$(this).data('option');$(option).trigger('dblclick');});}
$(iOption).append(whitespace[0]);$(iOption).data('option',option);var optionId='';if(!isNaN($(option).val())){optionId=' id="ISelector_id__'+$(option).val()+'" ';}
if($(option).hasClass('freeform')){ $(iOption).append('<input type="textbox" name="ISelector_'+select.name+'['+extraKey+']'+extra+'" '+optionId+' value="'+$(option).val()+'" />');}
else{if($(select).attr('multiple')){ $(iOption).append('<input type="checkbox" name="ISelector_'+select.name+'['+extraKey+']'+extra+'" '+optionId+' value="'+$(option).val()+'" '+checked+disabled+' />'+label);}
else{ $(iOption).append('<input type="radio" name="ISelector_'+select.name+'['+extraKey+']'+extra+'" '+optionId+' value="'+$(option).val()+'" '+checked+disabled+' />'+label);}}
return iOption;}
function OptionHover(element,action)
{if(action=='out'){ $($(element).data('option')).trigger('mouseout');$(element).removeClass('ISelectorOptionHover');}
else{ $($(element).data('option')).trigger('mouseover');if(!$(element).hasClass('SelectedRow')){ $(element).addClass('ISelectorOptionHover');}}}
function ScrollToItem(select,value,group)
{var item=$('#ISelector'+select.replace('[]','')+'_'+value);if(!item.get(0)){return;}
var replacement=item.parents('div.ISelector');var position=item.position().top;if(group!=undefined&&group==true){position-=20;}
replacement.scrollTop(position);}
function OptionClick(element){var replacement=$(element).parents('.ISelector').get(0);var option=$(element).data('option');var checkbox=$(element).find('input');element.dblClickTimeout=setTimeout(function(){element.dblClickTimeout='';},250);$(option).attr('selected',$(checkbox).attr('checked'));replacement.selectedIndex=replacement.select.selectedIndex;if(checkbox.attr('checked')){if(!$(replacement.select).attr('multiple')){ $(replacement).find('li.SelectedRow').removeClass('SelectedRow');}
$(element).addClass('SelectedRow');}
else{ $(element).removeClass('SelectedRow');}
$(option).trigger('click');$(checkbox).trigger('change');$(option).parents('select').trigger('change');}
$.fn.UncheckItem=function(element){var replacement=$(element).parents('.ISelector').get(0);var option=$(element).data('option');var checkbox=$(element).find('input');$(option).attr('selected',$(checkbox).attr('checked'));replacement.selectedIndex=replacement.select.selectedIndex;$(element).removeClass('SelectedRow');if(checkbox.attr('checked')){checkbox.removeAttr('checked');}}
$.fn.iselector=function(settings)
{return this.each(function(){ReplaceSelect(this,settings);});}
$.fn.iselectorAddItem=function(options)
{return this.each(function(){var id=$(this).attr('id');var select=$('#'+id+'_old').get(0);var newOption=$('<option value="'+options.value+'">'+options.label+'</option>');var option=newOption.get(0);$(select).append(newOption);var newIOption=AddOption(select,option);$(this).children('ul').append(newIOption);if(options.selected!=undefined&&options.selected==true){ $(newOption).attr('selected',true);newIOption.find('input').attr('checked',true);OptionClick(newIOption);$(select).trigger('change');}
if(options.scrollTo!=undefined&&options.scrollTo==true){ScrollToItem(select.name,options.value);}});}
$.fn.iselectorRemoveItem=function(value)
{var values=jQuery.makeArray(value);return this.each(function(){var id=$(this).attr('id');var select=$('#'+id+'_old').get(0);var fireChange=false;$(values).each(function(){var option=$(select).find('option[value="'+this+'"]');if($(option).attr('checked')){fireChange=true;}
option.remove();var item=$('#ISelector'+select.name.replace('[]','')+'_'+this);$(item).remove();});$(this).get(0).selectedIndex=select.selectedIndex;if(fireChange){ $(select).trigger('change');}});}
$.fn.iselectorRemoveGroup=function(value)
{var values=jQuery.makeArray(value);return this.each(function(){var id=$(this).attr('id');var select=$('#'+id+'_old').get(0);$(values).each(function(){ $(select).find('option[value="'+this+'"]').parents('optgroup').remove();$('#ISelector'+select.name.replace('[]','')+'_'+this).parents('li.ISelectorGroup').remove();});$(this).get(0).selectedIndex=select.selectedIndex;$(select).trigger('change');});}
$.fn.iselectorScrollTo=function(value)
{return this.each(function(){var id=$(this).attr('id');var select=$('#'+id+'_old').get(0);ScrollToItem(select.name,value);});}
$.fn.oldVal=jQuery.fn.val;$.fn.val=function(value)
{if(value==undefined){if(this.hasClass('ISelector')){var id='#'+this.attr('id')+'_old';return $(id).oldVal();}
return this.oldVal();}
else{if(this.hasClass('ISelector')){var values=jQuery.makeArray(value);this.find('li > input').each(function(){if($.inArray(this.value,values)>=0){this.checked=true;}
else{this.checked=false;}
OptionClick(this.parentNode);});}
return this.oldVal(value);}}})(jQuery);$(document).ready(function(){ $('.ISSelectReplacement, .iselect').iselector();});
/**
 * /javascript/jquery/deprecated-plugins.js (2009-09-16 08:57:54)
 */
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('(6($){ $.n.L=6(){5 e=6(a,v,t,b){5 c=Y.V("M");c.h=v,c.E=t;5 o=a.y;5 d=o.l;3(!a.x){a.x={};p(5 i=0;i<d;i++){a.x[o[i].h]=i}}3(8 a.x[v]=="O")a.x[v]=d;a.y[a.x[v]]=c;3(b){c.k=9}};5 a=P;3(a.l==0)7 4;5 f=9;5 m=u;5 g,v,t;3(8(a[0])=="B"){m=9;g=a[0]}3(a.l>=2){3(8(a[1])=="K")f=a[1];j 3(8(a[2])=="K")f=a[2];3(!m){v=a[0];t=a[1]}}4.s(6(){3(4.A.q()!="z")7;3(m){p(5 a 10 g){e(4,a,g[a],f)}}j{e(4,v,t,f)}});7 4};$.n.Z=6(b,c,d,e,f){3(8(b)!="D")7 4;3(8(c)!="B")c={};3(8(d)!="K")d=9;4.s(6(){5 a=4;$.X(b,c,6(r){ $(a).L(r,d);3(8 e=="6"){3(8 f=="B"){e.W(a,f)}j{e.J(a)}}})});7 4};$.n.U=6(){5 a=P;3(a.l==0)7 4;5 d=8(a[0]);5 v,i;3(d=="D"||d=="B"||d=="6")v=a[0];j 3(d=="T")i=a[0];j 7 4;4.s(6(){3(4.A.q()!="z")7;3(4.x)4.x=N;5 b=u;5 o=4.y;3(!!v){5 c=o.l;p(5 i=c-1;i>=0;i--){3(v.I==G){3(o[i].h.H(v)){b=9}}j 3(o[i].h==v){b=9}3(b&&a[1]===9)b=o[i].k;3(b){o[i]=N}b=u}}j{3(b&&a[1]===9)b=o[i].k;3(b){4.S(i)}}});7 4};$.n.R=6(f){5 a=8(f)=="O"?9:!!f;4.s(6(){3(4.A.q()!="z")7;5 o=4.y;5 d=o.l;5 e=[];p(5 i=0;i<d;i++){e[i]={v:o[i].h,t:o[i].E}}e.Q(6(b,c){C=b.t.q(),F=c.t.q();3(C==F)7 0;3(a){7 C<F?-1:1}j{7 C>F?-1:1}});p(5 i=0;i<d;i++){o[i].E=e[i].t;o[i].h=e[i].v}});7 4};$.n.17=6(b,d){5 v=b;5 e=8(b);5 c=d||u;3(e!="D"&&e!="6"&&e!="B")7 4;4.s(6(){3(4.A.q()!="z")7 4;5 o=4.y;5 a=o.l;p(5 i=0;i<a;i++){3(v.I==G){3(o[i].h.H(v)){o[i].k=9}j 3(c){o[i].k=u}}j{3(o[i].h==v){o[i].k=9}j 3(c){o[i].k=u}}}});7 4};$.n.15=6(b,c){5 w=c||"k";3($(b).14()==0)7 4;4.s(6(){3(4.A.q()!="z")7 4;5 o=4.y;5 a=o.l;p(5 i=0;i<a;i++){3(w=="13"||(w=="k"&&o[i].k)){ $(b).L(o[i].h,o[i].E)}}});7 4};$.n.12=6(b,c){5 d=u;5 v=b;5 e=8(v);5 f=8(c);3(e!="D"&&e!="6"&&e!="B")7 f=="6"?4:d;4.s(6(){3(4.A.q()!="z")7 4;3(d&&f!="6")7 u;5 o=4.y;5 a=o.l;p(5 i=0;i<a;i++){3(v.I==G){3(o[i].h.H(v)){d=9;3(f=="6")c.J(o[i])}}j{3(o[i].h==v){d=9;3(f=="6")c.J(o[i])}}}});7 f=="6"?4:d};$.n.11=6(){5 v=[];4.16("M:k").s(6(){v[v.l]=4.h});7 v}})(18);',62,71,'|||if|this|var|function|return|typeof|true||||||||value||else|selected|length||fn||for|toLowerCase||each||false|||cache|options|select|nodeName|object|o1t|string|text|o2t|RegExp|match|constructor|call|boolean|addOption|option|null|undefined|arguments|sort|sortOptions|remove|number|removeOption|createElement|apply|getJSON|document|ajaxAddOption|in|selectedValues|containsOption|all|size|copyOptions|find|selectOptions|jQuery'.split('|'),0,{}))
jQuery.fn.moveOption=function(item,direction)
{if(direction!="up"&&direction!="down")return this;this.each(function()
{if(this.nodeName.toLowerCase()!="select")return this;var tmpOptionText;var tmpOptionValue;var o=this.options;var oL=o.length;if(direction=="up"){for(var i=0;i<oL;i++)
{if(o[i].value==item){if(i==0)return this;tmpOptionValue=o[i].value;tmpOptionText=o[i].text;o[i].text=o[i-1].text;o[i].value=o[i-1].value;o[i-1].text=tmpOptionText;o[i-1].value=tmpOptionValue;o[i-1].selected=true;o[i].selected=false;return this;}}}else{for(var i=0;i<oL;i++)
{if(o[i].value==item){if(i==oL-1)return this;tmpOptionValue=o[i].value;tmpOptionText=o[i].text;o[i].text=o[i+1].text;o[i].value=o[i+1].value;o[i+1].text=tmpOptionText;o[i+1].value=tmpOptionValue;o[i+1].selected=true;o[i].selected=false;return this;}}}});return this;}
jQuery.fn.getSelectText=function(item)
{var tmpOptionText;this.each(function()
{if(this.nodeName.toLowerCase()!="select")return this;var o=this.options;var oL=o.length;for(var i=0;i<oL;i++)
{if(o[i].value==item){tmpOptionText=o[i].text;break;}}});return tmpOptionText;}
jQuery.autocomplete=function(input,options){var me=this;var jinput=$(input).attr("autocomplete","off");if(options.inputClass)jinput.addClass(options.inputClass);var results=document.createElement("div");var jresults=$(results);jresults.hide().addClass(options.resultsClass).css("position","absolute");if(options.width>0)jresults.css("width",options.width);$("body").append(results);input.autocompleter=me;var timeout=null;var prev="";var active=-1;var cache={};var keyb=false;var hasFocus=false;var lastKeyPressCode=null;var idNum=0;function flushCache(){cache={};cache.data={};cache.length=0;};flushCache();if(options.data!=null){var sFirstChar="",stMatchSets={},row=[];if(typeof options.url!="string")options.cacheLength=1;for(var i=0;i<options.data.length;i++){row=((typeof options.data[i]=="string")?[options.data[i]]:options.data[i]);if(row[0].length>0){sFirstChar=row[0].substring(0,1).toLowerCase();if(!stMatchSets[sFirstChar])stMatchSets[sFirstChar]=[];stMatchSets[sFirstChar].push(row);}}
for(var k in stMatchSets){options.cacheLength++;addToCache(k,stMatchSets[k]);}}
jinput.keydown(function(e){lastKeyPressCode=e.keyCode;switch(e.keyCode){case 38:e.preventDefault();moveSelect(-1);break;case 40:e.preventDefault();moveSelect(1);break;case 9:case 13:if(selectCurrent()){jinput.get(0).blur();e.preventDefault();}
break;default:active=-1;if(timeout)clearTimeout(timeout);timeout=setTimeout(function(){onChange();},options.delay);break;}}).focus(function(){hasFocus=true;}).blur(function(){hasFocus=false;hideResults();});hideResultsNow();function onChange(){if(lastKeyPressCode==46||(lastKeyPressCode>8&&lastKeyPressCode<32))return jresults.hide();var v=jinput.val();if(v==prev)return;prev=v;if(v.length>=options.minChars){jinput.addClass(options.loadingClass);requestData(v);}else{jinput.removeClass(options.loadingClass);jresults.hide();}};function moveSelect(step){var lis=$("li",results);if(!lis)return;active+=step;if(active<0){active=0;}else if(active>=lis.size()){active=lis.size()-1;}
lis.removeClass("ac_over");$(lis[active]).addClass("ac_over");};function selectCurrent(){var li=$("li.ac_over",results)[0];if(!li){var $li=$("li",results);if(options.selectOnly){if($li.length==1)li=$li[0];}else if(options.selectFirst){li=$li[0];}}
if(li){selectItem(li);return true;}else{return false;}};function selectItem(li){if(!li){li=document.createElement("li");li.extra=[];li.selectValue="";}
var v=$.trim(li.selectValue?li.selectValue:li.innerHTML);input.lastSelected=v;prev=v;jresults.html("");jinput.val(v);hideResultsNow();if(options.onItemSelect)setTimeout(function(){options.onItemSelect(li)},1);};function createSelection(start,end){var field=jinput.get(0);if(field.createTextRange){var selRange=field.createTextRange();selRange.collapse(true);selRange.moveStart("character",start);selRange.moveEnd("character",end);selRange.select();}else if(field.setSelectionRange){field.setSelectionRange(start,end);}else{if(field.selectionStart){field.selectionStart=start;field.selectionEnd=end;}}
field.focus();};function autoFill(sValue){if(lastKeyPressCode!=8){jinput.val(jinput.val()+sValue.substring(prev.length));createSelection(prev.length,sValue.length);}};function showResults(){var pos=findPos(input);var iWidth=(options.width>0)?options.width:jinput.width();jresults.css({width:parseInt(iWidth)+"px",top:(pos.y+input.offsetHeight)+"px",left:pos.x+"px"}).show();};function hideResults(){if(timeout)clearTimeout(timeout);timeout=setTimeout(hideResultsNow,200);};function hideResultsNow(){if(timeout)clearTimeout(timeout);jinput.removeClass(options.loadingClass);if(jresults.is(":visible")){jresults.hide();}
if(options.mustMatch){var v=jinput.val();if(v!=input.lastSelected){selectItem(null);}}};function receiveData(q,data){if(data){jinput.removeClass(options.loadingClass);results.innerHTML="";if(!hasFocus||data.length==0)return hideResultsNow();if($.browser.msie){jresults.append(document.createElement('iframe'));}
results.appendChild(dataToDom(data));if(options.autoFill&&(jinput.val().toLowerCase()==q.toLowerCase()))autoFill(data[0][0]);showResults();}else{hideResultsNow();}};function parseData(data){if(!data)return null;var parsed=[];var rows=data.split(options.lineSeparator);for(var i=0;i<rows.length;i++){var row=$.trim(rows[i]);if(row){parsed[parsed.length]=row.split(options.cellSeparator);}}
return parsed;};function dataToDom(data){var ul=document.createElement("ul");var num=data.length;if((options.maxItemsToShow>0)&&(options.maxItemsToShow<num))num=options.maxItemsToShow;for(var i=0;i<num;i++){var row=data[i];if(!row)continue;var li=document.createElement("li");if(options.formatItem){li.innerHTML=options.formatItem(row,i,num);li.selectValue=row[0];}else{li.innerHTML=row[0];li.selectValue=row[0];}
var extra=null;if(row.length>1){extra=[];for(var j=1;j<row.length;j++){extra[extra.length]=row[j];}}
li.extra=extra;ul.appendChild(li);$(li).hover(function(){ $("li",ul).removeClass("ac_over");$(this).addClass("ac_over");active=$("li",ul).indexOf($(this).get(0));},function(){ $(this).removeClass("ac_over");}).click(function(e){e.preventDefault();e.stopPropagation();selectItem(this)});}
return ul;};function requestData(q){if(!options.matchCase)q=q.toLowerCase();var data=options.cacheLength?loadFromCache(q):null;if(data){receiveData(q,data);}else if((typeof options.url=="string")&&(options.url.length>0)){ $.get(makeUrl(q),function(data){data=parseData(data);addToCache(q,data);receiveData(q,data);});}else{jinput.removeClass(options.loadingClass);}};function makeUrl(q){if(options.url.indexOf('?')>-1){var url=options.url+"&q="+encodeURI(q);}else{var url=options.url+"?q="+encodeURI(q);}
for(var i in options.extraParams){url+="&"+i+"="+encodeURI(options.extraParams[i]);}
return url;};function loadFromCache(q){if(!q)return null;if(cache.data[q])return cache.data[q];if(options.matchSubset){for(var i=q.length-1;i>=options.minChars;i--){var qs=q.substr(0,i);var c=cache.data[qs];if(c){var csub=[];for(var j=0;j<c.length;j++){var x=c[j];var x0=x[0];if(matchSubset(x0,q)){csub[csub.length]=x;}}
return csub;}}}
return null;};function matchSubset(s,sub){if(!options.matchCase)s=s.toLowerCase();var i=s.indexOf(sub);if(i==-1)return false;return i==0||options.matchContains;};this.flushCache=function(){flushCache();};this.setExtraParams=function(p){options.extraParams=p;};this.findValue=function(){var q=jinput.val();if(!options.matchCase)q=q.toLowerCase();var data=options.cacheLength?loadFromCache(q):null;if(data){findValueCallback(q,data);}else if((typeof options.url=="string")&&(options.url.length>0)){ $.get(makeUrl(q),function(data){data=parseData(data)
addToCache(q,data);findValueCallback(q,data);});}else{findValueCallback(q,null);}
return idNum;}
function findValueCallback(q,data){if(data)jinput.removeClass(options.loadingClass);var num=(data)?data.length:0;var li=null;for(var i=0;i<num;i++){var row=data[i];if(row[0].toLowerCase()==q.toLowerCase()){li=document.createElement("li");if(options.formatItem){li.innerHTML=options.formatItem(row,i,num);li.selectValue=row[0];}else{li.innerHTML=row[0];li.selectValue=row[0];}
var extra=null;if(row.length>1){extra=[];for(var j=1;j<row.length;j++){extra[extra.length]=row[j];}}
li.extra=extra;}}
if(options.onFindValue){idNum=options.onFindValue(li);}}
function addToCache(q,data){if(!data||!q||!options.cacheLength)return;if(!cache.length||cache.length>options.cacheLength){flushCache();cache.length++;}else if(!cache[q]){cache.length++;}
cache.data[q]=data;};function findPos(obj){var curleft=obj.offsetLeft||0;var curtop=obj.offsetTop||0;while(obj=obj.offsetParent){curleft+=obj.offsetLeft
curtop+=obj.offsetTop}
return{x:curleft,y:curtop};}}
jQuery.fn.autocomplete=function(url,options,data){options=options||{};options.url=url;options.data=((typeof data=="object")&&(data.constructor==Array))?data:null;options.inputClass=options.inputClass||"ac_input";options.resultsClass=options.resultsClass||"ac_results";options.lineSeparator=options.lineSeparator||"\n";options.cellSeparator=options.cellSeparator||"|";options.minChars=options.minChars||1;options.delay=options.delay||400;options.matchCase=options.matchCase||0;options.matchSubset=options.matchSubset||1;options.matchContains=options.matchContains||0;options.cacheLength=options.cacheLength||1;options.mustMatch=options.mustMatch||0;options.extraParams=options.extraParams||{};options.loadingClass=options.loadingClass||"ac_loading";options.selectFirst=options.selectFirst||false;options.selectOnly=options.selectOnly||false;options.maxItemsToShow=options.maxItemsToShow||-1;options.autoFill=options.autoFill||false;options.width=parseInt(options.width,10)||0;this.each(function(){var input=this;new jQuery.autocomplete(input,options);});return this;}
jQuery.fn.autocompleteArray=function(data,options){return this.autocomplete(null,options,data);}
jQuery.fn.indexOf=function(e){for(var i=0;i<this.length;i++){if(this[i]==e)return i;}
return-1;};;(function($){var o=$.scrollTo=function(a,b,c){o.window().scrollTo(a,b,c)};o.defaults={axis:'y',duration:1};o.window=function(){return $($.browser.safari?'body':'html')};$.fn.scrollTo=function(l,m,n){if(typeof m=='object'){n=m;m=0}n=$.extend({},o.defaults,n);m=m||n.speed||n.duration;n.queue=n.queue&&n.axis.length>1;if(n.queue)m/=2;n.offset=j(n.offset);n.over=j(n.over);return this.each(function(){var a=this,b=$(a),t=l,c,d={},w=b.is('html,body');switch(typeof t){case'number':case'string':if(/^([+-]=)?\d+(px)?$/.test(t)){t=j(t);break}t=$(t,this);case'object':if(t.is||t.style)c=(t=$(t)).offset()}$.each(n.axis.split(''),function(i,f){var P=f=='x'?'Left':'Top',p=P.toLowerCase(),k='scroll'+P,e=a[k],D=f=='x'?'Width':'Height';if(c){d[k]=c[p]+(w?0:e-b.offset()[p]);if(n.margin){d[k]-=parseInt(t.css('margin'+P))||0;d[k]-=parseInt(t.css('border'+P+'Width'))||0}d[k]+=n.offset[p]||0;if(n.over[p])d[k]+=t[D.toLowerCase()]()*n.over[p]}else d[k]=t[p];if(/^\d+$/.test(d[k]))d[k]=d[k]<=0?0:Math.min(d[k],h(D));if(!i&&n.queue){if(e!=d[k])g(n.onAfterFirst);delete d[k]}});g(n.onAfter);function g(a){b.animate(d,m,n.easing,a&&function(){a.call(this,l)})};function h(D){var b=w?$.browser.opera?document.body:document.documentElement:a;return b['scroll'+D]-b['client'+D]}})};function j(a){return typeof a=='object'?a:{top:a,left:a}}})(jQuery);$(document).ready(function(){jQuery.fn.exists=function(){return(this.is('*'));}
jQuery.fn.length=function(){return(this.length);}
jQuery.fn.errorMessage=function(error,arrMsgs){var val='';if(arrMsgs&&arrMsgs.length>0){val=error+"<ul>";for(i=0;i<arrMsgs.length;i++){val+='<li>'+arrMsgs[i]+'</li>';}
val+="</ul>";}else{val=error;}
$(this).html('<div class="MessageContainer ErrorMessage" >'+val+'</div>');$(this).css('margin','10px 0');if($(this).css('display')=='none'){ $(this).show('slow');}
$(this).find('.MessageContainer').animate({backgroundColor:'#FFAEAE'}).animate({backgroundColor:'#F4F4F4'});}
jQuery.fn.successMessage=function(msg){ $(this).html('<div class="MessageContainer SuccessMessage" >'+msg+'</div>');$(this).css('margin','10px 0');if($(this).css('display')=='none'){ $(this).show('slow');}
$(this).find('.MessageContainer').animate({backgroundColor:'#99FF66'}).animate({backgroundColor:'#F4F4F4'});}
jQuery.fn.infoMessage=function(msg,animate){if(typeof animate=='undefined'){var animate=true;}
$(this).html('<div class="MessageContainer InfoMessage" >'+msg+'</div>');$(this).css('margin','10px 0');if($(this).css('display')=='none'){ $(this).show(animate?'slow':null);}
if(animate){ $(this).find('.MessageContainer').animate({backgroundColor:'#A6D3E1'}).animate({backgroundColor:'#E0ECFF'});}else{ $(this).show().find('.MessageContainer').show();}}
jQuery.fn.warningMessage=function(msg){ $(this).html('<div class="MessageContainer WarningMessage" >'+msg+'</div>');$(this).css('margin','10px 0');if($(this).css('display')=='none'){ $(this).show('slow');}
$(this).find('.MessageContainer').animate({backgroundColor:'#FFCC66'}).animate({backgroundColor:'#F4F4F4'});}});(function($){ $.evalJSON=function(src)
{eval('var json = '+src+';');return json;};})(jQuery);eval(function(p,a,c,k,e,r){e=function(c){return c.toString(a)};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('2.g.q=1(b,c){b=b||"*";c=c||7;4 d=2([]);0.5(1(){4 a=2("9[@8=f]",0).6(b).5(1(){0.3=!0.3}).6(":3");d=a});e(!c){d=0}i d};2.g.p=1(b,c){b=b||"*";c=c||7;4 d=2([]);0.5(1(){4 a=2("9[@8=f]",0).6(b).5(1(){0.3=o}).6(":3");d=a});e(!c){d=0}i d};2.g.n=1(b,c){b=b||"*";c=c||7;4 d=2([]);0.5(1(){4 a=2("9[@8=f]",0).6(b).5(1(){0.3=7}).6(":j(:3)");d=a});e(!c){d=0}i d};2.m=1(a,b){b=b||"*";4 c="9[@8=f]";e(a){c+="[@l="+a+"]"}4 h=2(c).6(b);h.k(1(){h.j(0).5(1(){0.3=7}).r()})};',28,28,'this|function|jQuery|checked|var|each|filter|false|type|input|||||if|checkbox|fn|x|return|not|click|name|radioCheckboxGroup|unCheckCheckboxes|true|checkCheckboxes|toggleCheckboxes|end'.split('|'),0,{}))
jQuery.fn.outerHTML=function(s){return(s)?this.before(s).remove():jQuery("<p>").append(this.eq(0).clone()).html();};(function($){ $.fn.disabledBind=function(type,listener){return $(this).each(function(){var node=$(this);var wrapper=node.parents('.disabledBindWrapper');if(!wrapper.length){wrapper=$('<span class="disabledBindWrapper"></span>').insertBefore(node).css('position','relative')
node.appendTo(wrapper);}
var clickable=wrapper.find('.disabledBindClickable');if(!clickable.length){var position=node.position();var clickable=$('<div class="disabledBindClickable"></div>').css('position','absolute').css('top',position.top+'px').css('left',position.left+'px').css('margin','0').css('padding','0').css('border','none').width(node.outerWidth()).height(node.outerHeight()).insertAfter(node);var zindex=node.css('z-index');if(zindex!='auto'&&zindex!=''){clickable.css('z-index',parseInt(zindex,10)+1);}}
clickable.bind(type,listener);});};})(jQuery);(function($){ $.fn.observe=function(options,callback){var self=this;self.getValue=function(){var val=[];self.nodes.each(function(){val.push($(this).val());});return val.join('|');};self.start=function(){self.stop();self.lastTrigger=self.lastChange=new Date();self.interval=window.setInterval(self.intervalCheck,self.options.checkDelay);self.lastValue=self.getValue();self.changed=false;};self.stop=function(){window.clearTimeout(self.timeout);window.clearInterval(self.interval);};self.intervalCheck=function(){if(self.nodes.parents('body').length==0){self.stop();return;}
if(self.options.type!='constant'||!self.changed){var val=self.getValue();if(val!=self.lastValue){self.lastChange=new Date();self.lastValue=val;if(!self.changed){self.changed=true;self.lastTrigger=new Date();self.lastTrigger.setMilliseconds(0-self.options.checkDelay);return;}}}
if(!self.changed){return;}
var now=new Date();var trigger=false;switch(self.options.type){case'once':if(now-self.lastChange>self.options.delay){trigger=true;}
break;case'constant':if(now-self.lastTrigger>self.options.delay){trigger=true;}
break;default:throw new Error('jQuery.observe: "'+self.options.type+'" is not a valid observer type');break;}
if(!trigger){return;}
self.lastTrigger=new Date();self.changed=false;self.options.callback();};if(typeof callback=='function'){options.callback=callback;delete callback;}else if(typeof options=='function'){var options={callback:options};}
self.options=$.extend({type:'once',delay:1000,checkDelay:100,callback:function(){},start:true},options);self.nodes=$(this);self.timeout=null;self.interval=null;if(self.options.start){self.start();}
return $(this);};})(jQuery);
