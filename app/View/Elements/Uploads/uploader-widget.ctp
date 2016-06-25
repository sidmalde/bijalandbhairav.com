<link rel="stylesheet" href="/plugins/FileUpload/css/style.css">
<link rel="stylesheet" href="/plugins/FileUpload/css/jquery.fileupload.css">
<link rel="stylesheet" href="/plugins/FileUpload/css/jquery.fileupload-ui.css">

<!-- The file upload form used as target for the file upload widget -->
<form id="fileupload" action="/upload" method="POST" enctype="multipart/form-data">
    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
    <div class="row fileupload-buttonbar">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <!-- The fileinput-button span is used to style the file input field as button -->
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Add files...</span>
                        <input type="file" name="files[]" multiple>
                    </span>
                    <button type="submit" class="btn btn-primary start">
                        <i class="glyphicon glyphicon-upload"></i>
                        <span>Start upload</span>
                    </button>
                    <?/*<button type="reset" class="btn btn-warning cancel">
                        <i class="glyphicon glyphicon-ban-circle"></i>
                        <span>Cancel upload</span>
                    </button>
                    <button type="button" class="btn btn-danger delete">
                        <i class="glyphicon glyphicon-trash"></i>
                        <span>Delete</span>
                    </button>
                    <input type="checkbox" class="toggle">
                    */?>
                </div>
            </div>
                <!-- The global progress state -->
            <div class="row">
                <div class="col-md-12 fileupload-progress fade">
                    <!-- The global progress bar -->
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                    </div>
                    <!-- The extended global progress state -->
                    <div class="progress-extended">&nbsp;</div>
                    <!-- The global file processing state -->
                    <span class="fileupload-process"></span>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="well">
                <ul>
                    <li>The maximum file size for uploads is <strong>20MB</strong>.</li>
                    <li>Only image files (<strong>JPEG, JPG, GIF, PNG</strong>) are allowed.</li>
                    <li>You can <strong>drag &amp; drop</strong> files from your desktop on this webpage.</li>
                </ul>
            </div>
        </div>
    </div>
    <div>
    </div>
    <!-- The table listing the files available for upload/download -->
    <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
</form>
<br>