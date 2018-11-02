import React from 'react';
import ReactDOM from 'react-dom';
import Home from './UserForm';


it('Home renders without crashing', () => {
 const div = document.createElement('div');
 ReactDOM.render(<UserForm />, div);
});