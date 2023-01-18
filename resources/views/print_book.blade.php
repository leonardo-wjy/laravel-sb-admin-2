<!DOCTYPE html>
<html lang="en">
<head>
  <title>Laporan Data Buku</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>


<!-- <div class="container"> -->


<table width="100%" class="mb-3">
<tr>
<td width="10"><img class="mr-3" src="{{ public_path() . '/img/logo.png' }}" style="width: 130pxpx; height: 130pxpx;"></td>
<td><h1 class="mr-3">Laporan Data Buku</h1></td>
</tr>
</table>
<hr/>

<div class="mb-3"">
    <table class="mb-3">
      <tr class="fs12">
        <td class="fs12" nowrap > <strong>Filter Nama Buku</strong> </td>
        <td>: </td>
        <td>{{ $nama }}</td>
      </tr>

      <tr class="fs12">
        <td class="fs12" nowrap > <strong>Filter Penerbit Buku</strong> </td>
        <td>: </td>
        <td>{{ $penerbit_name }}</td>
      </tr>

      <tr class="fs12">
        <td class="fs12" nowrap> <strong>Filter Kategori Buku</strong> </td>
        <td>: </td>
        <td>{{ $category_name }}</td>
      </tr>

    </table>

  <table class="table table-bordered mt-3" width="100%" style="border: 1px solid black;">
    <thead>
      <tr style="font-size: 18px; text-align: center; padding: 5px 0;">
        <th style="width: 30px !important;border: 1px solid black;">No</th>
        <th style="width: 30px !important;border: 1px solid black;">Nama Buku</th>
        <th style="width: 30px !important;border: 1px solid black;">Kategori</th>
        <th style="width: 30px !important;border: 1px solid black;">Nama Penerbit</th>
        <th style="width: 30px !important;border: 1px solid black;">Tahun Terbit</th>
      </tr>
    </thead>
    <tbody>
        @foreach($buku as $p)
        <tr style="text-align: center;">
            <td style="border: 1px solid black;" width="30px">{{$p['no']}}</td>
            <td style="border: 1px solid black;" width="30px">{{$p['name']}}</td>
            <td style="border: 1px solid black;" width="30px">{{$p['category_name']}}</td>
            <td style="border: 1px solid black;" width="30px">{{$p['penerbit_name']}}</td>
            <td style="border: 1px solid black;" width="30px">{{$p['tahun_terbit']}}</td>
        </tr>
        @endforeach
    </tbody>
  </table>

  </div>
<!-- </div> -->

<!-- </body>
</html> -->

<script type="text/javascript">
	//window.print();
</script>
