const ckeditor = () => {
    const editor = document.getElementById("ckeditor");
    if (editor) {
        ClassicEditor.create(editor);
    }
}

export default ckeditor;