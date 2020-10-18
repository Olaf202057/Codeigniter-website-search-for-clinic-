$(function() {
          
            $("#search_q").autocomplete({
                source: "search_suggest.php?type=q",
                minLength: 2,
                select: function(event, ui) {
                    $('#search_q').val(ui.item.hospital);
                }
            });
                      
            $("#search_city").autocomplete({
                source: "search_suggest.php?type=city",
                minLength: 2,
                select: function(event, ui) {
                    $('#search_city').val(ui.item.hospital);
                }
            });
 });
