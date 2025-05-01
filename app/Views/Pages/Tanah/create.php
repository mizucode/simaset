<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Inventori Tanah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
        }

        .btn {
            background: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background: #45a049;
        }

        .required {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Form Inventori Tanah</h1>
        <form action="/admin/prasarana/tanah" method="POST">
            <!-- ID akan otomatis di-generate (hidden) -->
            <input type="hidden" name="id" id="id">
            <input type="hidden" name="lokasi_id" value="1">

            <div class="form-group">
                <label for="kode_tanah">Kode Tanah <span class="required">*</span></label>
                <input type="text" id="kode_tanah" name="kode_tanah" required>
            </div>

            <div class="form-group">
                <label for="nama_tanah">Nama Tanah <span class="required">*</span></label>
                <input type="text" id="nama_tanah" name="nama_tanah" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn">Simpan</button>
            </div>
        </form>
    </div>
</body>

</html>