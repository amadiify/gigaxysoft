<!-- autoload scripts into shrinke.js through shrinke.map.json-->
<script type="text/deffered" data-src="<?= url($assets->js('moorexa.js')) ?>" async></script>
<!-- deffer script --><script type="text/javascript" src="<?= url($assets->js('deffer.min.js')) ?>" data-moorexa-appurl="<?= url() ?>" async></script>
<?=\Moorexa\Rexa::runDirective(true,'preparejsbin')?></body></html>

