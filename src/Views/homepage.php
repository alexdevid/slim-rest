<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>The HTML5 Herald</title>
    <meta name="description" content="The HTML5 Herald">
    <meta name="author" content="SitePoint">
</head>

<body>
<script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
    $(function () {
        $.ajax({
            method: 'PUT',
            url: '/article/2',
            dataType: 'json',
            data: {
                "Title": "~~~~~~~~~~~~~"
            },
            done: function (data) {
                console.log(data);
            },
            success: function (data) {
                console.log(data);
            }
        });
    });
</script>
</body>
</html>