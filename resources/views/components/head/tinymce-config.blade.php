<div>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
        selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'code table lists',
        toolbar: 'undo redo | indent outdent | bullist numlist',
        menubar: false,
        setup: function (editor) {
        editor.on('change', function () {
            tinymce.triggerSave();
        });
    }
    });
    </script>
</div>