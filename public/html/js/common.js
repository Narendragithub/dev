function getStates(countryid) {
	$.ajax({
		type: "GET",
        url: "/user/getstates",
        data: 'countryid=' + countryid,
        dataType: "json",
        success: function (response)
        {
		  if (response.status != 1) {
              $('#login_msg').html(response.error).show();
           } else {
			  $('#statehtml').html(response.statehtml);
			 // $('#state').selectpicker();
		   }
        }
    });
}
function getcities(stateid) {
	$.ajax({
		type: "GET",
        url: "/user/getcities",
        data: 'stateid=' + stateid,
        dataType: "json",
        success: function (response)
        {
		  if (response.status != 1) {
              $('#login_msg').html(response.error).show();
           } else {
			  $('#cityhtml').html(response.cityhtml);
			 // $('#city').selectpicker();
		   }
        }
    });
}