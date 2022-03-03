$(document).ready(function() {
  $('.extrato').click(function(e){
    e.preventDefault();
    var id = $(this).attr('value');
    $.ajax({
      url:'extrato/'+id,
      type: 'get',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
      },
      data: {
        id: id
      },
      dataType: 'html',
      contentType: false,
      processData: false,
      success: function(response){
        $('#modal').html(response);
        $('#modal').modal('show');
        console.log(response);
      }
    })
  });

  setTimeout( function (){
    $("#msg").slideUp('slow', function() {});
  }, 3000);
});


function moeda(e) {
  var conteudo = e.value;
  conteudo = conteudo.replace(/\D/g,"");
  console.log(conteudo);
  return conteudo;
}
