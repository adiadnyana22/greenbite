@extends('adminComponent.default')

@section('title', 'GreenBite Verifikasi Pendaftaran Mitra')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Verifikasi Pendaftaran Mitra</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Verifikasi Pendaftaran Mitra</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div id="map" class="w-100" style="height: 450px"></div>
                    <div class="mt-2">{{ $mitra->address }}</div>
                </div>
                <div class="col-12 flex mb-4 mt-4 d-flex align-items-center">
                    <img src="{{ asset('assets/user/images/merchant/'.$mitra->logo) }}" alt="Mitra" style="height: 75px; width: 75px; object-fit: contain; border-radius: 50%; border: 1px solid #ddd; padding:.5rem;">
                    <h1 class="mt-2 text-dark ml-4">{{ $mitra->name }}</h1>
                </div>
                @if ($mitra->status == 0)
                <div class="col-12 d-flex">
                    <form action="{{ route('adminMitraVerif', $mitra->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="status" id="status" value="1">
                        <button class="btn btn-success mr-3 mt-2">Approve</button>
                    </form>
                    <form action="{{ route('adminMitraVerif', $mitra->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="status" id="status" value="9">
                        <button class="btn btn-danger mr-3 mt-2">Decline</button>
                    </form>
                </div>
                @endif
                @if ($mitra->status == 1)
                <div class="bg-primary py-2 w-100 h2 text-center text-white mb-2">
                    MITRA VERIFIED
                </div>    
                @endif
                @if ($mitra->status == 9)
                <div class="bg-danger py-2 w-100 h2 text-center text-white mb-2">
                    MITRA DECLINED
                </div>    
                @endif
            </div>
            <a href="{{ route('adminMitra') }}" class="btn btn-info float-right mr-3 mt-2">Kembali</a>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
            key: "AIzaSyBFCavjPZcDlfq93MQMbnzlu_a4Q5pnXi0",
            v: "weekly",
            // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
            // Add other bootstrap parameters as needed, using camel case.
        });
    </script>
    <script>
        let map;

        async function initMap() {
            const { Map } = await google.maps.importLibrary("maps");
            const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");

            map = new Map(document.getElementById("map"), {
                center: { lat: -34.397, lng: 150.644 },
                zoom: 10,
                disableDefaultUI: true,
                mapId: "DEMO_MAP_ID",
            });

            const marker = new AdvancedMarkerElement({
                map: map,
                position: {
                    lat: {{ $mitra->latitude }},
                    lng: {{ $mitra->longitude }},
                },
                title: '{{ $mitra->name }}'
            });
            map.setCenter({
                lat: {{ $mitra->latitude }},
                lng: {{ $mitra->longitude }},
            });
            map.setZoom(15);
        }

        initMap();
    </script>
@endsection
