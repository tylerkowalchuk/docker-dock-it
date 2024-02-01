<?php
$pageTitle = "Perfu.ME - HOME";

include "includes/header.php"; ?>
<div class="container-fluid d-flex justify-content-center">
    <div class="container-fluid" id="topImage">

</div>

</div>
<h1 class="h1 display-6 d-flex justify-content-center">Find your perfect scent</h1>
<div class="container-md">
    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5 d-flex justify-content-center">
        <div class="col">
            <a href="perfumery.php"><div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('images/perfumery-img.png');">
                <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                    <h2 id="cardTitle1" class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold text-decoration-none">Visit the Perfumery</h2>
                </div>
            </div>
        </div></a>
        <div class="col">
            <a href="perfumery.php"><div class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" style="background-image: url('images/customers_img.png');">
                    <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1">
                        <h2 id="cardTitle2" class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold text-decoration-none">Customers</h2>
                    </div>
                </div>
        </div></a>
    </div>
</div>

<h2 class="h2 text-light d-flex justify-content-center">What builds your favorite scent?</h2>
<div class="container-sm">
<div class="card-group">
    <div class="card">
        <img src="images/topNotes.png" class="card-img-top" alt="orange growing on tree">
        <div class="card-body">
            <h5 class="card-title">Top Notes</h5>
            <p class="card-text">Top notes represent the first impression. They may not be the
                longest-lasting element of a fragrance but they’re the first thing you’ll smell
                when trying a new fragrance. Top notes represent the initial scents that lure you
                in, causing you to make your first impression of the fragrance.
                Typical top notes include citrus elements (bergamot, lemon, orange zest),
                light fruits (anise, berries, grapefruit) and fresh herbs (basil, sage, lavender).</p>
        </div>
        <div class="card-footer">
            <small class="text-muted"></small>
        </div>
    </div>
    <div class="card">
        <img src="images/middleNotes.png" class="card-img-top" alt="pink flowers">
        <div class="card-body">
            <h5 class="card-title">Middle Notes</h5>
            <p class="card-text">The heart notes start to make an appearance just before the
                top notes fade away and will strongly influence the base notes to come.
                Heart notes aren’t to be taken lightly! The heart of a fragrance
                should be pleasant and well-rounded. Because of this, scents such as
                cinnamon, rose, ylang ylang, lemongrass and neroli are all common and
                recognisable heart notes.</p>
        </div>
        <div class="card-footer">
            <small class="text-muted"></small>
        </div>
    </div>
    <div class="card">
        <img src="images/baseNotes.png" class="card-img-top" alt="wood with greenery">
        <div class="card-body">
            <h5 class="card-title">Base Notes</h5>
            <p class="card-text">Where the top notes make the initial impression, the base notes are
                associated with the dry-down period of the fragrance and so, base notes will create
                the final, lasting impression. Base notes are often rich and smooth, as well as
                being the longest lasting of the three notes. Common base notes include cedarwood,
                sandalwood, vanilla, patchouli and musk.</p>
        </div>
        <div class="card-footer">
            <small class="text-muted"></small>
        </div>
    </div>

</div>
</div>


    <!--footer include ---->

<?php
include "includes/footer.php" ?>