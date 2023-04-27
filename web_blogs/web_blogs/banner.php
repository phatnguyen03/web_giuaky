<section id="hero" class="s-hero">

    <div class="s-hero__slider">
        <?php 
            $stmt=$blog->read_homeplace();
            while($row=$stmt->fetch()){
        ?>
        
        <div class="s-hero__slide">    
            <div class="s-hero__slide-bg" style="<?php echo "background-image: url('uploads/main/".$row['blog_main_image']."'); background-size: contain, cover;"; ?>"></div>

            <div class="row s-hero__slide-content animate-this">
                <div class="column">
                    <!-- <div class="s-hero__slide-meta">
                        <span class="cat-links">
                            <a href="#0">Lifestyle</a>
                            <a href="#0">Design</a>
                        </span>
                        <span class="byline"> 
                            Posted by 
                            <span class="author">
                                <a href="#0">Jonathan Doe</a>
                            </span>
                        </span>
                    </div> -->
                    <h1 class="s-hero__slide-text">
                        <a href="#0">
                            <?php echo $row['blog_summary']; ?>
                        </a>
                    </h1>
                </div>
            </div>

        </div> <!-- end s-hero__slide -->

        <?php } ?>


    </div> <!-- end s-hero__slider -->

    <div class="s-hero__social hide-on-mobile-small">
        <p>Follow</p>
        <span></span>
        <ul class="s-hero__social-icons">
            <li><a href="#0"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
            <li><a href="#0"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="#0"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
            <li><a href="#0"><i class="fab fa-dribbble" aria-hidden="true"></i></a></li>
        </ul>
    </div> <!-- end s-hero__social -->

    <div class="nav-arrows s-hero__nav-arrows">
        <button class="s-hero__arrow-prev">
            <svg viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" width="15" height="15"><path d="M1.5 7.5l4-4m-4 4l4 4m-4-4H14" stroke="currentColor"></path></svg>
        </button>
        <button class="s-hero__arrow-next">
           <svg viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg" width="15" height="15"><path d="M13.5 7.5l-4-4m4 4l-4 4m4-4H1" stroke="currentColor"></path></svg>
        </button>
    </div> <!-- end s-hero__arrows -->

</section>