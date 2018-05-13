export function PostData(type, userData, _method) {
    /*let BaseURL = 'http://localhost:9001/api/v1/';*/
    let BaseURL = 'https://klaud9-api.eode9.com/api/v1/';

    return new Promise((resolve, reject) =>{
    
         
        fetch(BaseURL+type, {
            method: _method,
            body: (_method=='POST'?JSON.stringify(userData):undefined)
          })
          .then(function (response) {
        	 console.log(response); 
        	 return response.json();
          }
          )
          .then((res) => {
            resolve(res);
          })
          .catch((error) => {
            reject(error);
          });

  
      });
}