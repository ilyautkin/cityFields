var el = document.getElementById('cfcity');
el.addEventListener('change', function() {
	var value = (el.value || el.options[el.selectedIndex].value);
	var date = new Date(new Date().getTime() + 31536000 * 1000);
	document.cookie = 'city_id=' + value + '; path=/; expires=' + date.toUTCString();
	location.reload();
});