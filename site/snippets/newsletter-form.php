<form id="newsletter-registration" action="<?= $page->url() ?>" method="post">

  <div class="form-element">
    <label for="firstname">Vorname:</label>
    <input type="text" id="firstname" name="firstname" placeholder="" value="<?= isset($data['firstname']) ? esc($data['firstname']) : '' ?>" required/>
  </div>

  <div class="form-element">
    <label for="lastname">Nachname:</label>
    <input type="text" id="lastname" name="lastname" placeholder="" value="<?= isset($data['lastname']) ? esc($data['lastname']) : '' ?>" required/>
  </div>

  <div class="form-element">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" placeholder="mail@example.com" value="<?= isset($data['email']) ? esc($data['email']) : '' ?>" required/>
  </div>

  <div class="honey" style="position: absolute; left: -9999px;">
     <label for="message">If you are a human, leave this field empty</label>
     <input type="website" name="website" id="website" placeholder="http://example.com" value="<?= isset($data['website']) ? esc($data['website']) : '' ?>"/>
  </div>

  <button class="button" type="submit" name="register" value="Register">Anmelden</button>

</form>