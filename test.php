<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Radio Button with Value 0</title>
</head>

<body>
  <form id="myForm">
    <label>
      <input type="radio" name="myRadio" onclick="setValue(this)" value="1"> กด
    </label>
    <label>
      <input type="radio" name="myRadio" onclick="setValue(this)" value="0"> ไม่กด
    </label>
  </form>

  <script>
    function setValue(radio) {
      // Set all radio buttons to value 0 first
      document.querySelectorAll('[name="myRadio"]').forEach(input => input.value = "0");
      // Then set the selected radio button to 1
      if (radio.checked) {
        radio.value = "1";
      }
    }
  </script>
</body>

</html>