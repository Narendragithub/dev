(function( $, window, undefined ) {
  $.danidemo = $.extend( {}, {
    
    addLog: function(id, status, str){
      var d = new Date();
      var li = $('<li />', {'class': 'demo-' + status});
       
      var message = '[' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds() + '] ';
      
      message += str;
     
      li.html(message);
      
      $(id).prepend(li);
    },
    
    addFile: function(id, i, file){
		/*var template = '<div id="demo-file' + i + '" class="fileinput-preview thumbnail image-preview">' +
		                   '<img src="http://placehold.it/48.png" class="demo-image-preview" />' +
		                   '<div class="progress progress-striped active">'+
		                       '<div class="progress-bar" role="progressbar" style="width: 0%;">'+
		                           '<span class="sr-only">0% Complete</span>'+
		                       '</div>'+
		                   '</div>'+
		               '</div>';*/
		var template = '<div id="demo-file' + i + '">' +
                                   '<div class="fileinput fileinput-new">' +
                                    	'<div class="fileinput-preview thumbnail ">'+
                                        	'<img class="image-preview" src="http://placehold.it/48.png">' +
                                       	'</div>'+
                                       	'<div class="progressdiv progress-striped active">'+
					                       '<div class="progress-bar" role="progressbar" style="width: 0%;">'+
					                           '<span class="sr-only">0% Complete</span>'+
					                       '</div>'+
					                   '</div>'+
                                       '<div>' +
                                       '<a href="javascript:void(0)" class="btn btn-danger" onClick="removeimage();">Remove</a>' +
                                       '</div>'+
                                    '</div>'+
                                '</div>';
		               
		var i = $(id).attr('file-counter');
		if (!i){
			$(id).empty();
			
			i = 0;
		}
		
		i++;
		
		$(id).attr('file-counter', i);
		$(id).prepend(template);
	},
	
	updateFileStatus: function(i, status, message){
		$('#demo-file' + i).find('span.demo-file-status').html(message).addClass('demo-file-status-' + status);
	},
	
	updateFileProgress: function(i, percent)
	{

		$('#demo-file' + i).find('div.progress-bar').width(percent);
		
		$('#demo-file' + i).find('span.sr-only').html(percent + ' Complete');
	},
	
	humanizeSize: function(size) {
      var i = Math.floor( Math.log(size) / Math.log(1024) );
      return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
    }

  }, $.danidemo);
})(jQuery, this);

