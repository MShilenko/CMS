document.addEventListener("DOMContentLoaded", function(){
	const defaultPagerAdminLimit = 20;

	let app = new Application();
	let forms = document.forms;
	let subscribeForm = forms.subscribe;
	let authorizationForm = forms.userAuthorization;
	let registrationForm = forms.userRegistration;
	let commentForm = forms.comment;
	let editProfile = forms.editProfile;
	let articleEdit = forms.articleEdit;
	let commentEdit = forms.commentEdit;
	let pageEdit = forms.pageEdit;
	let addSettings = forms.addSettings;
	let addFilter = forms.addFilter;
	let adminAddUser = forms.adminAddUser;

	if (subscribeForm) app.formBuilderFetch(subscribeForm);
	if (commentForm) app.formBuilderFetch(commentForm);
	if (authorizationForm) app.formBuilderFetch(authorizationForm, '/personal-area');
	if (registrationForm) app.formBuilderFetch(registrationForm, '/personal-area');
	if (editProfile) app.formBuilderFetch(editProfile, '/personal-area');
	if (articleEdit) app.formBuilderFetch(articleEdit);
	if (commentEdit) app.formBuilderFetch(commentEdit);
	if (pageEdit) app.formBuilderFetch(pageEdit);
	if (adminAddUser) app.formBuilderFetch(adminAddUser, '/admin/users');
	if (addSettings) app.formBuilderFetch(addSettings);
	if (forms.rolesEdit) app.formsAddToLsitforBuilder(forms, 'editRoles');
	if (forms.articleSwitchPublication) app.formsAddToLsitforBuilder(forms, 'articleSwitchPublication');
	if (forms.subscribeDelete) app.formsAddToLsitforBuilder(forms, 'subscribeDelete');
	if (forms.commentsSwitchPublication) app.formsAddToLsitforBuilder(forms, 'commentsSwitchPublication');
	if (forms.pageSwitchPublication) app.formsAddToLsitforBuilder(forms, 'pageSwitchPublication');
	if (forms.userSwitchLockOut) app.formsAddToLsitforBuilder(forms, 'userSwitchLockOut');

	///////////////////////////////////////////////////////////////////////////
	
	if (registrationForm) {
		registrationForm.rules.addEventListener('change', function() {
			this.checked ? registrationForm.addUser.disabled = false : registrationForm.addUser.disabled = true;
		}); 			
	}

	let articleEdits = document.querySelectorAll('.article-edit');
	let subscribeEdits = document.querySelectorAll('.subscibe-edit');
	let commentEdits = document.querySelectorAll('.comment-edit');
	let pageEdits = document.querySelectorAll('.page-edit');
	let userEdits = document.querySelectorAll('.user-edit');

	if (userEdits) app.toggleBlockClass(userEdits, 'trashed', 'editRoles');
	if (articleEdits) app.toggleBlockClass(articleEdits, 'trashed');
	if (pageEdits) app.toggleBlockClass(pageEdits, 'trashed');
	if (commentEdits) app.toggleBlockClass(commentEdits, 'not-active');
	if (subscribeEdits) app.toggleBlockClass(subscribeEdits, 'd-none');

	if (addFilter && window.location.search.includes('on_page') == false) {
		addFilter.on_page.value = defaultPagerAdminLimit;
	}	
}); 