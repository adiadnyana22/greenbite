<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenBite Notification Mail</title>
</head>
<body>
    <h1>Pesanan anda di <b><span style="color: #4C9A2E;">Green</span>Bite</b> telah bisa diambil di merchant</h1>
    <div style="margin: 2rem 0;">
        <p>Berikut detail pesanan anda :</p>
        <table>
            <tr>
                <td>Kode Transaksi</td>
                <td>:</td>
                <td>{{ $order_code }}</td>
            </tr>
            <tr>
                <td>Nama Makanan</td>
                <td>:</td>
                <td>{{ $food_name }}</td>
            </tr>
        </table>
        <p>Perlu diingat, anda hanya bisa melakukan pengambilan di pukul <strong>{{ $start_pickup }} - {{ $end_pickup }}</strong></p>
        <p>Jika sudah melewati waktu tersebut, maka makanan tidak akan bisa diambil lagi dan pesanan akan hangus</p>
        <a href="https://www.google.com/maps/search/?api=1&query={{ $latitude }}%2C{{ $longitude }}" target="_blank" style="display: block; margin-bottom: .5rem">Lihat lokasi merchant dalam maps</a>
        <a href="https://www.greenbite.com/" target="_blank" style="display: block">Lihat pesanan lebih detail di GreenBite</a>
    </div>
    <div style="margin-top: 2rem;">
        <p>Terima Kasih</p>
    </div>
</body>
</html>