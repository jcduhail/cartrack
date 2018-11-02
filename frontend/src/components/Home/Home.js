import React, {Component} from 'react';
import {Redirect} from 'react-router-dom';
import {PostData} from '../../services/PostData';
import UserForm from '../../components/UserForm/UserForm';
import './Home.css';

class Home extends Component {

    constructor(){
        super();
        this.state = {
                content: '',
                search: '',
                userList: [],
        };        
        this.logout = this.logout.bind(this);
        this.getusers = this.getusers.bind(this);
        this.onChange = this.onChange.bind(this);
        
    }

   getusers(){
       this.setState({content: 'Loading...'});
       PostData('search_users',this.state,'POST').then((result) => {
           let responseJson = result;
           console.log(result);
           this.setState({userList:result.users});
           /*if(responseJson.results){
               var html='';
               for (var key in responseJson.results) {
                   html += '<div class="users">';
                   html += '<div><h5>'+responseJson.results[key].title+'</h5></div>';
                   html += '<div style="float:left;width:15%;"><img width="100" src="'+responseJson.results[key].pic+'" /></div><div style="float:left;width:85%;">'+responseJson.results[key].desc+'</div></div>';
                   //html += '<div style="clear:both;" />';
                 }
               this.setState({content: html});
               //this.forceUpdate();
               document.getElementById('slider').innerHTML = html;
           }else if(responseJson.error){
               alert(responseJson.error.text);
           }*/
       });
   } 
    
   logout(){
       sessionStorage.removeItem('userData');
       window.location.reload();
   }
   
   onChange(e){
       this.setState({[e.target.name]:e.target.value});
   }
   
   render() {
   if (sessionStorage.getItem('userData')){
       return (
               <div className="row" id="Body">
               <div className="medium-12 columns">
               <h2>Home</h2>
               </div>
               <label>User name or email</label>
               <input placeholder="Search" type="text" name="search" className="searchbar" onChange={this.onChange}/>
               <input type="submit" className="button warning" value="Search users" onClick={this.getusers}/>
               <input type="button" className="button alert" value="Logout" onClick={this.logout}/>
               <div id="slider">
               {this.state.userList.filter(user => user.name.toLowerCase().search(this.state.search.toLowerCase()) !== -1 
            		   					  || user.email.toLowerCase().search(this.state.search.toLowerCase()) !== -1  )
                   .map((user, index) => (
                		   <UserForm
                		     userInfo={user}
                		   />
                   ))
               }
               </div>
               </div>
              );

   }else{
       return (<Redirect to={'/'}/>)
   }

}
}
export default Home;