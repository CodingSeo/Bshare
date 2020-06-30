<template>
  <div class="purchase">
    <v-container class="my-5">
      <h1 class="subheading grey--text">Book Purchase</h1>
      <v-divider></v-divider>
      
  <v-divider></v-divider>
      <!-- body -->
      <v-layout row wrap justify-end>
        <v-flex shrink>
          <!-- setting router to review making -->
          <router-link class="routerLink" to="/">
          <v-btn text>
            <span>Write</span>
            <v-icon right>create</v-icon>
          </v-btn>
          </router-link>
        </v-flex>
      </v-layout>

      <v-divider></v-divider>
      <!-- pagenate -->
      <v-simple-table fixed-header>
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">Name</th>
              <th class="text-left">Calories</th>
              <th class="text-left">Calories</th>
              <th class="text-left">Calories</th>
            </tr>
          </thead>
        </template>
      </v-simple-table>
      <v-list text>
        <v-list-item-group v-model="item" color="indigo" class='mt-3 mb-3'>
          <v-list-item v-for="(item, i) in items" :key="i">
            <v-list-item-content>
              <v-list-item-title v-text="item.text"></v-list-item-title>
              <v-list-item-subtitle v-text="item.text"></v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
      <v-divider></v-divider>
      <div class="text-center mt-3">
        <v-pagination v-model="item" :length="6" color="indigo"></v-pagination>
      </div>    
    </v-container>
  </div>
</template>

<script>
export default {
  name: "Purchase",
  data: () => ({
      item: 1,
      items: [
        { text: 'Real-Time', icon: 'mdi-clock' },
        { text: 'Audience', icon: 'mdi-account' },
        { text: 'Conversions', icon: 'mdi-flag' },
      ],
    }),
};
</script>
