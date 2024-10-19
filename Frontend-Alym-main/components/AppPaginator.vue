<template>
  <RenderlessPagination
      :data="data"
      :limit="limit"
      :keep-length="keepLength"
      @pagination-change-page="onPaginationChangePage"
      v-slot="slotProps"
  >
    <nav
        v-bind="$attrs"
        aria-label="Pagination"
        v-if="slotProps.computed.total > slotProps.computed.perPage"
    >
      <button
          :disabled="!slotProps.computed.prevPageUrl"
          v-on="slotProps.prevButtonEvents"
      >
        <slot name="prev-nav">
          Previous
        </slot>
      </button>

      <button
          :aria-current="slotProps.computed.currentPage ? 'page' : null"
          v-for="(page, key) in slotProps.computed.pageRange"
          :key="key"
          v-on="slotProps.pageButtonEvents(page)"
      >
        {{ page }}
      </button>

      <button
          :disabled="!slotProps.computed.nextPageUrl"
          v-on="slotProps.nextButtonEvents"
      >
        <slot name="next-nav">
          Next
        </slot>
      </button>
    </nav>
  </RenderlessPagination>
</template>

<script lang="ts" setup>
import { defineEmits, defineProps } from 'vue';
import RenderlessPagination from 'laravel-vue-pagination/src/RenderlessPagination.vue';

interface Props {
  data: Record<string, any>;
  limit: number;
  keepLength: boolean;
}

const props = defineProps<Props>({
  data: {type: Object, default: () => {}},
  limit: {type: Number, default: () => 10},
});
const emit = defineEmits(['pagination-change-page']);

const onPaginationChangePage = (page: number) => {
  emit('pagination-change-page', page);
};
</script>
