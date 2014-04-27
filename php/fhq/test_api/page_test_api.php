<?
	echo "Page for Test API";
?>
<br>
<br>
<br>
<script type="text/javascript">
	function call_api() {
		
	};
</script>
<input type='text' id='url_api' size=500 name='url_api' value='http://93.91.166.5/api/'/>
<a class="btn btn-small btn-info" href='javascript:void(0);' onclick="

	document.getElementById('result_api0').innerHTML = '';
	var url = document.getElementById('url_api').value;
	document.getElementById('result_api0').innerHTML = 'call: ' + url;
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	};  
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			if(xmlhttp.responseText == '')
				document.getElementById('news').innerHTML = 'empty';
			else
				document.getElementById('result_api1').innerHTML=xmlhttp.responseText;
		}
	}
	
	document.getElementById('result_api1').innerHTML='send request';
	xmlhttp.open('GET', url ,true);
	xmlhttp.send();
">call</a>
<br>
<br>
<br>
Answer:<br>
<pre id='result_api0'></pre>
<pre id='result_api1'></pre>



