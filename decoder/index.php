<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
</head>

<body>

    <form>

        <label>Encoded SessionInfo cookie:</label>
        <input type="text" class="input"/>

        <input type="submit" value="Decode" class="submit" />
        <input type="reset" value="Reset" />


        <div>
            Decoded value:
            <div class="result"></div>
        </div>

    </form>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script>
    function sendRequest() {
        var input = $(".input").val();

        $.ajax({
            url: "/tests/decoder/",
            type: "POST",
            dataType: "text",
            data: {
                action: "doDecode",
                input: input
            },
            success: handleDecodeSuccess
        });
    }

    function handleDecodeSuccess(data, textStatus, jqXHR) {
        $(".result").val(data);
    }

    $(".submit").click(sendRequest);
</script>
</body>
</html>
