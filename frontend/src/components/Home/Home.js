import React, {Component} from 'react';
import {Redirect} from 'react-router-dom';
import {PostData} from '../../services/PostData';
import './Home.css';
import Slider from "react-slick";

class Home extends Component {

    constructor(){
        super();
        this.state = {
                slides: ''
        };        
        this.logout = this.logout.bind(this);
        this.getcomics = this.getcomics.bind(this);
    }

   getcomics(){
       document.getElementById('slider').innerHTML = 'Loading...';
       PostData('comics',this.state,'GET').then((result) => {
           let responseJson = result;
           if(responseJson.results){
               var html='';
               for (var key in responseJson.results) {
                   console.log(responseJson.results[key]);
                   html += '<div class="comics">';
                   html += '<div><h5>'+responseJson.results[key].title+'</h5></div>';
                   html += '<div style="float:left;width:15%;"><img width="100" src="'+responseJson.results[key].pic+'" /></div><div style="float:left;width:85%;">'+responseJson.results[key].desc+'</div></div>';
                   //html += '<div style="clear:both;" />';
                 }
               this.setState({slides: html});
               //this.forceUpdate();
               document.getElementById('slider').innerHTML = html;
           }else if(responseJson.error){
               alert(responseJson.error.text);
           }
       });
   } 
    
   logout(){
       sessionStorage.removeItem('userData');
       window.location.reload();
   } 
   render() {
   if (sessionStorage.getItem('userData')){
       var settings = {
               dots: true,
               infinite: true,
               speed: 500,
               slidesToShow: 1,
               slidesToScroll: 1
             };
   
       return (
               <div className="row" id="Body">
               <div className="medium-12 columns">
               <h2>Home</h2>
               </div>
               <input type="submit" className="button warning" value="Show comics" onClick={this.getcomics}/>
               <input type="button" className="button alert" value="Logout" onClick={this.logout}/>
               <div id="slider">{this.state.slides}
               {/*<Slider {...settings}>
               </Slider>*/}
               </div>
               </div>
              );

   }else{
       return (<Redirect to={'/'}/>)
   }

}
}
export default Home;