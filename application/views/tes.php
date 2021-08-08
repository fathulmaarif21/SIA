<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
</head>

<body>
  <input type="file" name="tes" id="tes">

</body>

<script>
  document.getElementById('tes').onchange = function() {

    var file = this.files[0];

    var reader = new FileReader();
    reader.onload = function(progressEvent) {
      // Entire file
      // console.log(this.result);

      // By lines
      var lines = this.result.split(/\r\n|\n/).map(res => res.substr(-21));
      // for (var line = 0; line < lines.length; line++) {
      //   // console.log(lines[line].substr(-21));
      // }
      console.log(lines);
    };
    reader.readAsText(file);
  };
</script>

</html>