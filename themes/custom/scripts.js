document.addEventListener("DOMContentLoaded", function(){
	let app = new Application();
	let forms = document.forms;
	let subscribeForm = forms.subscribe;
	let authorizationForm = forms.userAuthorization;
	let registrationForm = forms.userRegistration;
	let commentForm = forms.comment;

	if (subscribeForm) app.formBuilderFetch(subscribeForm);
	if (commentForm) app.formBuilderFetch(commentForm);
	if (authorizationForm) app.formBuilderFetch(authorizationForm, '/');
	if (registrationForm) app.formBuilderFetch(registrationForm, '/');

	///////////////////////////////////////////////////////////////////////////
	
	if (registrationForm) {
		registrationForm.rules.addEventListener('change', function() {
			(this.checked) ? registrationForm.addUser.disabled = false : registrationForm.addUser.disabled = true;
		}); 			
	}
}); 