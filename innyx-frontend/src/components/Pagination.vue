<template>
  <nav aria-label="Page navigation example">
    <ul class="pagination">
      <li class="page-item" :class="{ 'disabled': currentPage === 1 }">
        <a class="page-link" href="#" @click="changePage(currentPage - 1)">Anterior</a>
      </li>
      <li class="page-item" v-for="page in totalPages" :key="page" :class="{ 'active': currentPage === page }">
        <a class="page-link" href="#" @click="changePage(page)">{{ page }}</a>
      </li>
      <li class="page-item" :class="{ 'disabled': currentPage === totalPages }">
        <a class="page-link" href="#" @click="changePage(currentPage + 1)">Próximo</a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  props: {
    totalPages: {
      type: Number,
      required: true
    },
    currentPage: {
      type: Number,
      required: true
    }
  },
  methods: {
    changePage(page) {
      if (page >= 1 && page <= this.totalPages && page !== this.currentPage) {
        this.$emit('page-change', page);
      }
    }
  }
};
</script>

<style scoped>
/* Add your pagination styles here */
</style>
