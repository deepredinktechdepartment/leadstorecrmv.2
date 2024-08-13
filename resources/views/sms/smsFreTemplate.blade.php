@extends('layouts.app')
@section('content')
<h1 class="mb-4">Settings for {{ $client->client_name }}</h1>
<div class="lead_adds_sec">
    <div class="row">
        <div class="col-lg-3">
             <x-project-side-menu :client="$client" />
        </div>
        <div class="col-lg-9">
            <div class="lead_adds_main_wrapper py-5 px-4">
                <h2 class="mb-3">A2AHome Land SMS FRE Template</h2>
                <form action="#">
                    <div class="alert alert-info mb-3" role="alert">
                        <div class="row">
                            <div class="col-md-3">
                                [firstname]<br>[phone]<br>[email]<br>[message]
                            </div>
                            <div class="col-md-3">
                                [utm_source]<br>[utm_medium]<br>[utm_campaign]<br>[utm_term]<br>[utm_content]
                            </div>
                            <div class="col-md-3">
                                [udf1]<br>[udf2]<br>[udf3]<br>[udf4]<br>[udf5]
                            </div>
                            <div class="col-md-3">
                                [attachment_file]<br>[landing_page_title]
                            </div>
                        </div>
                    </div>
                    
                    <div>
                    <div class="form-group mb-3">
                        <label class="text-black" for="Message Body">Message Body</label>
                        <textarea name="message_body" rows="8" cols="60"></textarea>
                            <script type="text/javascript">//<![CDATA[
                                window.CKEDITOR_BASEPATH='https://leadstore.in/assets/ckeditor/';
                                //]]></script>
                                <script type="text/javascript" src="https://leadstore.in/assets/ckeditor/ckeditor.js?t=B5GJ5GG"></script>
                                <script type="text/javascript">//<![CDATA[
                                CKEDITOR.replace('message_body', {"filebrowserBrowseUrl":"\/setting\/fre_template\/https:\/\/leadstore.in\/assets\/ckfinder\/ckfinder.html","filebrowserImageBrowseUrl":"\/setting\/fre_template\/https:\/\/leadstore.in\/assets\/ckfinder\/ckfinder.html?type=Images","filebrowserFlashBrowseUrl":"\/setting\/fre_template\/https:\/\/leadstore.in\/assets\/ckfinder\/ckfinder.html?type=Flash","filebrowserUploadUrl":"\/setting\/fre_template\/https:\/\/leadstore.in\/assets\/ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Files","filebrowserImageUploadUrl":"\/setting\/fre_template\/https:\/\/leadstore.in\/assets\/ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Images","filebrowserFlashUploadUrl":"\/setting\/fre_template\/https:\/\/leadstore.in\/assets\/ckfinder\/core\/connector\/php\/connector.php?command=QuickUpload&type=Flash"});
                                //]]>
                            </script>
                        </div>
                    </div>
                    <div>
                        <button id="send" type="submit" class="btn btn-danger">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
