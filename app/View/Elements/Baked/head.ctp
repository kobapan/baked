<?php
$blockHeadList = Set::extract('{.+?}.head', Configure::read('Blocks'));
$this->Baked->setElements($blockHeadList);

$blockJsList = Set::extract('{.+?}.js', Configure::read('Blocks'));
$this->Baked->setElements($blockJsList);



