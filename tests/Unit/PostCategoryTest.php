<?php

namespace Tests\Unit;

use App\Models\Post;
use PHPUnit\Framework\TestCase;

class PostCategoryTest extends TestCase
{
    public function test_it_reads_legacy_json_strings_as_category_arrays(): void
    {
        $post = new Post;
        $post->setRawAttributes(['category' => '"Titan, Trading, Laravel"']);

        $this->assertSame(['Titan', 'Trading', 'Laravel'], $post->category);
    }

    public function test_it_reads_and_writes_json_category_arrays(): void
    {
        $post = new Post;
        $post->category = [' Laravel ', 'Security', 'Laravel'];

        $this->assertSame('["Laravel","Security"]', $post->getAttributes()['category']);
        $this->assertSame(['Laravel', 'Security'], $post->category);
    }
}
