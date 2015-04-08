(function() {
	tinymce.PluginManager.add('tinymce_buttons', function( editor, url ) {
		// Run-in Button
		editor.addButton('runin_button', {
			text: '',
			icon: 'tinymce-runin-icon',
			tooltip: 'Run In',
			onclick: function() {
				var selected_text = editor.selection.getContent();
				var return_text = '';
                return_text = '<span class="run-in">' + selected_text + '</span>';
                editor.insertContent(return_text);
			}
		});
		// CTA Button
		editor.addButton('cta_button', {
			text: '',
			icon: 'tinymce-cta-icon',
			tooltip: 'Call To Action',
			onclick: function() {
				var selected_text = editor.selection.getContent();
				var return_text = '';
                return_text = '<span class="dynamic-button button">' + selected_text + '</span>';
                editor.insertContent(return_text);
			}
		});
		// H1 Button
		editor.addButton('h1_button', {
			text: '',
			icon: 'tinymce-h1-icon',
			tooltip: 'Heading 1',
			onclick: function() {
				var selected_text = editor.selection.getContent();
				var return_text = '';
                return_text = '<h1>' + selected_text + '</h1>';
                editor.insertContent(return_text);
			}
		});
		// H2 Button
		editor.addButton('h2_button', {
			text: '',
			icon: 'tinymce-h2-icon',
			tooltip: 'Heading 2',
			onclick: function() {
				var selected_text = editor.selection.getContent();
				var return_text = '';
                return_text = '<h2>' + selected_text + '</h2>';
                editor.insertContent(return_text);
			}
		});
		// H3 Button
		editor.addButton('h3_button', {
			text: '',
			icon: 'tinymce-h3-icon',
			tooltip: 'Heading 3',
			onclick: function() {
				var selected_text = editor.selection.getContent();
				var return_text = '';
                return_text = '<h3>' + selected_text + '</h3>';
                editor.insertContent(return_text);
			}
		});
		// H4 Button
		editor.addButton('h4_button', {
			text: '',
			icon: 'tinymce-h4-icon',
			tooltip: 'Heading 4',
			onclick: function() {
				var selected_text = editor.selection.getContent();
				var return_text = '';
                return_text = '<h4>' + selected_text + '</h4>';
                editor.insertContent(return_text);
			}
		});
		// H5 Button
		editor.addButton('h5_button', {
			text: '',
			icon: 'tinymce-h5-icon',
			tooltip: 'Heading 5',
			onclick: function() {
				var selected_text = editor.selection.getContent();
				var return_text = '';
                return_text = '<h5>' + selected_text + '</h5>';
                editor.insertContent(return_text);
			}
		});
		// H6 Button
		editor.addButton('h6_button', {
			text: '',
			icon: 'tinymce-h6-icon',
			tooltip: 'Heading 5',
			onclick: function() {
				var selected_text = editor.selection.getContent();
				var return_text = '';
                return_text = '<h6>' + selected_text + '</h6>';
                editor.insertContent(return_text);
			}
		});
	});
})();
