$( "article li" ).click(function() {
  $( this ).toggleClass( "strike" );
  var icon = 'icon-circle';
  icon += ( ! $(this).hasClass('strike') ) ? '-thin' : '';

  $('svg', this).attr('class', icon);
  $('svg use', this ).attr('xlink:href', 'img/icons.svg#' + icon);
});

//$(".year-2016 article li").html('' + $(this).html);
