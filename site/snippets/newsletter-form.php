<form id="newsletter-registration" action="<?= $page->url() ?>" method="post">

  <div class="row form-row">

    <div class="form-element col-xxs-12 col-xs-6">
      <div class="row">
        <label for="firstname" class="">Vorname</label>
      </div>
      <div class="row">
        <input type="text" id="firstname" name="firstname" placeholder="" value="<?= isset($data['firstname']) ? esc($data['firstname']) : '' ?>" class="col-xs-12 col-sm-12 <?= isset($alert) && array_key_exists('firstname', $alert) ? 'error' : '' ?>" required/>
      </div>
    </div>

    <div class="form-element col-xxs-12 col-xs-6 second-element">
      <div class="row">
        <label for="lastname" class="">Nachname</label>
      </div>
      <div class="row">
        <input type="text" id="lastname" name="lastname" placeholder="" value="<?= isset($data['lastname']) ? esc($data['lastname']) : '' ?>" class="col-xs-12 col-sm-12 <?= isset($alert) && array_key_exists('lastname', $alert) ? 'error' : '' ?>" required/>
      </div>
    </div>

  </div>

  <div class="row form-row">
    <div class="form-element col-xs-12 col-sm-12">
      <div class="row">
        <label for="email" class="">Email Adresse</label>
        <input type="email" name="email" id="email" placeholder="mail@example.com" value="<?= isset($data['email']) ? esc($data['email']) : '' ?>" class="col-xs-12 col-sm-12 <?= isset($alert) && array_key_exists('email', $alert) ? 'error' : '' ?>" required/>
      </div>
    </div>
  </div>

  <div class="honey" style="position: absolute; left: -9999px;">
     <label for="message">If you are a human, leave this field empty</label>
     <input type="website" name="website" id="website" placeholder="http://example.com" value="<?= isset($data['website']) ? esc($data['website']) : '' ?>"/>
  </div>

  <div class="row form-row button">
    <div class="form-element col-xs-12 col-sm-12">
      <div class="row">
        <button class="button" type="submit" name="register" value="Register">Jetzt anmelden</button>
      </div>
    </div>
  </div>

</form>