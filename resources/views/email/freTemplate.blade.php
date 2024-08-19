@extends('layouts.app')
@section('content')

@php

use App\Models\Setting;
  // Retrieve the setting
  $type='fre_emailer';
  $clientId=$client->id;
  $setting = Setting::where('client_id', $clientId)
                      ->where('type', $type)
                      ->first();

    // Initialize formData as an empty array
    $formData = [];

    // Check if setting exists and form_data is valid JSON
    if ($setting) {
        json_decode($setting->form_data);
        if (json_last_error() === JSON_ERROR_NONE) {
            // Decode JSON data if valid
            $formData = json_decode($setting->form_data, true);
        }
    }

@endphp

<div class="lead_adds_sec">
    <div class="row">
        <div class="col-lg-3">
             <x-project-side-menu :client="$client" />
        </div>
        <div class="col-lg-9">
            <div class="lead_adds_main_wrapper py-5 px-4">

                <form action="{{ route('store.Or.Update.Setting', [
                'client_id' =>$clientId,
                'type' => $type,
                ]) }}" method="POST">

                    @csrf
                    <div class="form-group mb-3 col-lg-6">
                        <label class="text-black" for="email">Subject </label>
                        <input type="text" class="form-control" name="subject" id="subject" value="{{ old('subject', $formData['subject'] ?? '') }}">
                    </div>
                    <div>
                    <div class="form-group mb-3">
                        <label class="text-black" for="Message Body">Message Body</label>
                        <textarea name="message_body" rows="8" cols="60">{{ old('message_body', $formData['message_body'] ?? '') }}</textarea>
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
