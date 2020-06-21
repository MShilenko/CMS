document.addEventListener("DOMContentLoaded", function(){
	let app = new Application();
	let forms = document.forms;
	let subscribeForm = forms.subscribe;
	let authorizationForm = forms.userAuthorization;
	let registrationForm = forms.userRegistration;
	let commentForm = forms.comment;
	let editProfile = forms.editProfile;
	let articleEdit = forms.articleEdit;

	if (subscribeForm) app.formBuilderFetch(subscribeForm);
	if (commentForm) app.formBuilderFetch(commentForm);
	if (authorizationForm) app.formBuilderFetch(authorizationForm, '/personal-area');
	if (registrationForm) app.formBuilderFetch(registrationForm, '/personal-area');
	if (editProfile) app.formBuilderFetch(editProfile, '/personal-area');
	if (articleEdit) app.formBuilderFetch(articleEdit);
	if (forms.rolesEdit) app.formsAddToLsitforBuilder(forms, 'editRoles');
	if (forms.articleSwitchPublication) app.formsAddToLsitforBuilder(forms, 'articleSwitchPublication');
	if (forms.subscribeSwitchPublication) app.formsAddToLsitforBuilder(forms, 'subscribeSwitchPublication');


	///////////////////////////////////////////////////////////////////////////
	
	if (registrationForm) {
		registrationForm.rules.addEventListener('change', function() {
			this.checked ? registrationForm.addUser.disabled = false : registrationForm.addUser.disabled = true;
		}); 			
	}

	let articleEdits = document.querySelectorAll('.article-edit');
	let subscribeEdits = document.querySelectorAll('.subscibe-edit');
	
	for (articleEdit of articleEdits) {
		articleEdit.addEventListener('submit', function() {
			this.classList.toggle('trashed');
		});
	}
	
	for (subscribeEdit of subscribeEdits) {
		subscribeEdit.addEventListener('submit', function() {
			this.classList.add('d-none');
		});
	}
}); 