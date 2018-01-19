// tinymce plugin
tinymce.init({
// mode : "exact",
// elements: 'content',
mode:"textareas",
theme: 'modern',
height: 300,
convert_urls : false,
content_css: "/libs/tinymce/skins/content.min.css", // Свои стили
editor_deselector : "mceNoEditor", // с этим классом редактор к textarea не будет подключен
language: 'ru',
plugins: [
  'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
  'save table contextmenu directionality emoticons template paste textcolor'
],
toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons'
});
// end