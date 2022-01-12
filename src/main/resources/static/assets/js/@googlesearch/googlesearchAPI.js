/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

const data = null;

const xhr = new XMLHttpRequest();
xhr.withCredentials = true;

xhr.addEventListener("readystatechange", function () {
    if (this.readyState === this.DONE) {
        console.log(this.responseText);
    }
});

xhr.open("GET", "https://google-search3.p.rapidapi.com/api/v1/search/q=elon+musk");
xhr.setRequestHeader("x-user-agent", "desktop");
xhr.setRequestHeader("x-proxy-location", "US");
xhr.setRequestHeader("x-rapidapi-host", "google-search3.p.rapidapi.com");
xhr.setRequestHeader("x-rapidapi-key", "506dd41661msh84541d85087b501p1a63f5jsna4e3b4512799");

xhr.send(data);
