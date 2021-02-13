$(document).on('change','#division_id',function(){
    var id = $(this).val();
    var displaySection = ".district_section";
    var type = "division";
    var url = $(this).attr('attr_url');
    ajaxCall(id,displaySection,type,url);

})

$(document).on('change','#district_id',function(){
    var id = $(this).val();
    var displaySection = ".upazila_section";
    var type = "district";
     var url = $(this).attr('attr_url');
    ajaxCall(id,displaySection,type,url);

})

function ajaxCall(id,displaySection,type,url){
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
        
    $.ajax({
        url: url,
        type: "POST",
        data: {id,type},
        this:displaySection,
        success: function( response ) {
            $(displaySection).html(response);
        }
      });
}