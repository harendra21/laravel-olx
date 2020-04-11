 $("#file").fileinput({
    uploadUrl: '{{ url("/") }}/video-upload/',
    allowedFileExtensions: ["jpg","jpeg"],
});
