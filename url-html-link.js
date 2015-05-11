function convertURL(){

	//Get parameters
	var urlSep = jQuery('input:radio[name=urlsep]:checked').val();
	var urlformat = jQuery('input:radio[name=urlformat]:checked').val();
	var lTarget = jQuery('#lTarget').val();
	var keywordText = jQuery('#keywordText').val();
	var oldUrl = jQuery('#oldUrl').val();
	var idText = jQuery('#idText').val();
	var beforeText = jQuery('#beforeText').val();
	var afterText = jQuery('#afterText').val();
	var classText = jQuery('#classText').val();
	var noFollow = jQuery('#noFollow').is(':checked');
	//var noFollow = jQuery('#noFollow').val();
	//alert(newCode);
	var formatStart = "";
	var formatEnd = "";
	var targetCode = "";
	var noFollowCode = "";
	var classCode = "";
	var idCode = "";
	var afterText = "";
	if(urlformat == "paragraph"){
		formatStart = "<p>";
		formatEnd = "</p>";
	}else if(urlformat == "br"){
		formatStart = "";
		formatEnd = "<br />";
	}else if(urlformat == "div"){
		formatStart = "<div>";
		formatEnd = "</div>";
	}else if(urlformat == "ul"){
		formatStart = "<li>";
		formatEnd = "</li>";
	}else if(urlformat == "ol"){
		formatStart = "<li>";
		formatEnd = "</li>";
	}else{
		formatStart = "";
		formatEnd = "";
	}
	if(lTarget != "nope"){
		targetCode = ' target="' + lTarget + '"';
	}
	
	if(noFollow){
		noFollowCode = ' rel="nofollow"';
	}
	if(classText){
		classCode = ' class="' + classText + '"';
	}
	if(idText){
		idCode = ' id="' + idText + '"';
	}
	
		
		//var searchLocation = beforeText.search(keywordText);
		//alert(searchLocation);
		//if(searchLocation == '-1' ) alert("Could Not find Keyword in text Given");
		if (beforeText.toLowerCase().indexOf(keywordText.toLowerCase()) === -1) alert("Could Not find Keyword in text Given");
		else 	{
			var oldVal = jQuery('#newCode').val();
			if(oldVal) oldVal = oldVal;
			else oldVal = beforeText;
			//newCode = oldVal + beforeText.replace(keywordText, formatStart + ' <a href="' + oldUrl +'"' + targetCode + noFollowCode + classCode + idCode + '>'+ keywordText +'</a> '+ afterText + formatEnd);
			newCode = replaceAll(oldVal, keywordText, formatStart + ' <a href="' + oldUrl +'"' + targetCode + noFollowCode + classCode + idCode + '>'+ keywordText +'</a> '+ afterText + formatEnd);
			jQuery('#newCode').val(newCode);
			}
return false;
}

jQuery(document).ready(function(){
  jQuery(".btn-clear").click(function(){
   jQuery('#newCode').val('');
   return false;
  });
});

(function (jQuery) {
   jQuery(document);
}(jQuery));

function escapeRegExp(string) {
    return string.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
}

function replaceAll(string, find, replace) {
  return string.replace(new RegExp(escapeRegExp(find), 'g'), replace);
}