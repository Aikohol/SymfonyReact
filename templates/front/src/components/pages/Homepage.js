import React, { Component } from 'react';
import {
	Link
} from 'react-router-dom';
import $ from 'jquery';


class Homepage extends Component {
	constructor() {
		super();
		this.handleSubmit = this.handleSubmit.bind(this);
	}

	handleSubmit(event) {
		event.preventDefault();

		let doc = {
			"attributes": {
				"name": this.refs.name.value,
				"content": this.refs.content.value
			},
			"images":{
				"image1": {"path":this.refs.img.value}
			}
		}

		var chaineJSON = JSON.stringify(doc);
		console.log("chaineJson : "+chaineJSON);
	}
	render () {
		return (
			<div className="zbeub">
				<div className="App">
					<a href="/articles/new">formulaire</a>
				</div>
				<p className="App-intro">Articles</p>
			</div>
		);
	}
}
export default Homepage;
