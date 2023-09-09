<?php

use App\Services\PackageService;
use PHPUnit\Framework\Assert;

// use Tests\Trait\PermissionTestTrait;

it('matching the permission array step by step', function () {

    $selectedPermissions = array_map(function($item) {
        return $item['name'];
    }, $this->selectedPermissions());
    $nameOfSelectedSlugs = implode(',', $selectedPermissions);

    $result = $this->featureAndPermissionManage($nameOfSelectedSlugs);
    // dd($result);
    // dd($this->expectedResultOfPermisson());

    expect($result)->toMatchArray($this->expectedResultOfPermisson());
});


// it('matching the permission array at a glance', function () {

//     $selectedPermissions = array_map(function($item) {
//         return $item['name'];
//     }, $this->selectedPermissions());
//     $nameOfSelectedSlugs = implode(',', $selectedPermissions);

//     $result = $this->featureAndPermissionManage($nameOfSelectedSlugs);

//     expect($result)->toMatchArray($this->getAllPermissions());
// });


