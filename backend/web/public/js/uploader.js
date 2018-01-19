function escapeTags( str ) {
  return String( str )
           .replace( /&/g, '&amp;' )
           .replace( /"/g, '&quot;' )
           .replace( /'/g, '&#39;' )
           .replace( /</g, '&lt;' )
           .replace( />/g, '&gt;' );
}

window.onload = function() {

var msgBox = document.getElementById('msgBox');

var uploader = new ss.SimpleUpload({
      dropzone: 'dragbox',
      button: 'uploadBtn',
      url: '/admin/uploader/upload/', // server side handler
      // progressUrl: 'uploadProgress.php', // enables cross-browser progress support (more info below)
      responseType: 'json',
      name: 'uploadfile',
      multiple: true,
      maxUploads: 3,
      allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'], // for example, if we were uploading pics
      hoverClass: 'hover',
      focusClass: 'focus',
      disabledClass: 'disabled',   
      onSubmit: function(filename, extension) {
          // Create the elements of our progress bar
          var progress = document.createElement('div'), // container for progress bar
              bar = document.createElement('div'), // actual progress bar
              nameFile = document.createElement('div'),
              fileSize = document.createElement('div'), // container for upload file size
              wrapper = document.createElement('div'), // container for this progress bar
              //declare somewhere: <div id="progressBox"></div> where you want to show the progress-bar(s)
              progressBox = document.getElementById('progressBox'); //on page container for progress bars

              // Assign each element its corresponding class
              progress.className = 'progress progress-striped';
              bar.className = 'progress-bar progress-bar-success';
              nameFile.className = 'file-name';
              fileSize.className = 'size';
              wrapper.className = 'progress-wrapper';

              // Assemble the progress bar and add it to the page
              nameFile.innerHTML = filename;
              progress.appendChild(bar); 
              wrapper.appendChild(progress);                                       
              wrapper.appendChild(nameFile); // filename is passed to onSubmit()
              wrapper.appendChild(fileSize);
              progressBox.appendChild(wrapper); // just an element on the page to hold the progress bars    

              // Assign roles to the elements of the progress bar
              this.setProgressBar(bar); // will serve as the actual progress bar
              this.setFileSizeBox(fileSize); // display file size beside progress bar
              this.setProgressContainer(wrapper); // designate the containing div to be removed after upload
            },

            // Do something after finishing the upload
            // Note that the progress bar will be automatically removed upon completion because everything 
            // is encased in the "wrapper", which was designated to be removed with setProgressContainer() 
            onComplete: function(filename, response) {
            // progressBox.style.display = 'block'; // hide progress bar when upload is completed
            if ( !response ) {
                msgBox.innerHTML = 'Не удалось загрузить файл';
                return;
            }

            if ( response.success === true ) {
                $('#update-form').submit(); // Обновить страницу в фоновом режиме (pjax)
                // msgBox.innerHTML = '<strong>' + escapeTags( filename ) + '</strong>' + ' успешно загружен.';
                msgBox.style.display = 'none';
            } else {
                if ( response.msg )  {
                    msgBox.style.display = 'block';
                    msgBox.innerHTML = escapeTags( response.msg );

                } else {
                    msgBox.innerHTML = 'An error occurred and the upload failed.';
                }
            }
          },
        onError: function() {
            progressBox.style.display = 'none';
            msgBox.innerHTML = 'Не удалось загрузить файл';
          }
});

};

// Imgs manager
$(function(){

  $(document).on('click', '.image-min', function() {
    $('#org-img-modal').arcticmodal();
  });

  $(document).on('click', '.del-img', function() {
    var img = $(this).attr('data-img');
    var that = this;
    $.ajax({
      url: "/admin/uploader/delete/",
      type: "POST",
      data: {img: img},
      success: function() {
        // Обновить страницу в фоновом режиме (pjax)
        $('#update-form').submit();
      }
    });
  });
});