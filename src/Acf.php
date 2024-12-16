<?php

declare(strict_types=1);

namespace Yard\Acf;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Arr;
use Webmozart\Assert\Assert;

class Acf
{
	/**
	 * Create a new Acf instance.
	 */
	public function __construct(protected Application $app)
	{
	}

	/**
	 * Retrieve a random inspirational quote.
	 */
	public function getQuote(): string
	{
		$quotes = config('acf-registrar.quotes');

		Assert::isArray($quotes);

		$quote = Arr::random(
			$quotes
		);

		Assert::string($quote);

		return $quote;
	}

	/**
	 * Retrieve a post content.
	 */
	public function getPostContent(int $postId): string
	{
		$post = \get_post($postId);

		return  $post ? $post->post_content : 'Post not found';
	}
}
