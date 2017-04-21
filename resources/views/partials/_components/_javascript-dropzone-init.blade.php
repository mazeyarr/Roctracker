<script type="text/javascript">
    var dropzone;
    $(document).ready(function () {
        Dropzone.options.uploadList = {
            autoProcessQueue: false,
            acceptedFiles: "{{$accepted_files}}",
            paramName: "{{$name}}", // The name that will be used to transfer the file
            maxFilesize: {{$filesize}}, // MB
            addRemoveLinks: true,
            maxFiles: {{$max_files}},
            dictInvalidFileType: "{{$invalid_filetype_msg}}",
            dictFileTooBig: "{{$invalid_filesize_msg}}",
            dictRemoveFile: "{{$removeLinks_text}}",
            dictDefaultMessage: "{{$default_msg}}",
            init: function() {
                dropzone = this;
                this.on("error", function(file, response) {
                    this.removeFile(file);
                    var message = "";
                    if($.type(response) === "string") {
                        message = response;
                    }
                    else {
                        message = "er ging iets mis";
                    }
                    $.toast({
                        heading: 'Error'
                        , text: message
                        , position: 'top-right'
                        , loaderBg: '#FB9678'
                        , icon: 'error'
                        , hideAfter: 3500
                        , stack: 6
                    });
                });
            },
            success: function (file, response, xhr) {
                response = jQuery.parseJSON(response);
                this.removeFile(file);
                $.toast({
                    heading: response.title
                    , text: response.message
                    , position: 'top-right'
                    , icon: response.status
                    , hideAfter: 3500
                    , stack: 6
                });
            },
            maxfilesexceeded: function (file) {
                this.removeFile(file);
                $.toast({
                    heading: 'Warning'
                    , text: 'Je kan maar {{count($max_files)}} uploaden...'
                    , position: 'top-right'
                    , loaderBg: '#ffdf00'
                    , icon: 'warning'
                    , hideAfter: 3500
                    , stack: 6
                });
            }
        };
    })
</script>