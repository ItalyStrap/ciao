<?php
declare(strict_types=1);

namespace ItalyStrap\Ciao;

use ItalyStrap\Config\ConfigInterface;

/** @var ConfigInterface $config */
$config = $this;
?>
<!-- wp:paragraph -->
<p><?php echo $config->get( 'content' ) ?></p>
<!-- /wp:paragraph -->
