import React, { Component } from 'react';
import logo from '../Assets/logo.svg';
import '../Assets/App.css';
import {
	Link
} from 'react-router-dom';

class Header extends Component {

	render () {
		return (
			<header className="App-header">
				<img src={logo} className="App-logo" alt="logo" />
				<h1 className="App-title">Articles</h1>
			</header>
		);
	}
}
export default Header;
