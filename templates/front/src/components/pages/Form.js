import React, { Component } from 'react';
import {
	Link
} from 'react-router-dom';
import $ from 'jquery';


class Form extends Component {

	constructor() {
		super();
		this.handleSubmit = this.handleSubmit.bind(this);
		this.state = {path: ""};
	}

	handleSubmit(event) {
		event.preventDefault();
		var $file = $('input[type=file]');
		var file = $file[0].files;

		let doc = {
			"attributes": {
				"name": this.refs.name.value,
				"content": this.refs.content.value
			},
			"nbrImg": file.length
		}

		var chaineJSON = JSON.stringify(doc);
		console.log("chaineJson : "+chaineJSON);

		$.ajax({
			url: "http://localhost:8000/articles/new",
			data: chaineJSON,
			method: 'POST',
			processData: false,
			success: function(data) {
				// console.log(data);
				console.log('Work');
				callback(this, data);
			},
			error: function(err) {
				console.log(err);
				console.log('not work');
			}
		})
		function callback(self, id) {
			var $file = $('input[type=file]');
			var file = $file[0].files;
			var formData = new FormData();
			for(var i = 0; i <= file.length; i++) {
				formData.append('file' + i, file[i]);
			}
			formData.append("article_id", id);

			$.ajax({
				url: 'http://localhost:8000/articles/storeImages',
				data: formData,
				method: 'POST',
				cache: false,
				contentType: false,
				processData: false,
				success: function(data) {
					console.log(data);
				},
				error: function(err) {
					console.log(err);
				}
			})
		}
	}

	render() {
		return (
			<div>
				<a href="/">Home</a>
				<form id="form" name="form" onSubmit={this.handleSubmit} method="POST" encType="multipart/form-data">
				<label htmlFor="name">Enter Name</label>
				<input ref="name" id="name" name="name" type="text" />

				<label htmlFor="content">Enter content</label>
				<input ref="content" id="content" name="content" type="content" />

				<label htmlFor="img">Enter picture</label>
				<input ref="img" id="img" name="img[]" type="file" multiple />

				<button>Send data!</button>
			</form>
		</div>
	);
}
}
export default Form;
