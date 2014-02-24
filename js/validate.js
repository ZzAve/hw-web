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

function validateContact()
{
	var doc = $("#contact_form");
	var name = $('#contact_form input[name="name"]');
	if(stripTags( name.val() ) == '')
	{
		alert("Vul a.u.b. een naam in.");
		name.focus();
		return false;
	}
	var email = $('#contact_form input[name="email"]');
	if(!validate_email(stripTags( email.val() ))){
		alert("Vul a.u.b. een geldig e-mail adres in");
		email.focus();
		return false;
	}
	/*if(!validate_number(doc.phone.value))
	{
		alert("Vul a.u.b. een geldig telefoonnummer in (0-9)");
		doc.phone.focus();
		return false;
	}*/
	var subj = $('#contact_form input[name="subject"]');
	if(stripTags(subj.val()) == '')
	{
		alert("Vul a.u.b. een onderwerp in");
		subj.focus();
		return false;
	}
	
	var bericht = $('#contact_form textarea[name="bericht"]');
	if(stripTags(bericht.val()) == '')
	{
		alert("Vul a.u.b. een bericht in");
		bericht.focus();
		return false;
	}
	return  true;
}

function validateGuestbook()
{
	var doc = $("#guestbook");
	var name = $('#guestbook input[name="Naam"]');
	if(stripTags( name.val() ) == '')
	{
		alert("Vul a.u.b. een naam in.");
		name.focus();
		return false;
	}
	var email = $('#guestbook input[name="email"]');
	if(!validate_email(stripTags( email.val() ))){
		alert("Vul a.u.b. een geldig e-mail adres in");
		email.focus();
		return false;
	}
	/*if(!validate_number(doc.phone.value))
	{
		alert("Vul a.u.b. een geldig telefoonnummer in (0-9)");
		doc.phone.focus();
		return false;
	}*/
	
	var bericht = $('#guestbook textarea[name="Bericht"]');
	if(stripTags(bericht.val()) == '')
	{
		alert("Vul a.u.b. een bericht in");
		bericht.focus();
		return false;
	}
	
	// If message is valid (name, e-mail and message), admit it ...
	return  true;
}