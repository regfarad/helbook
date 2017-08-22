$(document).ready(function(){
  $('#login').keyup(function(){
      var login = $('#login').val();
      
      if (login !== "") {
          $.post('loginExiste.php',{login:login}, function(data) {
              $('.feedback').text(data);
          });
      }
  });  
});
