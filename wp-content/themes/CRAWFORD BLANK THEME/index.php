<?php get_header(); ?>
<?php // GET QUERIES TO PULL IN OTHER PAGES ?>

<main role="main" class="row gutters">
		<article class="col span_12">
				<?php $the_query = new WP_Query( $args ); ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; // end of the loop. ?>
				<?php wp_reset_postdata(); ?>
		</article>
		<aside role="complimentary" class="col span_4"> 
			Sidebar 
		</aside>
		
<h1>SAMPLE TYPOGRAPHY</h1>

<h2>Typewriter delectus cred</h2>

<p>Bushwick Schlitz. Est Shoreditch small batch, dolor Schlitz sapiente twee stumptown ex. Duis Carles pickled, cornhole Thundercats McSweeney's minim PBR vegan Tumblr irony. Kogi eu Thundercats, sed scenester before they sold out et aesthetic. Elit cred Vice ethical pickled sartorial. Stumptown roof party freegan High Life vero, ea sed minim meggings.</p>

<h3>Truffaut disrupt sartorial deserunt</h3>

<p>Cosby sweater plaid shabby chic kitsch pour-over ex. Try-hard fanny pack mumblecore cornhole cray scenester. Assumenda narwhal occupy, Blue Bottle nihil culpa fingerstache. Meggings kogi vinyl meh, food truck banh mi Etsy magna 90's duis typewriter banjo organic leggings Vice.</p>

<h4>Fingerstache nesciunt lomo nostrud hoodie</h4>

<ul>
<li>Roof party put a bird on it incididunt sed umami craft beer cred.</li>
<li>Carles literally normcore, Williamsburg Echo Park fingerstache photo booth twee keffiyeh chambray whatever.</li>
<li>Scenester High Life Banksy, proident master cleanse tousled squid sriracha ad chillwave post-ironic retro.</li>
</ul>

<p>Laboris selfies occaecat umami, forage Tumblr American Apparel. Retro Terry Richardson culpa id swag polaroid Intelligentsia American Apparel eu, esse non post-ironic fugiat master cleanse. Direct trade gluten-free blog, fanny pack cray labore skateboard before they sold out adipisicing non magna id Helvetica freegan. Disrupt aliqua Brooklyn church-key lo-fi dreamcatcher.</p>

<form class="contact_form" action="#" method="post" name="contact_form">
    <ul>
        <li>
             <h2>Contact Us</h2>
             <span class="required_notification">* Denotes Required Field</span>
        </li>
        <li>
            <label for="name">Name:</label>
            <input type="text"  placeholder="John Doe" required />
        </li>
        <li>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="john_doe@example.com" required />
            <span class="form_hint">Proper format "name@something.com"</span>
        </li>
        <li>
            <label for="website">Website:</label>
            <input type="url" name="website" placeholder="http://johndoe.com" required pattern="(http|https)://.+"/>
            <span class="form_hint">Proper format "http://someaddress.com"</span>
        </li>
        <li>
            <label for="message">Message:</label>
            <textarea name="message" cols="40" rows="6" required ></textarea>
        </li>
        <li>
        	<button class="submit" type="submit">Submit Form</button>
        </li>
    </ul>
</form>
</body>
</main>
<?php get_footer(); ?>
