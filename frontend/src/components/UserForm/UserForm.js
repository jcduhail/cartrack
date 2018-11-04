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
    }

   render() {
   if (sessionStorage.getItem('userData')){
	   let georef="https://www.google.com/maps/search/?api=1&query="+this.props.userInfo.address.geo.lat+","+this.props.userInfo.address.geo.lng;
	   let webref="http://"+this.props.userInfo.website;
	   let mailto="mailto:"+this.props.userInfo.email;
       return (
    		   <div className="user_form">
    		   <b>Name :</b> {this.props.userInfo.name}<br/>
    		   <b>Email :</b> {this.props.userInfo.email}<br/>
    		   <b>Address :</b> {this.props.userInfo.address.street}, 
    		   {this.props.userInfo.address.suite}, 
    		   {this.props.userInfo.address.zipcode} {this.props.userInfo.address.city}
    		   <a href={georef} target="_blank"> Open map</a><br/>
    		   <b>Phone number :</b> {this.props.userInfo.phone} <br/> 
    		   <b>Website :</b> <a href={webref} target="_blank">{this.props.userInfo.website}</a><br />
    		   <a href={mailto} target="_top">Contact me</a>
    		   </div>
              );

   }else{
       return (<Redirect to={'/'}/>)
   }

}
}
export default UserForm;