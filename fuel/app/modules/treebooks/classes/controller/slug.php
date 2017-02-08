<?php

namespace Treebooks;

use \Accon\Foundation\Controller_Physical_Crud;
use Treebooks\Model\Slug;

/**
 * Class Controller_Blog_slug
 */
class Controller_Slug extends Controller_Physical_Crud
{
	// サービスの説明
	const SERVICE_TITLE = 'Books Slug';
	// モデルクラス
	const MODEL = Slug::class;

}
