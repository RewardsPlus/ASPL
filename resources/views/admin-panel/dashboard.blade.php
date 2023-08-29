@extends('admin-panel.layout.one')
@section('title','Dashboard')
@section('bread-crumb')
<div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6">
          <h3>Analytics Page</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item">admin</li>
            <li class="breadcrumb-item active">Analytics</li>
          </ol>
          <div class="row ">
            <div class="col-4">
            {{-- <form action="{{route('admin.dashboard')}}" method="post"> --}}
              @csrf
            <select class="form-select" onchange="this.form.submit()" name="filter">
              <option value="1" @selected($filter==1)>7 days</option>
              <option value="2" @selected($filter==2)>This Month</option>
              <option value="3" @selected($filter==3)>This Year</option>
            </select>
          </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('content-area')

<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="card o-hidden user-widget">
          <div class="card-header pb-0">
            <div class="d-flex"> 
              <div class="flex-grow-1"> 
                <p class="square-after f-w-600 header-text-primary">New Visitors<i class="fa fa-circle"> </i></p>
                <h4>{{$analyticsData[0]['activeUsers']}}</h4>
              </div>
              <div class="d-flex static-widget">
                <svg class="fill-primary" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5245 23.3155C24.0019 23.3152 26.3325 16.8296 26.9426 11.5022C27.6941 4.93936 24.5906 0 17.5245 0C10.4593 0 7.35423 4.93899 8.10639 11.5022C8.71709 16.8296 11.047 23.316 17.5245 23.3155Z"></path>
                  <path d="M31.6878 26.0152C31.8962 26.0152 32.1033 26.0214 32.309 26.0328C32.0007 25.5931 31.6439 25.2053 31.2264 24.8935C29.9817 23.9646 28.3698 23.6598 26.9448 23.0998C26.2511 22.8273 25.6299 22.5567 25.0468 22.2485C23.0787 24.4068 20.5123 25.5359 17.5236 25.5362C14.536 25.5362 11.9697 24.4071 10.0019 22.2485C9.41877 22.5568 8.79747 22.8273 8.10393 23.0998C6.67891 23.6599 5.06703 23.9646 3.82233 24.8935C1.6698 26.5001 1.11351 30.1144 0.676438 32.5797C0.315729 34.6148 0.0734026 36.6917 0.00267388 38.7588C-0.0521202 40.36 0.738448 40.5846 2.07801 41.0679C3.75528 41.6728 5.48712 42.1219 7.23061 42.4901C10.5977 43.2011 14.0684 43.7475 17.5242 43.7719C19.1987 43.76 20.8766 43.6249 22.5446 43.4087C21.3095 41.6193 20.5852 39.4517 20.5852 37.1179C20.5853 30.9957 25.5658 26.0152 31.6878 26.0152Z"></path>
                  <path d="M31.6878 28.2357C26.7825 28.2357 22.8057 32.2126 22.8057 37.1179C22.8057 42.0232 26.7824 46 31.6878 46C36.5932 46 40.57 42.0232 40.57 37.1179C40.57 32.2125 36.5931 28.2357 31.6878 28.2357ZM35.5738 38.6417H33.2118V41.0037C33.2118 41.8453 32.5295 42.5277 31.6879 42.5277C30.8462 42.5277 30.1639 41.8453 30.1639 41.0037V38.6417H27.802C26.9603 38.6417 26.278 37.9595 26.278 37.1177C26.278 36.276 26.9602 35.5937 27.802 35.5937H30.1639V33.2318C30.1639 32.3901 30.8462 31.7078 31.6879 31.7078C32.5296 31.7078 33.2118 32.3901 33.2118 33.2318V35.5937H35.5738C36.4155 35.5937 37.0978 36.276 37.0978 37.1177C37.0977 37.9595 36.4155 38.6417 35.5738 38.6417Z"></path>
               </svg>
              </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
                <div class="progress-gradient-primary" role="progressbar" style="width: 48%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card o-hidden product-widget">
          <div class="card-header pb-0">
            <div class="d-flex"> 
              <div class="flex-grow-1"> 
                <p class="square-after f-w-600 header-text-success">Returning Visitors<i class="fa fa-circle"> </i></p>
                <h4>{{$analyticsData[1]['activeUsers']}}</h4>
              </div>
              <div class="d-flex static-widget">
                <svg class="fill-success" width="41" height="46" viewBox="0 0 41 46" xmlns="http://www.w3.org/2000/svg">
                  <path d="M17.5245 23.3155C24.0019 23.3152 26.3325 16.8296 26.9426 11.5022C27.6941 4.93936 24.5906 0 17.5245 0C10.4593 0 7.35423 4.93899 8.10639 11.5022C8.71709 16.8296 11.047 23.316 17.5245 23.3155Z"></path>
                  <path d="M31.6878 26.0152C31.8962 26.0152 32.1033 26.0214 32.309 26.0328C32.0007 25.5931 31.6439 25.2053 31.2264 24.8935C29.9817 23.9646 28.3698 23.6598 26.9448 23.0998C26.2511 22.8273 25.6299 22.5567 25.0468 22.2485C23.0787 24.4068 20.5123 25.5359 17.5236 25.5362C14.536 25.5362 11.9697 24.4071 10.0019 22.2485C9.41877 22.5568 8.79747 22.8273 8.10393 23.0998C6.67891 23.6599 5.06703 23.9646 3.82233 24.8935C1.6698 26.5001 1.11351 30.1144 0.676438 32.5797C0.315729 34.6148 0.0734026 36.6917 0.00267388 38.7588C-0.0521202 40.36 0.738448 40.5846 2.07801 41.0679C3.75528 41.6728 5.48712 42.1219 7.23061 42.4901C10.5977 43.2011 14.0684 43.7475 17.5242 43.7719C19.1987 43.76 20.8766 43.6249 22.5446 43.4087C21.3095 41.6193 20.5852 39.4517 20.5852 37.1179C20.5853 30.9957 25.5658 26.0152 31.6878 26.0152Z"></path>
                  <path d="M31.6878 28.2357C26.7825 28.2357 22.8057 32.2126 22.8057 37.1179C22.8057 42.0232 26.7824 46 31.6878 46C36.5932 46 40.57 42.0232 40.57 37.1179C40.57 32.2125 36.5931 28.2357 31.6878 28.2357ZM35.5738 38.6417H33.2118V41.0037C33.2118 41.8453 32.5295 42.5277 31.6879 42.5277C30.8462 42.5277 30.1639 41.8453 30.1639 41.0037V38.6417H27.802C26.9603 38.6417 26.278 37.9595 26.278 37.1177C26.278 36.276 26.9602 35.5937 27.802 35.5937H30.1639V33.2318C30.1639 32.3901 30.8462 31.7078 31.6879 31.7078C32.5296 31.7078 33.2118 32.3901 33.2118 33.2318V35.5937H35.5738C36.4155 35.5937 37.0978 36.276 37.0978 37.1177C37.0977 37.9595 36.4155 38.6417 35.5738 38.6417Z"></path>
                </svg>
              </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
                <div class="progress-gradient-success" role="progressbar" style="width: 48%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
              </div>
            </div>
          </div>
        </div>
    </div>
    {{-- <div class="col-sm-6 col-lg-3">
        <div class="card o-hidden message-widget">
          <div class="card-header pb-0">
            <div class="d-flex"> 
                <div class="flex-grow-1"> 
                    <p class="square-after f-w-600 header-text-secondary">unique Visitors<i class="fa fa-circle"> </i></p>
                    <h4>{{$analyticsData[2]['activeUsers']}}</h4>
                  </div>
              <div class="d-flex static-widget">
                <svg class="fill-warning" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5245 23.3155C24.0019 23.3152 26.3325 16.8296 26.9426 11.5022C27.6941 4.93936 24.5906 0 17.5245 0C10.4593 0 7.35423 4.93899 8.10639 11.5022C8.71709 16.8296 11.047 23.316 17.5245 23.3155Z"></path>
                  <path d="M31.6878 26.0152C31.8962 26.0152 32.1033 26.0214 32.309 26.0328C32.0007 25.5931 31.6439 25.2053 31.2264 24.8935C29.9817 23.9646 28.3698 23.6598 26.9448 23.0998C26.2511 22.8273 25.6299 22.5567 25.0468 22.2485C23.0787 24.4068 20.5123 25.5359 17.5236 25.5362C14.536 25.5362 11.9697 24.4071 10.0019 22.2485C9.41877 22.5568 8.79747 22.8273 8.10393 23.0998C6.67891 23.6599 5.06703 23.9646 3.82233 24.8935C1.6698 26.5001 1.11351 30.1144 0.676438 32.5797C0.315729 34.6148 0.0734026 36.6917 0.00267388 38.7588C-0.0521202 40.36 0.738448 40.5846 2.07801 41.0679C3.75528 41.6728 5.48712 42.1219 7.23061 42.4901C10.5977 43.2011 14.0684 43.7475 17.5242 43.7719C19.1987 43.76 20.8766 43.6249 22.5446 43.4087C21.3095 41.6193 20.5852 39.4517 20.5852 37.1179C20.5853 30.9957 25.5658 26.0152 31.6878 26.0152Z"></path>
                  <path d="M31.6878 28.2357C26.7825 28.2357 22.8057 32.2126 22.8057 37.1179C22.8057 42.0232 26.7824 46 31.6878 46C36.5932 46 40.57 42.0232 40.57 37.1179C40.57 32.2125 36.5931 28.2357 31.6878 28.2357ZM35.5738 38.6417H33.2118V41.0037C33.2118 41.8453 32.5295 42.5277 31.6879 42.5277C30.8462 42.5277 30.1639 41.8453 30.1639 41.0037V38.6417H27.802C26.9603 38.6417 26.278 37.9595 26.278 37.1177C26.278 36.276 26.9602 35.5937 27.802 35.5937H30.1639V33.2318C30.1639 32.3901 30.8462 31.7078 31.6879 31.7078C32.5296 31.7078 33.2118 32.3901 33.2118 33.2318V35.5937H35.5738C36.4155 35.5937 37.0978 36.276 37.0978 37.1177C37.0977 37.9595 36.4155 38.6417 35.5738 38.6417Z"></path>
               </svg>
              </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
                <div class="progress-gradient-warning" role="progressbar" style="width: 48%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
              </div>
            </div>
          </div>
        </div>
    </div> --}}
    <div class="col-sm-6 col-lg-3">
        <div class="card o-hidden message-widget">
          <div class="card-header pb-0">
            <div class="d-flex"> 
                <div class="flex-grow-1"> 
                    <p class="square-after f-w-600 header-text-info">Total Visitors<i class="fa fa-circle"> </i></p>
                    <h4>
                        {{$analyticsData->sum('activeUsers')}}
                    </h4>
                  </div>
              <div class="d-flex static-widget">
                <svg class="fill-info" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5245 23.3155C24.0019 23.3152 26.3325 16.8296 26.9426 11.5022C27.6941 4.93936 24.5906 0 17.5245 0C10.4593 0 7.35423 4.93899 8.10639 11.5022C8.71709 16.8296 11.047 23.316 17.5245 23.3155Z"></path>
                  <path d="M31.6878 26.0152C31.8962 26.0152 32.1033 26.0214 32.309 26.0328C32.0007 25.5931 31.6439 25.2053 31.2264 24.8935C29.9817 23.9646 28.3698 23.6598 26.9448 23.0998C26.2511 22.8273 25.6299 22.5567 25.0468 22.2485C23.0787 24.4068 20.5123 25.5359 17.5236 25.5362C14.536 25.5362 11.9697 24.4071 10.0019 22.2485C9.41877 22.5568 8.79747 22.8273 8.10393 23.0998C6.67891 23.6599 5.06703 23.9646 3.82233 24.8935C1.6698 26.5001 1.11351 30.1144 0.676438 32.5797C0.315729 34.6148 0.0734026 36.6917 0.00267388 38.7588C-0.0521202 40.36 0.738448 40.5846 2.07801 41.0679C3.75528 41.6728 5.48712 42.1219 7.23061 42.4901C10.5977 43.2011 14.0684 43.7475 17.5242 43.7719C19.1987 43.76 20.8766 43.6249 22.5446 43.4087C21.3095 41.6193 20.5852 39.4517 20.5852 37.1179C20.5853 30.9957 25.5658 26.0152 31.6878 26.0152Z"></path>
                  <path d="M31.6878 28.2357C26.7825 28.2357 22.8057 32.2126 22.8057 37.1179C22.8057 42.0232 26.7824 46 31.6878 46C36.5932 46 40.57 42.0232 40.57 37.1179C40.57 32.2125 36.5931 28.2357 31.6878 28.2357ZM35.5738 38.6417H33.2118V41.0037C33.2118 41.8453 32.5295 42.5277 31.6879 42.5277C30.8462 42.5277 30.1639 41.8453 30.1639 41.0037V38.6417H27.802C26.9603 38.6417 26.278 37.9595 26.278 37.1177C26.278 36.276 26.9602 35.5937 27.802 35.5937H30.1639V33.2318C30.1639 32.3901 30.8462 31.7078 31.6879 31.7078C32.5296 31.7078 33.2118 32.3901 33.2118 33.2318V35.5937H35.5738C36.4155 35.5937 37.0978 36.276 37.0978 37.1177C37.0977 37.9595 36.4155 38.6417 35.5738 38.6417Z"></path>
               </svg>
              </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
                <div class="progress-gradient-info" role="progressbar" style="width: 48%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card o-hidden message-widget">
          <div class="card-header pb-0">
            <div class="d-flex"> 
                <div class="flex-grow-1"> 
                    <p class="square-after f-w-600 header-text-danger">Bounce Rate<i class="fa fa-circle"> </i></p>
                    <h4>
                        {{number_format($bounce_rate['bounceRate'],2)}} %
                    </h4>
                  </div>
              <div class="d-flex static-widget">
                <svg class="fill-danger" width="98" height="98" viewBox="0 0 98 98" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M49.1914 0C22.2778 0 0 21.895 0 48.8086C0 75.7222 22.2778 98 49.1914 98C76.105 98 98 75.7222 98 48.8086C98 21.895 76.105 0 49.1914 0ZM73.3507 64.8465C75.5902 67.086 75.5902 70.7284 73.3507 72.9698C71.1285 75.1901 67.486 75.2265 65.2274 72.9698L49.1914 56.9281L32.7707 72.9717C30.5312 75.2112 26.8888 75.2112 24.6474 72.9717C22.4079 70.7323 22.4079 67.0898 24.6474 64.8484L40.6872 48.8086L24.6474 32.7687C22.4079 30.5274 22.4079 26.8849 24.6474 24.6455C26.8888 22.406 30.5312 22.406 32.7707 24.6455L49.1914 40.6891L65.2274 24.6455C67.463 22.4098 71.1055 22.4022 73.3507 24.6455C75.5902 26.8849 75.5902 30.5274 73.3507 32.7687L57.3109 48.8086L73.3507 64.8465Z"></path>
                  </svg>
              </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
                <div class="progress-gradient-danger" role="progressbar" style="width: 48%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="card o-hidden message-widget">
          <div class="card-header pb-0">
            <div class="d-flex"> 
                <div class="flex-grow-1"> 
                    <p class="square-after f-w-600 header-text-danger">Per  User Avg Time Spent on Website<i class="fa fa-circle"> </i></p>
                    <h4>
                        {{$avgspenttime['engagedSessions']}} sec
                    </h4>
                  </div>
              <div class="d-flex static-widget">
                <i class="fa fa-clock-o fa-3x text-success"></i>
               
              </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="progress-widget">
              <div class="progress sm-progress-bar progress-animate">
                <div class="progress-gradient-danger" role="progressbar" style="width: 48%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-xl-12 box-col-12">
        <div class="card">
          <div class="card-header pb-0">
            <h4>Visitor Analytics </h4>
          </div>
          <div class="card-body">
            <div id="area-spaline2"></div>
          </div>
        </div>
      </div>
