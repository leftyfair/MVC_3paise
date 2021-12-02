<?php

use app\core\form\Form;

?>

<h1>Register</h1>
<?php $form = Form::begin('/register', 'post') ?>
<table>
    <?php
    echo $form->field($model, 'firstname', 'First Name');
    echo $form->field($model, 'lastname', 'Last Name');
    echo $form->field($model, 'email', 'E-Mail')->emailField();
    echo $form->field($model, 'password', 'Password')->passwordField();
    echo $form->field($model, 'confirmPassword', 'Confirm Password')->passwordField();
    ?>
</table>
<button>Submit</button>
<?php $form->end(); ?>