<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'dashboards-view', 'guard_name' => 'admin', 'label' => 'dashboards'],

            ['name' => 'category-view', 'guard_name' => 'admin', 'label' => 'category'],
            ['name' => 'category-create', 'guard_name' => 'admin', 'label' => 'category'],
            ['name' => 'category-edit', 'guard_name' => 'admin', 'label' => 'category'],
            ['name' => 'category-delete', 'guard_name' => 'admin', 'label' => 'category'],

            ['name' => 'news-view', 'guard_name' => 'admin', 'label' => 'news'],
            ['name' => 'news-create', 'guard_name' => 'admin', 'label' => 'news'],
            ['name' => 'news-edit', 'guard_name' => 'admin', 'label' => 'news'],
            ['name' => 'news-delete', 'guard_name' => 'admin', 'label' => 'news'],

            ['name' => 'cms_users-view', 'guard_name' => 'admin', 'label' => 'cms_users'],
            ['name' => 'cms_users-create', 'guard_name' => 'admin', 'label' => 'cms_users'],
            ['name' => 'cms_users-edit', 'guard_name' => 'admin', 'label' => 'cms_users'],
            ['name' => 'cms_users-delete', 'guard_name' => 'admin', 'label' => 'cms_users'],

            ['name' => 'roles-view', 'guard_name' => 'admin', 'label' => 'roles'],
            ['name' => 'roles-create', 'guard_name' => 'admin', 'label' => 'roles'],
            ['name' => 'roles-edit', 'guard_name' => 'admin', 'label' => 'roles'],
            ['name' => 'roles-delete', 'guard_name' => 'admin', 'label' => 'roles'],

            ['name' => 'permissions-view', 'guard_name' => 'admin', 'label' => 'permissions'],
            ['name' => 'permissions-create', 'guard_name' => 'admin', 'label' => 'permissions'],
            ['name' => 'permissions-edit', 'guard_name' => 'admin', 'label' => 'permissions'],
            ['name' => 'permissions-delete', 'guard_name' => 'admin', 'label' => 'permissions'],

            ['name' => 'translations-view', 'guard_name' => 'admin', 'label' => 'translations'],
            ['name' => 'translations-create', 'guard_name' => 'admin', 'label' => 'translations'],
            ['name' => 'translations-edit', 'guard_name' => 'admin', 'label' => 'translations'],
            ['name' => 'translations-delete', 'guard_name' => 'admin', 'label' => 'translations'],

            ['name' => 'settings-view', 'guard_name' => 'admin', 'label' => 'settings'],

            ['name' => 'sliders-view', 'guard_name' => 'admin', 'label' => 'sliders'],
            ['name' => 'sliders-create', 'guard_name' => 'admin', 'label' => 'sliders'],
            ['name' => 'sliders-edit', 'guard_name' => 'admin', 'label' => 'sliders'],
            ['name' => 'sliders-delete', 'guard_name' => 'admin', 'label' => 'sliders'],

            ['name' => 'news-view', 'guard_name' => 'admin', 'label' => 'news'],
            ['name' => 'news-create', 'guard_name' => 'admin', 'label' => 'news'],
            ['name' => 'news-edit', 'guard_name' => 'admin', 'label' => 'news'],
            ['name' => 'news-delete', 'guard_name' => 'admin', 'label' => 'news'],

            ['name' => 'services-view', 'guard_name' => 'admin', 'label' => 'services'],
            ['name' => 'services-create', 'guard_name' => 'admin', 'label' => 'services'],
            ['name' => 'services-edit', 'guard_name' => 'admin', 'label' => 'services'],
            ['name' => 'services-delete', 'guard_name' => 'admin', 'label' => 'services'],

            ['name' => 'useful-link-view', 'guard_name' => 'admin', 'label' => 'useful-link'],
            ['name' => 'useful-link-create', 'guard_name' => 'admin', 'label' => 'useful-link'],
            ['name' => 'useful-link-edit', 'guard_name' => 'admin', 'label' => 'useful-link'],
            ['name' => 'useful-link-delete', 'guard_name' => 'admin', 'label' => 'useful-link'],

            ['name' => 'positions-view', 'guard_name' => 'admin', 'label' => 'positions'],
            ['name' => 'positions-create', 'guard_name' => 'admin', 'label' => 'positions'],
            ['name' => 'positions-edit', 'guard_name' => 'admin', 'label' => 'positions'],
            ['name' => 'positions-delete', 'guard_name' => 'admin', 'label' => 'positions'],

            ['name' => 'career-view', 'guard_name' => 'admin', 'label' => 'career'],
            ['name' => 'career-create', 'guard_name' => 'admin', 'label' => 'career'],
            ['name' => 'career-edit', 'guard_name' => 'admin', 'label' => 'career'],
            ['name' => 'career-delete', 'guard_name' => 'admin', 'label' => 'career'],

            ['name' => 'abouts-view', 'guard_name' => 'admin', 'label' => 'abouts'],
            ['name' => 'abouts-create', 'guard_name' => 'admin', 'label' => 'abouts'],
            ['name' => 'abouts-edit', 'guard_name' => 'admin', 'label' => 'abouts'],
            ['name' => 'abouts-delete', 'guard_name' => 'admin', 'label' => 'abouts'],

            ['name' => 'faqs-view', 'guard_name' => 'admin', 'label' => 'faqs'],
            ['name' => 'faqs-create', 'guard_name' => 'admin', 'label' => 'faqs'],
            ['name' => 'faqs-edit', 'guard_name' => 'admin', 'label' => 'faqs'],
            ['name' => 'faqs-delete', 'guard_name' => 'admin', 'label' => 'faqs'],

            ['name' => 'commits-view', 'guard_name' => 'admin', 'label' => 'commits'],
            ['name' => 'commits-create', 'guard_name' => 'admin', 'label' => 'commits'],
            ['name' => 'commits-edit', 'guard_name' => 'admin', 'label' => 'commits'],
            ['name' => 'commits-delete', 'guard_name' => 'admin', 'label' => 'commits'],

            ['name' => 'educational-degrees-view', 'guard_name' => 'admin', 'label' => 'educational-degrees'],
            ['name' => 'educational-degrees-create', 'guard_name' => 'admin', 'label' => 'educational-degrees'],
            ['name' => 'educational-degrees-edit', 'guard_name' => 'admin', 'label' => 'educational-degrees'],
            ['name' => 'educational-degrees-delete', 'guard_name' => 'admin', 'label' => 'educational-degrees'],

            ['name' => 'teachers-view', 'guard_name' => 'admin', 'label' => 'teachers'],
            ['name' => 'teachers-create', 'guard_name' => 'admin', 'label' => 'teachers'],
            ['name' => 'teachers-edit', 'guard_name' => 'admin', 'label' => 'teachers'],
            ['name' => 'teachers-delete', 'guard_name' => 'admin', 'label' => 'teachers'],

            ['name' => 'countries-view', 'guard_name' => 'admin', 'label' => 'countries'],
            ['name' => 'countries-create', 'guard_name' => 'admin', 'label' => 'countries'],
            ['name' => 'countries-edit', 'guard_name' => 'admin', 'label' => 'countries'],
            ['name' => 'countries-delete', 'guard_name' => 'admin', 'label' => 'countries'],

            ['name' => 'universities-view', 'guard_name' => 'admin', 'label' => 'universities'],
            ['name' => 'universities-create', 'guard_name' => 'admin', 'label' => 'universities'],
            ['name' => 'universities-edit', 'guard_name' => 'admin', 'label' => 'universities'],
            ['name' => 'universities-delete', 'guard_name' => 'admin', 'label' => 'universities'],

            ['name' => 'languages-view', 'guard_name' => 'admin', 'label' => 'languages'],
            ['name' => 'languages-create', 'guard_name' => 'admin', 'label' => 'languages'],
            ['name' => 'languages-edit', 'guard_name' => 'admin', 'label' => 'languages'],
            ['name' => 'languages-delete', 'guard_name' => 'admin', 'label' => 'languages'],

            ['name' => 'study-abroad-view', 'guard_name' => 'admin', 'label' => 'study-abroad'],
            ['name' => 'study-abroad-create', 'guard_name' => 'admin', 'label' => 'study-abroad'],
            ['name' => 'study-abroad-edit', 'guard_name' => 'admin', 'label' => 'study-abroad'],
            ['name' => 'study-abroad-delete', 'guard_name' => 'admin', 'label' => 'study-abroad'],

            ['name' => 'language-courses-view', 'guard_name' => 'admin', 'label' => 'language-courses'],
            ['name' => 'language-courses-create', 'guard_name' => 'admin', 'label' => 'language-courses'],
            ['name' => 'language-courses-edit', 'guard_name' => 'admin', 'label' => 'language-courses'],
            ['name' => 'language-courses-delete', 'guard_name' => 'admin', 'label' => 'language-courses'],

            ['name' => 'schools-view', 'guard_name' => 'admin', 'label' => 'schools'],
            ['name' => 'schools-create', 'guard_name' => 'admin', 'label' => 'schools'],
            ['name' => 'schools-edit', 'guard_name' => 'admin', 'label' => 'schools'],
            ['name' => 'schools-delete', 'guard_name' => 'admin', 'label' => 'schools'],
            ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->updateOrInsert(
                ['name' => $permission['name'], 'guard_name' => $permission['guard_name']],  // Şərt
                ['label' => $permission['label']]  // Yenilənəcək və ya əlavə olunacaq dəyərlər
            );
        }

    }
}
