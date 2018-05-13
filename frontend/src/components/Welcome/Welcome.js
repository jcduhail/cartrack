import React, {Component} from 'react';
import {Redirect} from 'react-router-dom';
import './Welcome.css';

class Welcome extends Component {
render() {
if (sessionStorage.getItem('userData')){
    return (<Redirect to={'/home'}/>)
}
return (
<div className="row">
<div className="medium-12 columns">
<a href="/login" className="button">Login</a>
<a href="/signup" className="button success">Signup</a>
</div>
</div>
);
}
}
export default Welcome;