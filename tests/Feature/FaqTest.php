<?php

use App\Models\Landlord\Faq;
use App\Models\Landlord\FaqDetail;

beforeEach(function () {
    $this->userAuthenticated();
});


it('gives back a successful response for the page', function () {
    // $this->withoutExceptionHandling();
    $this->get(route('faq.index'))->assertOk();
});

it('returns correct view', function() {
    // Act & Assert
    $this->get(route('faq.index'))
        ->assertOk()
        ->assertViewIs('landlord.super-admin.pages.faqs.index');
});

/*
|--------------------------------------------------------------------------
| Validation During Store
|--------------------------------------------------------------------------
|
*/


test('heading - required | string | min:3 | max: 50', function () {
    // $this->withoutExceptionHandling();
    Faq::factory()->create();

    $this->post(route('faq.store'), array_merge(FaqData(), ['heading' =>'']))
        ->assertInvalid(['heading' => 'required']);

    $this->post(route('faq.store'), array_merge(FaqData(), ['heading' => 12]))
        ->assertSessionHasErrors('heading');

    $this->post(route('faq.store'), array_merge(FaqData(), ['heading' => 'ab']))
        ->assertSessionHasErrors('heading');

    $this->post(route('faq.store'), array_merge(FaqData(), ['heading' => 'fdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfd']))
        ->assertSessionHasErrors('heading');
});

test('sub_heading - required | string ', function () {
    // $this->withoutExceptionHandling();
    Faq::factory()->create();

    $this->post(route('faq.store'), array_merge(FaqData(), ['sub_heading' =>'']))
        ->assertInvalid(['sub_heading' => 'required']);

    $this->post(route('faq.store'), array_merge(FaqData(), ['sub_heading' => 12]))
        ->assertSessionHasErrors('sub_heading');
});

test('question - required | Unique | string | min:3 | max: 50 ', function () {
    // $this->withoutExceptionHandling();
    Faq::factory()->create();
    FaqDetail::factory()->create();

    $this->post(route('faq.store'), array_merge(FaqData(), ['question' =>'']))
        ->assertInvalid(['question' => 'required']);

    $this->post(route('faq.store'), array_merge(FaqData(), ['question' => 'What is PeoplePro SAAS?']))
        ->assertSessionHasErrors('question');

    $this->post(route('faq.store'), array_merge(FaqData(), ['question' => 12]))
        ->assertSessionHasErrors('question');

    $this->post(route('faq.store'), array_merge(FaqData(), ['question' => 'ab']))
    ->assertSessionHasErrors('question');

    $this->post(route('faq.store'), array_merge(FaqData(), ['question' => 'fdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfd fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfd']))
        ->assertSessionHasErrors('question');
});

test('answer - required | Unique | string ', function () {
    // $this->withoutExceptionHandling();
    Faq::factory()->create();
    FaqDetail::factory()->create();

    $this->post(route('faq.store'), array_merge(FaqData(), ['answer' =>'']))
        ->assertInvalid(['answer' => 'required']);

    $this->post(route('faq.store'), array_merge(FaqData(), ['answer' => 'SalePro SAAS is a PHP Laravel Script']))
        ->assertSessionHasErrors('answer');
});

/*
|--------------------------------------------------------------------------
| Store
|--------------------------------------------------------------------------
|
*/

test('Faq & Faq Detail Store', function () {
    $this->withoutExceptionHandling();
    $this->post(route('faq.store'), FaqData());
    $this->assertCount(1, Faq::all());
    $this->assertCount(1, FaqDetail::all());
});


/*
|--------------------------------------------------------------------------
| Validation During Update
|--------------------------------------------------------------------------
|
*/

test('update => question : required | Unique | string | min:3 | max: 200 ', function () {
    // $this->withoutExceptionHandling();
    Faq::factory()->create();
    $faqDetail = FaqDetail::factory()->create();

    $this->post(route('faq.update',$faqDetail->id), array_merge(FaqData_2(), ['question' =>'']))
        ->assertInvalid(['question' => 'required']);

    $this->post(route('faq.update',$faqDetail->id), array_merge(FaqData(), ['question' => 'What is PeoplePro SAAS?']))
        ->assertSessionHasErrors('question');

    $this->post(route('faq.update',$faqDetail->id), array_merge(FaqData(), ['question' => 12]))
        ->assertSessionHasErrors('question');

    $this->post(route('faq.update',$faqDetail->id), array_merge(FaqData(), ['question' => 'ab']))
    ->assertSessionHasErrors('question');

    $this->post(route('faq.update',$faqDetail->id), array_merge(FaqData(), ['question' => 'fdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfdfdsffdffdsfdsfdsfdsfdsfdsfdsfdsfdsfdsfdsffdfytrythghfgdhfghgfhfghfgnhgnnnbv fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfd fgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdfgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgfdgdgfd']))
        ->assertSessionHasErrors('question');
});

test('update - Answer - required | Unique | string ', function () {
    // $this->withoutExceptionHandling();
    Faq::factory()->create();
    $faqDetail = FaqDetail::factory()->create();

    $this->post(route('faq.update',$faqDetail->id), array_merge(FaqData_2(), ['answer' =>'']))
        ->assertInvalid(['answer' => 'required']);

    $this->post(route('faq.update',$faqDetail->id), array_merge(FaqData_2(), ['answer' => 'SalePro SAAS is a PHP Laravel Script']))
        ->assertSessionHasErrors('answer');

    $this->post(route('faq.update',$faqDetail->id), array_merge(FaqData(), ['question' => 12]))
        ->assertSessionHasErrors('answer');
});


/*
|--------------------------------------------------------------------------
| Update
|--------------------------------------------------------------------------
|
*/

test('Faq Detail Update', function () {
    $this->withoutExceptionHandling();
    Faq::factory()->create();
    $faqDetail = FaqDetail::factory()->create();

    $this->post(route('faq.update',$faqDetail->id), FaqData_2());
    $this->assertCount(1, FaqDetail::all());
});


/*
|--------------------------------------------------------------------------
| Delete
|--------------------------------------------------------------------------
*/


test('Deleted- Successfully', function () {
    // $this->withoutExceptionHandling();
    Faq::factory()->create();
    $faqDetail = FaqDetail::factory()->create();
    $result = $this->get(route('faq.destroy', $faqDetail->id));
    expect($result)->toBeTruthy();
});
