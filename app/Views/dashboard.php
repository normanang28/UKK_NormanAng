<div class="row" data-aos="fade" data-aos-delay="100">
    <div class="col-xl-4 col-xxl-4 col-lg-7 col-md-7 col-sm-7">
        <div class="widget-stat card">
            <div class="card-body p-4">
                <div class="media ai-icon d-flex">  
                    <span class="me-3 bgl-primary text-primary">
                        <i class="fa-solid fa-business-time"></i>
                    </span>
                    <div class="media-body">
                        <h4 class="mb-0 text-black"><span class="ms-0">
                            <?=  count($barang) ?> Barang
                        </span></h4>
                        <p class="mb-0">Total Barang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-xxl-4 col-lg-7 col-md-7 col-sm-7">
        <div class="widget-stat card">
            <div class="card-body p-4">
                <div class="media ai-icon d-flex">
                    <span class="me-3 bgl-primary text-primary">
                        <i class="fa-solid fa-truck-fast"></i>
                    </span>
                    <div class="media-body">
                        <h4 class="mb-0 text-black"><span class=" ms-0">
                            <?=  count($pendataan_barang) ?> Barang
                        </span></h4>
                        <p class="mb-0">Total Barang Tersedia</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-xxl-4 col-lg-7 col-md-7 col-sm-7">
        <div class="widget-stat card">
            <div class="card-body p-4">
                <div class="media ai-icon d-flex">
                    <span class="me-3 bgl-primary text-primary">
                        <i class="fa-solid fa-sack-dollar"></i>
                    </span>
                    <div class="media-body">
                        <h4 class="mb-0 text-black"><span class=" ms-0">
                            <?=  count($kasir) ?> Barang
                        </span></h4>
                        <p class="mb-0">Total Barang Terjual</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .widget-stat.card {
            border: 1px solid #f1f1f1;
            transition: box-shadow 0.3s, transform 0.3s; 
            border-radius: 20px;
            overflow: hidden;
        }

        .widget-stat.card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            transform: scale(1.05); 
        }

        .widget-stat.card .card-body {
            padding: 16px;
            transition: background-color 0.3s; 
        }

        .widget-stat.card .media-body h4 {
            overflow: hidden;
            text-overflow: ellipsis; 
            white-space: nowrap; 
            max-height: 60px; 
            margin-bottom: 8px; 
            font-size: 1.2rem;
            transition: font-size 0.3s; 
        }

        .widget-stat.card .media-body {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .widget-stat.card:hover .media-body h4 {
            font-size: 1.5rem; 
        }

        @media (max-width: 767px) {
            .widget-stat.card:hover {
                transform: none; 
            }
        }
    </style>

    <style>
      .styled-iframe {
          border-radius: 10px;
          overflow: hidden;
          box-shadow: 0 0 16px rgba(0, 0, 0, 0.1);
          width: 100%; 
          height: 400px;
          transition: box-shadow 0.3s ease-in-out; 
          border: none; 
      }

      .styled-iframe:hover {
          box-shadow: 0 0 24px rgba(0, 0, 0, 0.2); 
      }

      @media (max-width: 768px) {
          .styled-iframe {
            height: 300px;
        }
    }
    </style>
