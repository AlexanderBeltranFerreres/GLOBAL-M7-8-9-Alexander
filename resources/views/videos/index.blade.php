<x-layout>
    <div class="container">
        <div class="row">
            @foreach ($videos as $video)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card border-0 shadow-renaissance rounded" onclick="window.location='{{ route('videos.show', $video->id) }}'">
                        <!-- Miniatura com a imatge destacada -->
                        <iframe class="card-img-top" width="560" height="315" src="{{ $video->url }}?autoplay=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen style="pointer-events: none;"></iframe>

                        <!-- Títol i descripció -->
                        <div class="card-body p-3">
                            <h5 class="card-title text-truncate" style="font-size: 16px; font-weight: 600; color: #3b3b3b;">{{ $video->title }}</h5>
                            <p class="card-text text-truncate" style="font-size: 13px; color: #737373;">{{ \Str::limit($video->description, 60) }}</p>
                            <a href="{{ route('videos.show', $video->id) }}" class="btn btn-outline-renaissance btn-sm">Veure Detall</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Estils CSS -->
    <style>
        .container {
            padding: 60px;
            background-color: #f2f2f2;
        }

        .card-img-top {
            height: 180px;
            object-fit: cover;
            border-radius: 7px;
            cursor: pointer;
        }

        .card {
            border: none;
            display: flex;
            flex-direction: column;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: linear-gradient(145deg, #ffffff, #f7f7f7);
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: #3b3b3b;
            margin-bottom: 8px;
        }

        .card-text {
            font-size: 13px;
            color: #737373;
        }

        .btn-outline-renaissance {
            border-color: #8c4a7d;
            color: #8c4a7d;
            font-size: 13px;
            text-transform: uppercase;
            border-radius: 20px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-outline-renaissance:hover {
            background-color: #8c4a7d;
            color: #fff;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        /* Estil responsiu */
        @media (max-width: 1200px) {
            .col-lg-3 {
                flex: 1 1 48%;
            }
        }

        @media (max-width: 992px) {
            .col-md-4 {
                flex: 1 1 48%;
            }
        }

        @media (max-width: 768px) {
            .col-sm-6 {
                flex: 1 1 48%;
            }
        }

        @media (max-width: 576px) {
            .col-sm-6 {
                flex: 1 1 100%;
            }

            .card-img-top {
                height: 150px;
            }

            .card-title {
                font-size: 15px;
            }

            .card-text {
                font-size: 12px;
            }
        }
    </style>
</x-layout>
