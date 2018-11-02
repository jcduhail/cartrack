import React, {Component} from 'react';
import PropTypes from 'prop-types'
import {Redirect} from 'react-router-dom';
//import {withRouter} from 'react-router'
import './UserForm.css';

class UserForm extends Component {

   static propTypes = {
	    userInfo: PropTypes.object.isRequired,
    }
	
    constructor(props){
        super(props);
        console.log(this.props.userInfo);
    }

   render() {
   if (sessionStorage.getItem('userData')){
       return (
    		   <div className="user_form">
    		   {this.props.userInfo.name}({this.props.userInfo.email})
    		   </div>
              );

   }else{
       return (<Redirect to={'/'}/>)
   }

}
}
export default UserForm;