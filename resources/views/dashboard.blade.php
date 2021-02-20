@extends('navigation.navigation')
@section('title')
    Dashboard
@endsection
@section('header')
    Dashboard
@endsection
@section('content')
{{--
   NIM : 10119003
  Nama : Ivan Faathirza
  Kelas : IF1 
--}}
                
<div class="col-lg-6">
    <div class="custom-card">                  
        <div class="custom-card-header">
        <h5>Grafik Penjualan</h5>                    
        </div>                                      
        <div class="custom-card-body">                            
            <div style="width:auto;height: auto">
                <canvas id="myChart"></canvas>
            </div>                                                                             
        </div>
    </div>
</div>   
@endsection

@push('scripts')
    <script>          
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November"],
                datasets: [{
                    label: 'data grafik',
                    data: $.parseJSON('{!!$bulan!!}'),
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
@endpush

