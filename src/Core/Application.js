class Application {

	/**
	 * Submit fetch request for builder forms
	 * @param  form
	 * @param  action
	 * @param  redirectURI
	 * @return void
	 */
  formBuilderFetch(form, redirectURI = '', action = window.location.href) {
  	this.prepareServiceFields(form);
  
    form.onsubmit = async (e) => {
    	this.clearServiceFields(form);
	    e.preventDefault();

	    let response = await fetch(action, {
	      method: 'POST',
	      body: new FormData(form)
	    });

	    let result = await response.json();
	   	this.setMessages(form, result);

	    if (result.success && redirectURI != '') {
	    	setTimeout(function(){
			  window.location.href = redirectURI;
			}, 2000);
	    }
	  };
  }

  /**
	 * Add message blocks to the form
	 * @param  form
	 * @param  result
	 * @return void
	 */
  setMessages(form, result) {
  	let formSucccessTag = document.getElementById(form.id + '-success');
  	let formErrorTag = document.getElementById(form.id + '-danger');
  	if (result.success) {
  		formSucccessTag.classList.remove('d-none');
  		formSucccessTag.innerHTML = result.success;
  	}

  	if (result.modelError) {
  		formErrorTag.classList.remove('d-none');
  		formErrorTag.innerHTML = result.modelError;
  	} 

  	if (result.errors) {
  		for (let error in result.errors) {
  			let inputErrorTag = document.getElementById(form.id + '-' + form.elements[error].name + '-error');
  			inputErrorTag.classList.remove('d-none');
  			inputErrorTag.innerHTML = result.errors[error];
			}
  	}
  }

  /**
   * Prepare and display fields for messages
   * @param  form
   * @return void
   */
  prepareServiceFields(form) {
  	form.prepend(this.setFormTag(form, 'success'));
  	form.prepend(this.setFormTag(form, 'danger'));

  	for (let field of form.elements) {
  		if (field.type != 'submit') {
  			field.after(this.setInputTag(form, field));
  		}
  	}
  }

  /**
   * Add message fields for the form
   * @param form
   * @param type
   * @return messageTag
   */
  setFormTag(form, type) {
  	let messageTag = document.createElement('div');
  	messageTag.classList.add('alert', 'mt-2', 'col-lg-12', 'd-none');

  	messageTag.id = form.id + '-' + type; 
  	messageTag.classList.add('alert-' + type);

  	return messageTag;
  }

  /**
   * Add message fields for form fields
   * @param form
   * @param field
   * @return messageTag
   */
  setInputTag(form, field) {
  	let messageTag = document.createElement('div');
  	messageTag.classList.add('alert', 'mt-2', 'col-lg-12', 'd-none');

		messageTag.id = form.id + '-' + field.name + '-error';
	  messageTag.classList.add('alert-danger');

  	return messageTag;
  }

  /**
   * Clear and hide service fields
   * @param  form
   * @return void
   */
  clearServiceFields(form) {
  	let elements = form.querySelectorAll('div[id^=' + form.id + '-]');
  	for (let element of elements) {
  		element.innerHTML = '';
      element.classList.add('d-none');
  	}
  }

}