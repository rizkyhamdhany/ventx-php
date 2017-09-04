var Contact = function () {

    return {
        //main function to initiate the module
        init: function () {
			var map;
			$(document).ready(function(){
			  map = new GMaps({
				div: '#gmapbg',
				lat: -6.9037214,
				lng: 107.6538229
			  });
			   var marker = map.addMarker({
                    lat: -6.9037214,
                    lng: 107.6538229,
		            title: 'Nalar Creative.',
		            infoWindow: {
		                content: "<b>Nalar Creative.</b> Jl. Jend. A. Yani No.782,<br> Kota Bandung"
		            }
		        });

			   marker.infoWindow.open(map, marker);
			});
        }
    };

}();

jQuery(document).ready(function() {    
   Contact.init(); 
});

