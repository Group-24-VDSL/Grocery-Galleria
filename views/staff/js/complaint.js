$(".btn-description").on("click",function(){
  // $(this).closest("div.description").show();
  $(this).siblings('.description').show();
});

$(".close").on("click",function(){
  // $(this).closest("div.description").show();
  $(this).closest('.description').hide();
});