let film_edit = function () {
  let filmDropdown = document.getElementById('film_id');
  function showActorFormModal() {
    $('#addActorModal').modal()
  }
  

  window.addEventListener('load', () => {
    document.getElementById('add-film').addEventListener('click', () => {
      showActorFormModal();
    });

    let editFilmButtons = document.getElementsByClassName('edit-film');
    for(let i = 0; i <editFilmButtons.length; i++ ) {
      editFilmButtons[i].addEventListener('click', function() {
        let rowSelected = this.parentElement.parentElement;
        document.querySelector("#character").value = rowSelected.dataset.characterName ;
        filmDropdown.value = rowSelected.dataset.filmId;
        showActorFormModal();
      });
    }
  });
}();