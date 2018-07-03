import React, { Component } from 'react';
// import logo from './logo.svg';
// import './App.css';

class Form extends Component{
	constructor() {
		super();
		let inputs = {
			"input1":{
				"obj": "name",
				"typ": "text"
			},
			"input2":{
				"obj": "content",
				"typ": "text"
			},
			"input3":{
				"obj": "images",
				"typ": "files[]"
			}
		}
	}

	Formulaire(action, method, inputs) {
		return (
			<form action={action} method={method}>

			</form>
		);
	}
	render() {
		return (<div>{Input("input3":{
			"obj": "images",
			"typ": "files[]"
		})}</div>);
	}
	Input(inputs)
	{
		return (
			inputs.forEach(() => {
				<div className="form-group">
					<label htmlFor={inputs.obj}>Enter {inputs.obj}</label>
					<input ref={inputs.obj} id={inputs.obj} name={inputs.obj} type={inputs.typ} />
				</div>
			})
		);
	}
}
export default Form;
