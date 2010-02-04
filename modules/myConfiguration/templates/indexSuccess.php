<div id="sf_admin_container">
  <h1>Configuration de l'application</h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice') ?></div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error') ?></div>
<?php endif; ?>


  <div id="sf_admin_header"></div>

  <div id="sf_admin_content">
    
    <div class="sf_admin_form">
      <form enctype="multipart/form-data" action="" method="post">
        <?php echo $form->renderHiddenFields()?>
        <?php echo $form->renderGlobalErrors()?>
        <?php foreach($fields as $space => $fs):?>
          <fieldset id="sf_fieldset_<?php echo $space?>">
            <h2><?php echo sfInflector::humanize($space)?></h2>
            <?php foreach($fs as $field => $options):?>
              <div class="sf_admin_form_row sf_admin_text sf_admin_form_field_author">
                <?php echo $form[$space][$field]->renderError()?>
                <div>
                  <?php echo $form[$space][$field]->renderLabel()?>
                  <div class="content">
                    <?php echo $form[$space][$field]->render()?>
                  </div>
                </div>
              </div>
            <?php endforeach?>
          </fieldset>
        <?php endforeach?>
      
        <ul class="sf_admin_actions">
          <li class="sf_admin_action_save"><input type="submit" value="Save"></li>
        </ul>
      </form>
    </div>
  </div>

  <div id="sf_admin_footer"></div>
</div>