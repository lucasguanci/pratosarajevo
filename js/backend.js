$(document).ready(function(){
  $('form.backend').submit(function(e) {
    e.preventDefault();
    artista = new Object();
    artista.username = $(this).find('input[name=username]').val();
    artista.nome = $(this).find('input[name=nome]').val();
    artista.username = $(this).find('input[name=username]').val();
    artista.immagini = [];
    $(this).find('input.immagini').each(function(){
      if ( $(this).val()!="" ) {
        artista.immagini.push($(this).val());        
      }
    });
    $(this).find('input.didascalie').each(function(){
      if ( $(this).val()!="" ) {
        artista.didascalie.push($(this).val());
      }
    });
    artista.bio = $(this).find('textarea[name=bio]').val();
    console.log(artista.username);
    $.post('api.php/artists', JSON.stringify(artista), function(data) {
      console.log(data);
    });
  })
})