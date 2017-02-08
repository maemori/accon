<?php

use Model\Slug;

/**
 * Class Controller_Blog_slug
 */
class Controller_Blog_Slug extends \Accon\Foundation\Controller_Physical_Crud
{
	// サービスの説明
	const SERVICE_TITLE = 'Slug';
	// モデルクラス
	const MODEL = Slug::class;

}
