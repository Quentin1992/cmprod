<?php
$title = "Contact - Chaud Mirette Productions";
$page = "contact";
 ?>

<header>
    <img src="public/images/frontend/contact/contact-light.png">
    <div>
        <h1>Contact</h1>
        <p>Un devis, une question, une demande, une suggestion, un compliment ?</p>
        <p>N'hésitez pas à nous contacter, nous sommes là pour répondre à toutes vos envies.</p>
    </div>
</header>
<section>
    <div>
        <form id="contactForm" action="#">
            <div>
                <label for"name">Nom</label>
                <input type="text" name="name" required>
                <label for"phoneNumber">Téléphone</label>
                <input type="tel" name="phoneNumber" required>
                <label for"email">Email</label>
                <input type="email" name="email" required>
                <label for"message">Message</label>
                <textarea name="message" rows="6" required></textarea>
            </div>
            <div>
                <input type="checkbox" name="consent" value="consent" required>
                <label for="consent">J'accepte que Chaud Mirette Productions utilise mon adresse e-mail ou mon numéro de téléphone dans le cadre de notre échange commercial.</label>
            </div>
            <input type="submit" value="Envoyer">
        </form>
    </div>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d40492.554843914535!2d3.01214101205739!3d50.631116696164966!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c2d579b3256e11%3A0x40af13e81646360!2sLille!5e0!3m2!1sfr!2sfr!4v1559658134163!5m2!1sfr!2sfr" frameborder="0" style="border:0" allowfullscreen></iframe>
</section>
