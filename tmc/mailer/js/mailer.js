var miniform = document.getElementById('miniform');
var mainform = document.getElementById('mainform');

function makeForm(paramForm) {
	var formName = paramForm.getAttribute('id');
	var ctaH = '<h2>' + paramForm.getAttribute('data-headline') + '</h2>';
	var checkbox = paramForm.getAttribute('data-checkbox');
	var disclaimer = '';
	if (checkbox == 'true') {
		var disclaimer = '<input id="disclaimer-' + formName + '" name="disclaimer" type="checkbox" value="disclaimer" /><label for="disclaimer"><a onclick="javascript:window.open(\'/disclaimer.html\',\'\',\'width=300,height=140,location=no,resizeable=no,status=no\'); return;">Disclaimer</a></label>';
	} else if (checkbox == 'full') {
		var disclaimer = '<input id="disclaimer-' + formName + '" name="disclaimer" type="checkbox" value="disclaimer" /><label for="disclaimer">Disclaimer: I agree that by contacting you that no client-lawyer relationship has been created. The information that I provide will not be kept confidential. The information on this website is general information and does not constitute legal advice and the reader should not rely on it to solve their individual problem.</label>';
	}
	var ctaSubmit = paramForm.getAttribute('data-ctasubmit');
	var formHTML = '<form method="post" id='+formName+'-form>' + ctaH + '<fieldset id="inputs-' + formName + '"></fieldset><fieldset id="areas-' + formName + '"></fieldset>' + disclaimer + '<input type="hidden" name="page" value="'+document.URL+'" /><input type="text" class="url" name="url" value="" /> <input type="Submit" id="submit-' + formName + '" class="submit" value="' + ctaSubmit + '"></form>';
	paramForm.innerHTML = formHTML;
}
function addInputs(paramForm) {
	var formName = paramForm.getAttribute('id');
	var inputsTarget = 'inputs-' + formName;
	var inputs = document.getElementById(inputsTarget);
	var textInputAttr = paramForm.getAttribute('data-textinput');
	var textInputArray = textInputAttr.split(' ');
	var textInputHTML = '';
	for (var i = 0; i < textInputArray.length; i++) {
		textInputHTML += '<div class="'+textInputArray[i]+'"><label for="' + textInputArray[i] + '">' + textInputArray[i].replace(/_/g," ") + '</label><input id="' + textInputArray[i] + '-' + formName + '" type="text" name="' + textInputArray[i] + '" /></div>';
	}
	inputs.innerHTML = textInputHTML;
}
function addAreas(paramForm) {
	var formName = paramForm.getAttribute('id');
	var areasTarget = 'areas-' + formName;
	var areas = document.getElementById(areasTarget);
	var textAreaAttr = paramForm.getAttribute('data-textarea');
	if (textAreaAttr !== null) {
		var textAreaHTML = '';
		var textAreaArray = textAreaAttr.split(' ');
		var areas = document.getElementById(areasTarget);
		for (var i = 0; i < textAreaArray.length; i++) {
			textAreaHTML = '<div class="'+textAreaArray[i]+'"><label for="' + textAreaArray[i] + '">' + textAreaArray[i].replace(/_/g," ") + '</label><textarea id="' + textAreaArray[i] + '-' + formName + '" name="' + textAreaArray[i] + '"></textarea></div>';
		}
		areas.innerHTML = textAreaHTML;
	}
}

