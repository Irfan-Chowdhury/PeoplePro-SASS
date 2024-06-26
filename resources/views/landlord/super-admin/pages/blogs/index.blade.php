@extends('landlord.super-admin.layouts.master')
@section('landlord-content')

<div class="container-fluid mb-3">
    <div class="card">
        <div class="card-header"><h3>{{__('file.Blog Section')}}</h3></div>
        <div class="card-body">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#createModal"><i class="fa fa-plus"></i> {{__('file.Add New')}}</button>
        </div>
    </div>
</div>

<div class="container">
    <div class="table-responsive">
        <table id="dataListTable" class="table">
            <thead>
                <tr>
                    <th>{{ __('file.Image') }}</th>
                    <th>{{ __('file.Blog Title') }}</th>
                    <th class="not-exported">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody id="tablecontents"></tbody>
        </table>
    </div>
</div>

@include('landlord.super-admin.pages.blogs.create-modal')
@include('landlord.super-admin.pages.blogs.edit-modal')

@endsection

@push('scripts')
<script type="text/javascript">
    let dataTableURL = "{{ route('blog.datatable') }}";
    let storeURL = "{{ route('blog.store') }}";
    let editURL = "/super-admin/blogs/edit/";
    let updateURL = '/super-admin/blogs/update/';
    let destroyURL = '/super-admin/blogs/destroy/';
</script>
<script type="text/javascript">
        (function ($) {
            "use strict";
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#dataListTable').DataTable({
                    responsive: true,
                    fixedHeader: {
                        header: true,
                        footer: true
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: dataTableURL,
                    },
                    columns: [
                        {
                            data: 'image',
                            name: 'image',
                        },
                        {
                            data: 'title',
                            name: 'title',
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                        }
                    ],
                });
            });

            //--------- Edit -------
            $(document).on('click', '.edit', function() {
                let id = $(this).data("id");
                $.get({
                    url: editURL + id,
                    success: function(response) {
                        console.log(response);
                        $("#editModal input[name='blog_id']").val(response.id);
                        $("#editModal input[name='title']").val(response.title);
                        tinyMCE.get('edit-description').setContent(response.description);
                        $("#editModal input[name='meta_title']").val(response.meta_title);
                        $("#editModal input[name='og_title']").val(response.og_title);
                        $("#metaDescriptionEdit").val(response.meta_description);
                        $("#ogDescriptionEdit").val(response.og_description);
                        $('#editModal').modal('show');
                    }
                })
            });


            tinymce.init({
                selector: '.text-editor',
                setup: function (editor) {
                    editor.on('change', function () {
                        editor.save();
                    });
                },
                height: 250,
                image_title: true,
                automatic_uploads: true,
                invalid_elements: 'script',
                entity_encoding : "raw",
                file_picker_types: 'image',
                file_picker_callback: function (cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function () {
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.onload = function () {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), {title: file.name});
                        };
                        reader.readAsDataURL(file);
                    };
                    input.click();
                },
                plugins: [
                    'advlist autolink lists link image charmap anchor textcolor',
                    'searchreplace',
                    'insertdatetime media table paste wordcount'
                ],
                menubar: '',
                toolbar: 'insertfile | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | media | forecolor backcolor | table | removeformat',
                branding: false
            });
        })(jQuery);
</script>

    <script type="text/javascript" src="{{ asset('js/landlord/common-js/store.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/landlord/common-js/update.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/landlord/common-js/delete.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/landlord/common-js/alertMessages.js') }}"></script>
@endpush



