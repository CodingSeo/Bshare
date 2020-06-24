<template>
  <div>
    {{test}}
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "Home",
  data: () => ({
    test: "test"
  }),
  methods: {
    getData() {
      axios({
        method: "GET",
        url: "http://127.0.0.1:8000/dev/api"
      }).then(
        result => {
          console.log(result.data);
          this.test = result.data;
        },
        error => {
          console.error(error);
        }
      );
    }
  }
};
</script>
