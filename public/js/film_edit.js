let film_edit = function () {
  let actorDropdown = document.getElementById('actor_id');
  function showActorFormModal() {
    $('#addActorModal').modal()
  }
  
  function showProducerFormModal() {
    $('#addProducerModal').modal()
  }

  window.addEventListener('load', () => {
    document.getElementById('add-actor').addEventListener('click', () => {
      showActorFormModal();
    });

    document.getElementById('add-producer').addEventListener('click', () => {
      showProducerFormModal();
    })

    let editActorButtons = document.getElementsByClassName('edit-actor');
    for(let i = 0; i <editActorButtons.length; i++ ) {
      editActorButtons[i].addEventListener('click', function() {
        let rowSelected = this.parentElement.parentElement;
        document.querySelector("#character").value = rowSelected.dataset.characterName;
        actorDropdown.value = rowSelected.dataset.actorId;
        showActorFormModal();
      });
    }
  });
}();