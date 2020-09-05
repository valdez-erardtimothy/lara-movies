let producer_edit = function() {
  
  function showAddFilmModal() {
    $('#addFilmModal').modal()
  }

  window.addEventListener('load', () => {
    document.getElementById('add-film').addEventListener('click', function() {
      showAddFilmModal();
    });
  });
}();