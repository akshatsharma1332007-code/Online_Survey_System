<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    #carouselExampleCaptions {
        width: 70%;
        max-width: 950px;
        height: 450px;
        margin: 60px auto;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 20px 45px rgba(0, 0, 0, .25);
    }

    #carouselExampleCaptions img {
        width: 100%;
        height: 450px;
        object-fit: cover;
    }

    #carouselExampleCaptions {
        width: 70%;
        max-width: 950px;
        height: 450px;
        margin: 60px auto;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: 0 20px 45px rgba(0, 0, 0, .25);
    }

    #carouselExampleCaptions img {
        width: 100%;
        height: 650px;
        object-fit: cover;
    }

    .hero {
        margin-bottom: 60px;
    }
</style>

<body>

    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/images/slide1.jpg" class="d-block w-100" alt="photu1">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item">
                <img src="/images/slide2.jpg" class="d-block w-100" alt="photu2">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
            <div class="carousel-item">
                <img src="/images/slide3.jpg" class="d-block w-100" alt="Aadi">
                <div class="carousel-caption d-none d-md-block">
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <footer class="bg-dark text-center text-white p-3 mt-5">
        © 2026 Online Survey System
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>