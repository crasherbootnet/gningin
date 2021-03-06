<script>
	//init tinyMCE
	tinymce.init({
		selector:"textarea.tinymce",
	  height: 500,
	  theme: 'modern',
	  readonly: @if($project->isLock() || $project->isClosed()) 1 @else 0 @endif,
	  plugins: [
	    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
	    'searchreplace wordcount visualblocks visualchars code fullscreen',
	    'insertdatetime media nonbreaking save table contextmenu directionality',
	    'emoticons template paste textcolor colorpicker textpattern imagetools'
	  ],
	  toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
	  toolbar2: 'print preview media | forecolor backcolor emoticons',
	  image_advtab: true,
		statubar:true
	});

</script>