function addTrack(paramForm) {
	var formName = paramForm.getAttribute('id')+'-form';
	var formElement = document.getElementById(formName);
	var ga_source = '';
	var ga_campaign = '';
	var ga_medium = '';
	var ga_term = '';
	var ga_content = '';
	var gc = '';
	var hiddenSource = '';
	var hiddenMedium = '';
	var hiddenKeywrd = '';
	var c_name = "__utmz";
	var i = '';
	var c_end = '';
	if (document.cookie.length>0){
		var c_start = document.cookie.indexOf(c_name + "=");
		if (c_start!=-1){
			c_start=c_start + c_name.length+1;
			c_end=document.cookie.indexOf(";",c_start);
			if (c_end==-1) c_end=document.cookie.length;
			gc = decodeURI(document.cookie.substring(c_start,c_end));
		}
	}
	if(gc != "" && gc != undefined ){
		console.log('std')
		var z = gc.split('.'); 
		var y = gc.split('utm');
		if(z.length >= 4){
			for(i=0; i<y.length; i++){
				if(y[i].indexOf('csr=') >= 0) ga_source = y[i].substring(y[i].indexOf('=')+1).replace('|','');
				if(y[i].indexOf('ccn=') >= 0) ga_campaign = y[i].substring(y[i].indexOf('=')+1).replace('|','');
				if(y[i].indexOf('cmd=') >= 0) ga_medium = y[i].substring(y[i].indexOf('=')+1).replace('|','');
				if(y[i].indexOf('ctr=') >= 0) ga_term = y[i].substring(y[i].indexOf('=')+1).replace('|','');
				if(y[i].indexOf('cct=') >= 0) ga_content = y[i].substring(y[i].indexOf('=')+1).replace('|','');
				if(y[i].indexOf('gclid=') >= 0) {
					ga_source = 'google';
					ga_medium = 'cpc';
				}
			}
		}
		if(ga_source.length > 0) {
		var hiddenSource = '<input type="hidden" name="source" value="'+ga_source+'" />';
		}
		if(ga_medium.length > 0) {
			var hiddenMedium = '<input type="hidden" name="medium" value="'+ga_medium+'" />';
		}
		if(ga_term.length > 0) {
			var hiddenKeywrd = '<input type="hidden" name="keyword" value="'+ga_term+'" />';
		}
		var totalHidden = hiddenSource+hiddenMedium+hiddenKeywrd;
		formElement.insertAdjacentHTML('beforeend',totalHidden);
	}
	else if(gc == "" || gc === undefined ) {
		console.log('ajax')
		//do something to get the utmz on first pageload
		$.ajax({
			url: ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js',
			dataType: "script",
			cache: true,
			success: function() {
				var ga_source = '';
				var ga_campaign = '';
				var ga_medium = '';
				var ga_term = '';
				var ga_content = '';
				var gd = '';
				var hiddenSource = '';
				var hiddenMedium = '';
				var hiddenKeywrd = '';
				var c_name = "__utmz";
				var i = '';
				var c_end = '';
				if (document.cookie.length>0){
					var c_start = document.cookie.indexOf(c_name + "=");
					if (c_start!=-1){
						c_start=c_start + c_name.length+1;
						c_end=document.cookie.indexOf(";",c_start);
						if (c_end==-1) c_end=document.cookie.length;
						gd = decodeURI(document.cookie.substring(c_start,c_end));
					}
				}
				if(gd != ""){
					var z = gd.split('.'); 
					var y = gd.split('utm');
					if(z.length >= 4){
						for(i=0; i<y.length; i++){
							if(y[i].indexOf('csr=') >= 0) ga_source = y[i].substring(y[i].indexOf('=')+1).replace('|','');
							if(y[i].indexOf('ccn=') >= 0) ga_campaign = y[i].substring(y[i].indexOf('=')+1).replace('|','');
							if(y[i].indexOf('cmd=') >= 0) ga_medium = y[i].substring(y[i].indexOf('=')+1).replace('|','');
							if(y[i].indexOf('ctr=') >= 0) ga_term = y[i].substring(y[i].indexOf('=')+1).replace('|','');
							if(y[i].indexOf('cct=') >= 0) ga_content = y[i].substring(y[i].indexOf('=')+1).replace('|','');
							if(y[i].indexOf('gclid=') >= 0) {
								ga_source = 'google';
								ga_medium = 'cpc';
							}
						}
					}
					if(ga_source.length > 0 && ga_source != '') {
						var hiddenSource = '<input type="hidden" name="source" value="'+ga_source+'" />';
					}
					if(ga_medium.length > 0 && ga_medium != '') {
						var hiddenMedium = '<input type="hidden" name="medium" value="'+ga_medium+'" />';
					}
					if(ga_term.length > 0 && ga_term != '') {
						var hiddenKeywrd = '<input type="hidden" name="keyword" value="'+ga_term+'" />';
					}
					var totalHidden = hiddenSource+hiddenMedium+hiddenKeywrd;
					formElement.insertAdjacentHTML('beforeend',totalHidden);
				}
			}
		});
	}
}
if (document.body.contains(miniform)) {
	makeForm(miniform);
	addInputs(miniform);
	addAreas(miniform);
	addTrack(miniform);
}
if (document.body.contains(mainform)) {
	makeForm(mainform);
	addInputs(mainform);
	addAreas(mainform);
	addTrack(mainform);
}
$.validator.addMethod("phoneUS", function(phone_number, element) {
	phone_number = phone_number.replace(/\s+/g, "");
	return this.optional(element) || phone_number.length > 9 && phone_number.match(/^(\+?1-?)?(\([2-9]([02-9]\d|1[02-9])\)|[2-9]([02-9]\d|1[02-9]))-?[2-9]([02-9]\d|1[02-9])-?\d{4}$/);
}, "Please specify a valid phone number");
$.validator.addMethod("anyDate", function(value, element) {
        return value.match(/^(0?[1-9]|1[0-2])[/., -](0?[1-9]|[12][0-9]|3[0-1])[/., -](19|20)?\d{2}$/);
}, "Please enter a date as MM/DD/YYYY");
$('#miniform-form,#mainform-form').each(function() {
	$(this).validate({
		debug: true,
		rules: {
			name: {
				required: true
			},
			email: {
				required: true,
				email: true
			},
			phone: {
				required: true,
				phoneUS: true
			},
			zip: {
				required: true,
				digits: true
			},
			age: {
				required: true,
				digits: true
			},
			disclaimer: {
				required: true
			},
			date_of_birth: {
				required:true,
				anyDate: true
			}
		},
		submitHandler: function(form) {
			var action = '/wp-content/plugins/tmc/mailer/form.php';
			form.setAttribute('action', action);
            $(".submit").attr("disabled", true);
            form.submit();
        }
	});
});