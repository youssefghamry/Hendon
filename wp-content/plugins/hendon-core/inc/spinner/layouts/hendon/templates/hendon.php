<?php
    $qodef_spinner_text = hendon_core_get_post_value_through_levels( 'qodef_spinner_text', qode_framework_get_page_id() );
?>

<div class="qodef-m-hendon">
    <span class="qodef-m-hendon-text">
    <?php 
    $strArray = str_split($qodef_spinner_text);
    foreach($strArray as $item):
        echo '<span>'.$item.'</span>';
    endforeach;
    ?>
    </span>
</div>