document.addEventListener("DOMContentLoaded", function(){
	let app = new Application();
	let forms = document.forms;
	let subscribeForm = forms.subscribe;
	let authorizationForm = forms.userAuthorization;
	let registrationForm = forms.userRegistration;
	let commentForm = forms.comment;
	let editProfile = forms.editProfile;

	if (subscribeForm) app.formBuilderFetch(subscribeForm);
	if (commentForm) app.formBuilderFetch(commentForm);
	if (authorizationForm) app.formBuilderFetch(authorizationForm, '/personal-area');
	if (registrationForm) app.formBuilderFetch(registrationForm, '/personal-area');
	if (editProfile) app.formBuilderFetch(editProfile, '/personal-area');
	if (forms.rolesEdit) {
		for(let form of forms) {
			form.classList.contains('editRoles') ? app.formBuilderFetch(form) : '';
		}
	}

	///////////////////////////////////////////////////////////////////////////
	
	if (registrationForm) {
		registrationForm.rules.addEventListener('change', function() {
			this.checked ? registrationForm.addUser.disabled = false : registrationForm.addUser.disabled = true;
		}); 			
	}
}); 