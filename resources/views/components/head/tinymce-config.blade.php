<script src="https://cdn.tiny.cloud/1/o8m2fs8x7qfe8v78ffkpbq4kzqiiphz6nhdnsowwssuymsul/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
   tinymce.init({
     selector: 'textarea#description', // Replace this CSS selector to match the placeholder element for TinyMCE
     plugins: 'powerpaste advcode table lists checklist',
     toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table',
     setup: function (editor) {
     editor.on('change', function (e) {
        editor.save();
    });
}
   });
</script>