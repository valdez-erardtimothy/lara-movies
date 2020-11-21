let siteIndex = function() {
  
  let filmTable = document.querySelector('#films');
  
  function fetchFilms() {
    let xhr= new XMLHttpRequest();
    xhr.open('get', '/api/films/');
    xhr.responseType="json";
    xhr.onreadystatechange = function() {
      if(xhr.readyState === 4 && xhr.status === 200) {
        populatefilmTable(xhr.response);
      } else {
         console.log('readystate: ' + xhr.readyState);
      }
    };
    xhr.send();
    
  }

  function populatefilmTable(filmJSON) {
    // console.log(filmJSON.data);
    for(film of filmJSON.data) { 
      console.log(film);
      let tr = document.createElement("tr");
      let title = document.createElement("td");
      let genre = document.createElement("td");
      let link = film.link;
      let link_a = document.createElement('a');
      link_a.innerHTML=link;
      
      link_a.href=film.link;  
      link_a.text=film.title;
      title.appendChild(link_a);
      
      genre.innerHTML = film.genre;
      
      tr.appendChild(title);
      tr.appendChild(genre);
      filmTable.appendChild(tr);
    }
  }
  
  window.addEventListener('load', () => {
    fetchFilms();
  });
}();