</div>
<div class="row">
    <div  class="col-lg-4 col-sm-12">
        <div class="card">
            <div class="card-header pb-0">
               <h6> Highest Visitor From</h6>
            </div>
            <div class="card-body">
                <div class="row mb-1">
                    <div class="col-6 ">
                       <b> City</b>
                    </div>
                    <div class="col-6">
                       <b> Visitor Count</b>
                    </div>
                </div>
                @foreach($citywiseusers as $cu)
                <hr/>
                    <div class="row">
                        <div class="col-6">
                             {{$cu['city']}}
                        </div>
                        <div class="col-6 text-center">
                            {{$cu['activeUsers']}}
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>
    <div  class="col-lg-4 col-sm-12">
        <div class="card">
            <div class="card-header pb-0">
               <h6> Device  Trafic</h6>
            </div>
            <div class="card-body pt-1">
                
                @foreach($devicewise->groupBy('deviceCategory') as $k=>$d)
                <hr>
                <div class="row mt-2">
                    <div class="row mb-2">
                        <div class="col-8"><i class="fa fa-dot-circle-o text-{{$colors[array_rand($colors)]}}"></i> <b>{{$k}}</b></div>
                        <div class="col-4"><b>{{number_format((array_sum(array_column($d->toArray(),'activeUsers'))*100)/(array_sum($devicewise->pluck('activeUsers')->toArray())),2)}} % </b></div>
                    </div>
                    <div class="row ms-4">
                        @foreach($d as $dt)
                        <div class="col-8">{{$dt['operatingSystem']}}</div>
                        <div class="col-4">{{number_format(($dt['activeUsers']*100)/$d->sum('activeUsers'),2)}} %</div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-area')
<script src="../assets/js/chart/apex-chart/apex-chart.js"></script>
<script src="../assets/js/tooltip-init.js"></script>


{{-- chartinitialize --}}
<script>
     var options1 = {
    chart: {
      height: 350,
      type: "area",
      toolbar: {
        show: false,
      },
    },
    dataLabels: {
      enabled: false,
    },
    stroke: {
      curve: "smooth",
    },
    series: [
      {
        name: "Visitor Count",
        data: {!! json_encode($datewise->pluck('activeUsers')->toArray()) !!},
      },
      // {
      //   name: "series2",
      //   data: [11, 32, 45, 32, 34, 52, 41],
      // },
    ],
    xaxis: {
      type: "datetime",
      categories: {!! json_encode($datewise->pluck('date')->toArray()) !!},
    },
    tooltip: {
      x: {
        format: "dd/MM/yy",
      },
    },
    colors: [TivoAdminConfig.secondary],
  };
  var chart1 = new ApexCharts(
    document.querySelector("#area-spaline2"),
    options1
  );
  chart1.render();
</script>
@endsection