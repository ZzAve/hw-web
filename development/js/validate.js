function validate_email(email){
	var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
	return emailPattern.test(email);
}
function validate_number(number){
	var numPattern = /\d{8,15}/
	return numPattern.test(number);
}
function stripTags(input){
	return input.replace(/<\/?[^>]+(>|$)/g, "").replace(/^\s*/, "").replace(/\s*$/, "");
} 

function validate()
{
	var doc = document.contact_form;
	if(stripTags(doc.name.value) == '')
	{
		alert("Vul a.u.b. een naam in.");
		doc.name.focus();
		return false;
	}
	if(!validate_email(stripTags(doc.email.value))){
		alert("Vul a.u.b. een geldig e-mail adres in");
		doc.email.focus();
		return false;
	}
	if(!validate_number(doc.phone.value))
	{
		alert("Vul a.u.b. een geldig telefoonnummer in (0-9)");
		doc.phone.focus();
		return false;
	}

	if(stripTags(doc.bericht.value) == '')
	{
		alert("Vul a.u.b. een bericht in");
		doc.bericht.focus();
		return false;
	}
	return  true;
}
