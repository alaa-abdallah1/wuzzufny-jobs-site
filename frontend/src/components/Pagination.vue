<template>
  <div class="text-center">
    <center>
      <nav class="pagination">
        <ul class="crumbs">
          <v-btn
            small
            class="mb-2"
            elevation="1"
            v-for="(link, index) in pagination.links"
            :class="[{ activeButton: link.active }]"
            :disabled="link.active"
            :id="`id-${index}`"
            :key="index"
            @click="getData(link.url, (isPagination = true))"
            v-html="link.label"
          ></v-btn>
        </ul>
      </nav>
    </center>
  </div>
</template>
<script>
import { bus } from "../main";
import { mapActions } from "vuex";

export default {
  props: {
    url: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      pagination: {},
      query: ""
    };
  },
  computed: {
    id() {
      return this.$route.query.page;
    },
    linkUrl() {
      if (this.query) {
        return this.url + "?" + this.query;
      } else {
        return this.url;
      }
    }
  },
  methods: {
    ...mapActions({
      loadingStatus: "loader/loadingStatus"
    }),
    getData(paginateLinkurl, isPagination = false) {
      this.loadingStatus(true);
      var url = "";
      if (this.query && isPagination) {
        url = paginateLinkurl + "&&" + this.query;
      } else if (!this.query && isPagination) {
        url = paginateLinkurl;
      } else {
        url = this.linkUrl;
      }

      this.axios.get(url).then(res => {
        this.pagination = res.data;
        this.$emit("paginationData", res.data.data);
        this.$nextTick(() => {
          this.disableButtons();
          this.loadingStatus(false);
        });
      });
    },
    disableButtons() {
      var nextId = this.pagination.links.length - 1;
      var nextEl = document.getElementById(`id-${nextId}`);
      var prevEl = document.getElementById(`id-0`);
      var id2El = document.getElementById(`id-2`); // to handel the second button
      if (
        this.pagination &&
        this.pagination.current_page === 1 &&
        this.pagination.last_page !== this.pagination.current_page + 1
      ) {
        id2El.disabled = false;
        id2El.classList.remove("disabled");
      }
      if (
        this.pagination &&
        this.pagination.current_page === this.pagination.last_page
      ) {
        nextEl.disabled = true;
        nextEl.classList.add("disabled");
      } else {
        nextEl.disabled = false;
        nextEl.classList.remove("disabled");
      }

      if (this.pagination && this.pagination.current_page === 1) {
        prevEl.disabled = true;
        prevEl.classList.add("disabled");
      } else {
        prevEl.disabled = false;
        prevEl.classList.remove("disabled");
      }
    }
  },
  created() {
    this.getData();
    bus.$on("search", query => {
      this.query = query;
      this.getData(this.linkUrl);
    });
  }
};
</script>
<style scoped>
.pagination {
  display: flex;
  padding: 1rem;
  width: fit-content;
  border-radius: 0.25rem;
}

.crumbs {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
  list-style-type: none;
  margin: 0;
  padding: 0;
  gap: 0.5rem;
}

.theme--light .pagination button {
  background-color: rgb(255, 255, 255) !important;
  color: #1d1f20;
}

.theme--light .pagination button:hover,
.theme--light .pagination .activeButton {
  background-color: #1d1f20 !important;
  color: #fdfdfd;
  border-color: #1d1f20;
  cursor: pointer;
}
.theme--light .pagination .disabled:hover,
.theme--light .pagination .disabled {
  background-color: #f3f3f3 !important;
  color: #ccc !important;
  border-color: none !important;
}

.theme--dark .pagination .disabled:hover,
.theme--dark .pagination .disabled {
  background-color: #000 !important;
  color: #333 !important;
  border-color: none !important;
}
.theme--light .pagination .v-btn--disabled {
  background-color: #000 !important;
  color: aliceblue !important;
}
</style>
