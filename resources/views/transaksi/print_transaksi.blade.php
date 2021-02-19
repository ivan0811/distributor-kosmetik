<!DOCTYPE html>
<html lang="en">
<head>    
    <title>Sinar Jaya {{$pesanan->get('no_pesanan')}}</title>
</head>

<style>
    th{
        text-align: left;
        padding-right: 10px;
    }
    table.pesanan{        
    }
    body{
        font-family: 'Calibri';
    }   
    h4{
        margin:0;
    }
    p{
        margin: 0
    }
</style>

<body>    
    <h4>Distributor Sinar Jaya</h4>
    <p>-----------------------------------------------------------------------------------------------------------------------------</p>                                        
    <table border="0">
        <tbody>
            <tr>
                <td  width="320px" colspan="2"><h4>Detail Transaksi</h4></td>                
                <td><h4>Detail Pembayaran</h4></td>
            </tr>
            <tr>
                <th>No Pesanan</th>
                <td>{{$pesanan->get('no_pesanan')}}</td>
                <th>Total Keseluruhan Harga</th>
                <td>{{$pembayaran->get('jumlah_bayar')}}</td>
            </tr>
            <tr>
                <th>Nama Toko</th>
                <td>{{$pesanan->get('nama_toko')}}</td>
                <th>Total Diskon</th>
                <td>{{$pembayaran->get('total_diskon')}}</td>
            </tr>
            <tr>
                <th>Nama Sales</th>
                <td>{{$pesanan->get('nama_sales')}}</td>
                <th>Status Pembayaran</th>
                <td>{{$pembayaran->get('status_pembayaran')}}</td>
            </tr>
            <tr>
                <th>Tanggal Transaksi</th>
                <td>{{$pesanan->get('tanggal_transaksi')}}</td>
                <th>Tanggal Pembayaran</th>
                <td>{{$pembayaran->get('tanggal_pembayaran')}}</td>
            </tr>
            <tr>
                <td></td>                
                <td></td>
                <th>Metode Pembayaran</th>
                <td>{{$pembayaran->get('metode_pembayaran')}}</td>
            </tr>                        
            @if ($pembayaran->get('metode_pembayaran') == "TRANSFER")
            <tr>
                <td></td>
                <td></td>
                <th>Nomor Rekening</th>
                <td>{{$pembayaran->get('nomor_rekening')}}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <th>Atas Nama</th>
                <td>{{$pembayaran->get('atas_nama')}}</td>
            </tr>
            @endif   
            <tr>
                <td></td>
                <td></td>
                <th>Jumlah Bayar</th>
                <td>{{$pembayaran->get('bayar')}}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <th>Kembalian</th>
                <td>{{$pembayaran->get('kembalian')}}</td>            
            </tr>
        </tbody>
    </table>                   
    <p>-----------------------------------------------------------------------------------------------------------------------------</p>
    <h4>Rincian Pesanan</h4>
    <p>-----------------------------------------------------------------------------------------------------------------------------</p>
    <table border="0" class="pesanan">        
            <thead>
                <tr>
                    <th width="100px">Nama Barang</th>
                    <th width="100px">Harga Satuan</th>
                    <th width="100px">Jumlah</th>
                    <th width="100px">Total Harga</th>
                    <th width="100px">Diskon</th>
                </tr>
            </thead>            
            <tbody>
                @foreach ($rincian->all() as $item)
                <tr>
                    <td>{{$item['nama_barang']}}</td>
                    <td>{{$item['harga_satuan']}}</td>
                    <td>{{$item['jumlah']}}/{{$item['satuan']}}</td>                    
                    <td>{{$item['total_harga']}}</td>
                    <td>{{$item['diskon']}}</td>
                </tr>
            @endforeach            
            </tbody>                    
    </table>
    <p>-----------------------------------------------------------------------------------------------------------------------------</p>
    <p>Terima Kasih</p>
</body>
</html>