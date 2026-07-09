<?php

use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;

beforeEach(function () {
    $this->adminRole = Role::create(['name' => 'Admin']);
    $this->adminUser = User::factory()->create([
        'role_id' => $this->adminRole->id,
    ]);
});

test('admin can see low stock warning and export buttons', function () {
    $category = Category::create(['name' => 'Office Equipment']);

    $product = Product::create([
        'category_id' => $category->id,
        'code' => 'PRD-001',
        'name' => 'Projector',
        'stock' => 3,
        'location' => 'Warehouse',
        'condition' => 'Good',
    ]);

    $borrowing = Borrowing::create([
        'user_id' => $this->adminUser->id,
        'borrow_date' => now()->subDay(),
        'return_date' => null,
        'status' => 'Borrowed',
    ]);

    BorrowingDetail::create([
        'borrowing_id' => $borrowing->id,
        'product_id' => $product->id,
        'quantity' => 1,
    ]);

    $response = $this->actingAs($this->adminUser)
        ->get(route('dashboard'));

    $response->assertStatus(200);
    $response->assertSee('Low stock alert');
    $response->assertSee('Review products');

    $response = $this->actingAs($this->adminUser)
        ->get(route('products.index'));

    $response->assertStatus(200);
    $response->assertSee('Export PDF');
    $response->assertSee('Export Excel');
    $response->assertSee('Low stock');
});

test('admin can download export files', function () {
    $this->actingAs($this->adminUser)
        ->get(route('products.export.pdf'))
        ->assertStatus(200)
        ->assertHeaderContains('content-disposition', 'products.pdf');

    $this->actingAs($this->adminUser)
        ->get(route('products.export.excel'))
        ->assertStatus(200)
        ->assertHeaderContains('content-disposition', 'products.xlsx');

    $this->actingAs($this->adminUser)
        ->get(route('categories.export.pdf'))
        ->assertStatus(200)
        ->assertHeaderContains('content-disposition', 'categories.pdf');

    $this->actingAs($this->adminUser)
        ->get(route('borrowings.export.pdf'))
        ->assertStatus(200)
        ->assertHeaderContains('content-disposition', 'borrowings.pdf');
});
