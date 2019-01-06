<?php
/**
 * Created by PhpStorm.
 * User: Anatol
 * Date: 30.12.2018
 * Time: 11:53
 */
?>
<!doctype html>
<html prefix="og: http://ogp.me/ns#">
<head>
<script>window.jQuery || document.write('<script src="/js/jquery-3.3.1.min.js"><\/script>')</script>
<meta charset="utf-8">
<meta name="x-ua-compatible" content="IE=edge,chrome=1" http_equiv="X-UA-Compatible">
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta name="msapplication-tap-highlight" content="no">
<meta name="author" content="Yukai">
<link rel="icon" href="/i/favicon.ico">
<title>insert dress</title>
<!-- Bootstrap core CSS -->
<link href="/css/bootstrap.min.css" rel="stylesheet">
<link href="/css/blog.css" rel="stylesheet">
<link href="/css/contact.css" rel="stylesheet">
<link href="/css/fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>


<div class="container-fluid">
    <div class="row"><div class="col-12 pt-2 text-center"><h4>Insert new dress</h4></div></div>
    <div class="row">
        <div class="col-12">
            select collection name: ld_collection
<!--    sync the collection names in the DB and the filesystem!  -->
<!--    create new collection -->
<!--    it's new dress so let's create the new directory automatically? -->
            <pre>
fields:
<!--            `id`,-->
<!--            `article_num`,-->
<!--            `url_name`, read-only: takes from the 'title' -->
            `title`,             the name of Dress input type text TEXT
            `short_descr`,       short dress description
            `product_details`,   product details. materials, shipping nuances ... etc TEXTAREA
            `price`,             the price. small text
            `offer_price`,
            `discount_price`,
            `price_offer_end_date`,
<!--            `order_count`,-->
<!--            `like_count`,-->
<!--            `view_count`,-->
            `care_advice`,       TEXT about how to dry
<!--            `add_date`,-->
            `is_available`,      select: YES|NO
            `is_active`,         select: YES|NO
             --- ld_descriptions ---
                `dress_id`,`description`,`lang_id`
                description_pl   the Dress description THREE times
                description_en
                description_ru
             --- dress_images ---
                insert images....
                id, path, name, width, height, is_active, dress_id
            </pre>
        </div>
    </div>
    <div class="row">
        <div class="col-12 pt-1 pl-5">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Email</label>
                        <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Password</label>
                        <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress">Address</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="form-group">
                    <label for="inputAddress2">Address 2</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">City</label>
                        <input type="text" class="form-control" id="inputCity">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">State</label>
                        <select id="inputState" class="form-control">
                            <option selected>Choose...</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputZip">Zip</label>
                        <input type="text" class="form-control" id="inputZip">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Check me out
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
        </div>
    </div>

</div>

<!-- Footer -->
<footer class="bg-black small text-center text-white-50">
    <div class="container main-fnt">
        Copyright &copy; Yukai <span class="header_date"><?php echo date("Y") ?></span>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="/js/popper.min.js"></script>
<!-- Plugin JavaScript -->
<script src="/js/jquery-3.3.1.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>

<?php
/*
 * -- 1.
INSERT INTO `ld_dresses` (`id`,`article_num`,`url_name`,`title`,`short_descr`,`product_details`,`price`,
`offer_price`,`discount_price`,`price_offer_end_date`,`order_count`,`like_count`,`view_count`,`care_advice`,
`add_date`,`is_available`,`is_active`) VALUES
  (1,'VW351178', 'Aurora','Aurora','Aurora w mitologii rzymskiej bogini zorzy porannej, brzasku i świtu (poranku)',
    '',4050,0,0,0,0,0,0,'Delicate dry clean only',UNIX_TIMESTAMP(),1,1 );
-- now insert the data into all of related tables, using this dress_id
-- descriptions dress_images size(size_map) collection(collection_map) color(color_map) currency(currency_map)
-- descriptions
INSERT INTO `ld_descriptions` (`id`,`dress_id`,`description`,`lang_id`) values
  (null ,1,'Fantastyczna suknia evasé wykonana z białej krepy i kamieni w kolorze złota, tworzących kwiatowe motywy.
    Fason inspirowany Grecją, łączący w sobie spódnicę z niską talią z bardzo twarzowym dekoltem w łódkę oraz niewiarygodnymi, drapowanymi plecami z detalami z kamieni przy krągłościach i ramionach.
    Długie rękawy są również zdobione połyskującymi elementami w kolorze złota przy nadgarstkach, podkreślając styl Olimpu.',1);
-- dress_images
INSERT INTO `ld_dress_images` (id, path, name, width, height, is_active, dress_id) VALUES
  (null ,'/i/dress/2018/001','_R7A1012.jpg',600,900,1,1),
  (null ,'/i/dress/2018/001','_R7A1024.jpg',600,900,1,1),
  (null ,'/i/dress/2018/001','_R7A1045.jpg',600,900,1,1);
-- dress inserting DONE --
 */