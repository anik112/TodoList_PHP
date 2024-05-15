<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Script/style.css">
</head>

<body>
    <div class="checkbox-container">
        <h2 class="heading">To-do list</h2>
        <div class="checkbox-group">
            <input type="checkbox" id="checkbox1">
            <label for="checkbox1">Listen to music</label>
        </div>
        <div class="checkbox-group">
            <input type="checkbox" id="checkbox2">
            <label for="checkbox2">Learn JavaScript</label>
        </div>
        <div class="checkbox-group">
            <input type="checkbox" id="checkbox3">
            <label for="checkbox3" class="checkbox-label">Watch a movie</label>
        </div>
        <div class="checkbox-group">
            <input type="checkbox" id="checkbox4">
            <label for="checkbox4">Read emails</label>
        </div>
    </div>
</body>

</html>

<script>
    let checkboxes = document.querySelectorAll("input[type='checkbox']");
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener("click", checkboxHandler);
    });

    function checkboxHandler() {
        if (this.checked === true) {
            this.closest(".checkbox-group").classList.add("checked");
        } else {
            this.closest(".checkbox-group").classList.remove("checked");
        }
    }
</script>