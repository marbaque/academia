<?php

/**
 * Template part for displaying custom fields.
 *
 * @link https://www.advancedcustomfields.com/resources/taxonomy/
 *
 * @package academia
 */

?>
<!-- descipción -->
<?php
//$content = get_the_content();
//echo mb_strimwidth($content, 0, 400, '...');
?>

<ul class="recurso_tags">
    <!-- metadatos: autoria -->
    <?php
    $personas = get_field('persona');
    $organizaciones = get_field('organizacion');
    $autoria = get_field('autoria');
    $ejes = get_field('eje_tematico');

    if ($autoria == 'Persona'): ?>


        <?php echo get_the_term_list(
            $post->ID,
            'autor_tag',
            __('<li><span class="fa fa-address-card-o" aria-hidden="true"></span> <strong>Creado por</strong> ', 'academia'),
            ', ',
            '</li>'
        ); ?>


    <?php elseif ($autoria == 'Organización'): ?>


        <?php echo get_the_term_list($post->ID, 'organizacion_tag', __('<li><span class="fa fa-university" aria-hidden="true"></span> <strong>Creado por </strong> ', 'academia'), ', ', '</li>'); ?>


    <?php endif; ?>

    <!-- Ejes temáticos -->
    <?php echo get_the_term_list(
        $post->ID,
        'temas',
        __('<li><span class="fa fa-tag" aria-hidden="true"></span> <strong>Ejes temáticos:</strong> ', 'academia'),
        ', ',
        '</li>'
    ); ?>

    <!-- coberturas -->
    <?php echo get_the_term_list(
        $post->ID,
        'cobertura',
        __('<li><span class="fa fa-map" aria-hidden="true"></span> <strong>Cobertura:</strong> ', 'academia'),
        ', ',
        '</li>'
    ); ?>

    <!-- tipos de recurso -->
    <?php echo get_the_term_list(
        $post->ID,
        'tipo_recurso',
        __('<li><span class="fa fa-file-text" aria-hidden="true"></span> <strong>Tipo de recurso:</strong> ', 'academia'),
        ', ',
        ' (' . get_the_term_list(
            $post->ID,
            'tipo_medio',
            '',
            ', ',
            ''
        ) . ')</li>'
    ); ?>

    <!-- Formato -->


    <!-- Interacciones -->
    <?php echo get_the_term_list(
        $post->ID,
        'interaccion',
        __('<li><span class="fa fa-exchange" aria-hidden="true"></span>
<strong>Modalidad:</strong> ', 'academia'),
        ', ',
        '</li>'
    ); ?>



    <!-- Metadatos fecha 1 -->
    <?php

    $fecha1 = get_field('fecha_crea');

    if ($fecha1): ?>

        <li><span class="fa fa-calendar" aria-hidden="true"></span> <strong>Fecha de creación:</strong> <?php echo $fecha1; ?></li>

    <?php else: ?>
        <li><span class="fa fa-calendar" aria-hidden="true"></span> <strong>Fecha de creación:</strong> N/A</li>

    <?php endif; ?>


    <!-- Metadatos fecha 2 -->
    <?php

    $fecha2 = get_field('fecha_mod');

    if ($fecha2): ?>

        <li><span class="fa fa-calendar-plus-o" aria-hidden="true"></span> <strong>Fecha de modificación:</strong> <?php echo $fecha2; ?></li>

    <?php endif; ?>


    <!-- URL source -->
    <?php
    $link = get_field('basado_en');

    if ($link): ?>
        <li><span class="fa fa-external-link" aria-hidden="true"></span> <strong>Basado en:</strong> <a class="button" href="<?php echo $link; ?>"><?php echo $link; ?></a></li>


    <?php endif; ?>

    <!-- Licencia -->
    <?php
    $licencia = get_field('licencia_select');

    if ($licencia == 'copy'): ?>
        <li>
            <span class="fas fa-copyright" aria-hidden="true"></span>
            <?php echo __('Todos los derechos reservados', 'academia'); ?>
        </li>

    <?php elseif ($licencia == 'cc-by'): ?>

        <li class="cc">

            <p xmlns:cc="http://creativecommons.org/ns#"><?php echo __('Esta obra está bajo licencia', 'academia'); ?> <a href="https://creativecommons.org/licenses/by/4.0/deed.es" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">CC BY 4.0<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1" alt=""></a></p>
        </li>

    <?php elseif ($licencia == 'cc-by-nc'): ?>

        <li class="cc">
            <p xmlns:cc="http://creativecommons.org/ns#"><?php echo __('Esta obra está bajo licencia', 'academia'); ?> <a href="https://creativecommons.org/licenses/by-nc/4.0/deed.es" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">CC BY-NC 4.0<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nc.svg?ref=chooser-v1" alt=""></a></p>
        </li>

    <?php elseif ($licencia == 'cc-by-nc-nd'): ?>

        <li class="cc">
            <p xmlns:cc="http://creativecommons.org/ns#"><?php echo __('Esta obra está bajo licencia', 'academia'); ?> <a href="https://creativecommons.org/licenses/by-nc-nd/4.0/deed.es" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">CC BY-NC-ND 4.0<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nd.svg?ref=chooser-v1" alt=""></a></p>
        </li>

    <?php elseif ($licencia == 'cc-by-nc-sa'): ?>

        <li class="cc">
            <p xmlns:cc="http://creativecommons.org/ns#"><?php echo __('Esta obra está bajo licencia', 'academia'); ?> <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/deed.es" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">CC BY-NC-SA 4.0<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/sa.svg?ref=chooser-v1" alt=""></a></p>
        </li>

    <?php elseif ($licencia == 'cc-by-nd'): ?>

        <li class="cc">
            <p xmlns:cc="http://creativecommons.org/ns#"><?php echo __('Esta obra está bajo licencia', 'academia'); ?> <a href="https://creativecommons.org/licenses/by-nd/4.0/deed.es" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">CC BY-ND 4.0<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/nd.svg?ref=chooser-v1" alt=""></a></p>
        </li>

    <?php elseif ($licencia == 'cc-by-sa'): ?>

        <li class="cc">
            <p xmlns:cc="http://creativecommons.org/ns#"><?php echo __('Esta obra está bajo licencia', 'academia'); ?> <a href="https://creativecommons.org/licenses/by-sa/4.0/deed.es" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">CC BY-SA 4.0<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/by.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/sa.svg?ref=chooser-v1" alt=""></a></p>
        </li>

    <?php elseif ($licencia == 'cc0'): ?>

        <li class="cc">
            <p xmlns:cc="http://creativecommons.org/ns#"><?php echo __('Esta obra está bajo licencia', 'academia'); ?> <a href="https://creativecommons.org/publicdomain/zero/1.0/deed.es" target="_blank" rel="license noopener noreferrer" style="display:inline-block;">CC0 1.0<img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/cc.svg?ref=chooser-v1" alt=""><img style="height:22px!important;margin-left:3px;vertical-align:text-bottom;" src="https://mirrors.creativecommons.org/presskit/icons/zero.svg?ref=chooser-v1" alt=""></a></p>
        </li>

    <?php elseif ($licencia == 'dp'): ?>

        <li class="cc">
        <?php echo __('Esta obra está en el dominio público', 'academia'); ?>
        </li>


    <?php endif; ?>

</ul>