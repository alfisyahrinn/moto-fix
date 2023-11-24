<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1 id="a">alfi</h1>
    <p id="b">2021573010042</p>
    <select class="form-select" id="itemSelect" aria-label="Default select example">
        <option value="1" selected>
            <span class="name">Kampas Rem</span>
            <span class="price">Rp.20.100</span>
        </option>
        <option value="1">
            <span class="name">wakwaww</span>
            <span class="price">Rp.20.100</span>
        </option>
        <!-- Opsi lainnya -->
    </select>
    <button id="searchButton">Cari</button>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchButton').click(function() {
                let name = $('.name').text();
                let price = $('.price').text();

                let a = $('#a').text();
                let b = $('#b').text();


                console.log({
                    name,
                    price,
                });
                console.log('Name:', a);
                console.log('Price:', b);

            });
        });
    </script>

</body>

</html>
