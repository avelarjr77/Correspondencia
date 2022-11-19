$("#nombreDocumento").fileinput({
    language: 'es',
    maxFilePreviewSize: 21000,
    maxFileSize: 21000,
    allowedFileExtensions: ["txt", "pdf", "doc", "jpg", "png"],
    actionUpload: false,
    showZoom: true,
    initialPreviewAsData: true,
});
