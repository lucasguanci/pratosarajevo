$(document).ready(function(){
  $.getJSON('ps-api-redis.php/artists/1',function(data) {
    console.log("lapolla's data: "+data);
    // managing template
    var source = $("#template-artisti").html();
    var template = Handlebars.compile(source);
    var html = template(data);
    $('#test-container').append(html);
  })
});