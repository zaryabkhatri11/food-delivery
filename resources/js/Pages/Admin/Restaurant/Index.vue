<script setup>

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head , Link} from '@inertiajs/vue3'

const { restaurants } = defineProps({
  restaurants: Array,
})

</script>


<template>
    <Head title="Restaurants" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Restaurants</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                     <div class="p-6"> 
                        <Link v-if="can('restaurant.create')" class="btn btn-primary" :href="route('admin.restaurants.create')"> 
                            Add New Restaurant 
                        </Link> 
                    </div> 
                    <div class="p-6 text-gray-900 overflow-x-scroll">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Restaurant Name</th>
                                <th>City</th>
                                <th>Address</th>
                                <th>Owner Name</th>
                                <th>Owner Email</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="restaurant in restaurants">
                              <td>{{ restaurant.id }}</td>
                              <td>{{ restaurant.name }}</td>
                              <td>
                                <span class="badge badge-primary">
                                    {{ restaurant.city.name }}
                                </span>
                              </td>
                              <td>{{ restaurant.address }}</td>
                              <td>{{ restaurant.owner.name }}</td>
                              <td>
                                <a class="text-link" :href="'mailto:' + restaurant.owner.email">{{ restaurant.owner.email }}</a>
                              </td>
                              <td>
                                <div class="flex items-center gap-2">
                                    <Link v-if="can('restaurant.update')" class="btn btn-primary" :href="route('admin.restaurants.edit', restaurant)"> 
                                        Edit 
                                    </Link> 
                                </div>
                              </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
