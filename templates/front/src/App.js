import React, { Component } from 'react';
import './components/Assets/App.css';
import $ from 'jquery';
import {
	BrowserRouter as Router,
	Route,
	Link
} from 'react-router-dom';

import Form from './components/pages/Form';
import Homepage from './components/pages/Homepage';
import Header from './components/pages/Header';

class App extends Component {

	constructor() {
		super();
		$.ajax({
			url: 'http://localhost:8000/articles/',
			method: 'GET',
			dataType: 'json',
			crossDomain: true,
			async: false,
			success: function(data) {
				console.log(data);
			},
			error: function(err) {
				console.log(err);
			}
		})
	}

	render() {
		return (
			<Router>
				<div className="App">
					<Header />
					<Route exact path='/' component={Homepage} />
					<Route exact path="/articles/new" component={Form} />
				</div>
			</Router>
		);
	}
}
export default App;
